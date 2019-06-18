<?php 

require_once("../config/_db.php");

class CarrinhoController {

    protected $lastError = null;
    protected $lastInsertId = null;

    public function lastError()
    {
        return $this->lastError;
    }

    public function lastInsertId()
    {
        return $this->lastInsertId;
    }

    function selectPeca($params)
    {
        $sql = ("SELECT * FROM table_peca WHERE id_peca = :id_peca");
        $stmt = Db::init()->prepare($sql);
        $stmt->bindValue(":id_peca", $params['id_peca'], PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function addItemCarrinho($params)
    {
        $this->lastError = null;
        
        $peca = $this->selectPeca(array('id_peca' => $params['id_peca']));
        $quantidade = 1;

        $sql = ("INSERT INTO table_carrinho (`id_peca`, `quantidade`, `preco_total`) VALUES (:id_peca, :quantidade, :preco_total)");
        $stmt = Db::init()->prepare($sql);
        $stmt->bindValue(":id_peca", $params['id_peca'], PDO::PARAM_INT);
        $stmt->bindValue(":quantidade", $quantidade, PDO::PARAM_INT);
        $stmt->bindValue(":preco_total", $peca['preco'], PDO::PARAM_STR);
        
        $r = $stmt->execute();

        if(!$r){
            $this->lastError = 'Ocorreu um erro ao executar!';
            return false;
        }

        return true;

    }

    function selectCarrinho($params)
    {
        $sql = ("SELECT * FROM table_carrinho WHERE id_carrinho = :id_carrinho");
        $stmt = Db::init()->prepare($sql);
        $stmt->bindValue(":id_carrinho", $params['id_carrinho'], PDO::PARAM_INT);
        $stmt->execute();

        return array(
            'carrinho' => $stmt->fetch(PDO::FETCH_ASSOC),
            'count' => $stmt->rowCount()
        );
    }

    function add($params)
    {
        $this->lastError = null;

        $carrinho = $this->selectCarrinho(array('id_carrinho' => $params['id_carrinho']));
        $peca = $this->selectPeca(array('id_peca' => $carrinho['carrinho']['id_peca']));

        $preco_total = $peca['preco'];

        $sql = ("UPDATE table_carrinho SET 
                    quantidade = quantidade + 1, 
                    preco_total = preco_total + :preco_total
                    WHERE id_carrinho = :id_carrinho");

        $stmt = Db::init()->prepare($sql);
        $stmt->bindValue(":id_carrinho", $params['id_carrinho'], PDO::PARAM_INT);
        $stmt->bindValue(":preco_total", $preco_total, PDO::PARAM_STR);

        $r = $stmt->execute();

        if(!$r){
            $this->lastError = 'Ocorreu um erro ao executar!';
            return false;
        }

        return true;

    }

    function deleteItemCarrinho($params)
    {
        $sql = ("DELETE FROM table_carrinho WHERE id_carrinho = :id_carrinho");
        $stmt = Db::init()->prepare($sql);
        $stmt->bindValue(":id_carrinho", $params['id_carrinho'], PDO::PARAM_INT);
        $stmt->execute();
        $r = $stmt->execute();

        if(!$r){
            $this->lastError = 'Ocorreu um erro ao executar!';
            return false;
        }

        return true;
    }

    function del($params)
    {
        $this->lastError = null;

        $carrinho = $this->selectCarrinho(array('id_carrinho' => $params['id_carrinho']));
        $peca = $this->selectPeca(array('id_peca' => $carrinho['carrinho']['id_peca']));

        $preco_total = $peca['preco'];

        if($carrinho['carrinho']['quantidade'] > 1){

            $sql = ("UPDATE table_carrinho SET 
                    quantidade = quantidade - 1, 
                    preco_total = preco_total - :preco_total
                    WHERE id_carrinho = :id_carrinho");

            $stmt = Db::init()->prepare($sql);
            $stmt->bindValue(":id_carrinho", $params['id_carrinho'], PDO::PARAM_INT);
            $stmt->bindValue(":preco_total", $preco_total, PDO::PARAM_STR);

            $r = $stmt->execute();

            if(!$r){
                $this->lastError = 'Ocorreu um erro ao executar!';
                return false;
            }

        }else{
            $this->deleteItemCarrinho(array('id_carrinho' => $params['id_carrinho'])); 
        }

        return true;
    }

}