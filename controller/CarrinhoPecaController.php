<?php

require_once("../config/_db.php");

class CarrinhoPecaController
{

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

    function delEstoquePeca($id_peca)
    {
        $sql = ("UPDATE table_peca SET estoque = estoque - 1 WHERE id_peca = :id_peca");
        $stmt = Db::init()->prepare($sql);
        $stmt->bindValue(":id_peca", $id_peca, PDO::PARAM_INT);

        $r = $stmt->execute();

        if (!$r) {
            $this->lastError = 'Ocorreu um erro ao executar!';
            return false;
        }

        return true;
    }

    function addEstoquePeca($id_peca)
    {
        $sql = ("UPDATE table_peca SET estoque = estoque + 1 WHERE id_peca = :id_peca");
        $stmt = Db::init()->prepare($sql);
        $stmt->bindValue(":id_peca", $id_peca, PDO::PARAM_INT);

        $r = $stmt->execute();

        if (!$r) {
            $this->lastError = 'Ocorreu um erro ao executar!';
            return false;
        }

        return true;
    }

    function addItemCarrinho($params)
    {
        $this->lastError = null;

        $peca = $this->selectPeca(array('id_peca' => $params['id_peca']));
        $quantidade = 1;
        $this->delEstoquePeca($params['id_peca']);
        $sql = ("INSERT INTO table_carrinhopeca (`id_peca`, `quantidade`, `preco_total`) VALUES (:id_peca, :quantidade, :preco_total)");
        $stmt = Db::init()->prepare($sql);
        $stmt->bindValue(":id_peca", $params['id_peca'], PDO::PARAM_INT);
        $stmt->bindValue(":quantidade", $quantidade, PDO::PARAM_INT);
        $stmt->bindValue(":preco_total", $peca['preco'], PDO::PARAM_STR);

        $r = $stmt->execute();

        if (!$r) {
            $this->lastError = 'Ocorreu um erro ao executar!';
            return false;
        }

        return true;
    }

    function selectCarrinho($params)
    {
        $sql = ("SELECT * FROM table_carrinhopeca WHERE id_carrinhopeca = :id_carrinhopeca");
        $stmt = Db::init()->prepare($sql);
        $stmt->bindValue(":id_carrinhopeca", $params['id_carrinhopeca'], PDO::PARAM_INT);
        $stmt->execute();

        return array(
            'carrinho' => $stmt->fetch(PDO::FETCH_ASSOC),
            'count' => $stmt->rowCount()
        );
    }

    function add($params)
    {
        $this->lastError = null;

        $carrinho = $this->selectCarrinho(array('id_carrinhopeca' => $params['id_carrinhopeca']));
        $peca = $this->selectPeca(array('id_peca' => $carrinho['carrinho']['id_peca']));
        $this->delEstoquePeca($carrinho['carrinho']['id_peca']);
        $preco_total = $peca['preco'];

        $sql = ("UPDATE table_carrinhopeca SET 
                    quantidade = quantidade + 1, 
                    preco_total = preco_total + :preco_total
                    WHERE id_carrinhopeca = :id_carrinhopeca");

        $stmt = Db::init()->prepare($sql);
        $stmt->bindValue(":id_carrinhopeca", $params['id_carrinhopeca'], PDO::PARAM_INT);
        $stmt->bindValue(":preco_total", $preco_total, PDO::PARAM_STR);

        $r = $stmt->execute();

        if (!$r) {
            $this->lastError = 'Ocorreu um erro ao executar!';
            return false;
        }

        return true;
    }

    function selectIdPeca($id_carrinhopeca)
    {
        $sql = ("SELECT * FROM table_carrinhopeca WHERE id_peca = :id_carrinhopeca");
        $stmt = Db::init()->prepare($sql);
        $stmt->bindValue(":id_carrinhopeca", $id_carrinhopeca, PDO::PARAM_INT);
        $stmt->execute();
        $r = $stmt->fetch(PDO::FETCH_ASSOC);
        return $r;
    }

    function deleteItemCarrinho($params)
    {
        $this->lastError = null;

        $sql = ("DELETE FROM table_carrinhopeca WHERE id_carrinhopeca = :id_carrinhopeca");
        $stmt = Db::init()->prepare($sql);
        $stmt->bindValue(":id_carrinhopeca", $params['id_carrinhopeca'], PDO::PARAM_INT);
        $stmt->execute();
        $r = $stmt->execute();

        if (!$r) {
            $this->lastError = 'Ocorreu um erro ao executar!';
            return false;
        }

        return true;
    }

    function del($params)
    {
        $this->lastError = null;

        $carrinho = $this->selectCarrinho(array('id_carrinhopeca' => $params['id_carrinhopeca']));
        $peca = $this->selectPeca(array('id_peca' => $carrinho['carrinho']['id_peca']));
        $this->addEstoquePeca($carrinho['carrinho']['id_peca']);
        $preco_total = $peca['preco'];

        if ($carrinho['carrinho']['quantidade'] > 1) {

            $sql = ("UPDATE table_carrinhopeca SET 
                    quantidade = quantidade - 1, 
                    preco_total = preco_total - :preco_total
                    WHERE id_carrinhopeca = :id_carrinhopeca");

            $stmt = Db::init()->prepare($sql);
            $stmt->bindValue(":id_carrinhopeca", $params['id_carrinhopeca'], PDO::PARAM_INT);
            $stmt->bindValue(":preco_total", $preco_total, PDO::PARAM_STR);

            $r = $stmt->execute();

            if (!$r) {
                $this->lastError = 'Ocorreu um erro ao executar!';
                return false;
            }
        } else {
            $this->deleteItemCarrinho(array('id_carrinhopeca' => $params['id_carrinhopeca']));
        }

        return true;
    }
}
