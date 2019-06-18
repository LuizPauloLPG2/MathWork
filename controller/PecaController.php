<?php 

require_once("../config/_db.php");

class PecaController {

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

    function updatePeca($params)
    {
        $this->lastError = null;
        
        $sql = ("UPDATE table_peca SET 
                    _codigo = :_codigo 
                    WHERE id_peca = :id_peca");
                    
        $stmt = Db::init()->prepare($sql);
        $stmt->bindValue(":id_peca", $params['id_peca'], PDO::PARAM_INT);
        $stmt->bindValue(":_codigo", $params['_codigo'], PDO::PARAM_STR);
        
        $r = $stmt->execute();

        if(!$r){
            $this->lastError = 'Ocorreu um erro ao executar!';
            return false;
        }

        return true;

    }

    function post($params)
    {
        $this->lastError = null;
        
        $tamanho = $params['imagem']['size'];
        $max = 10485760;

        if ($tamanho > $max) {
            $this->lastError = "Arquivo com tamanho inválido!";
            return false;
        }

        $doc = '.jpeg';
        $extensao = strpos($params['imagem']['name'], $doc);
        if ($extensao) {
            $ext = strtolower(substr($params['imagem']['name'], -4));
        } else {
            $ext = strtolower(substr($params['imagem']['name'], -3));
        }

        $sql = ("INSERT INTO table_peca 
                    (`nome_peca`, `descricao`, `preco`, `status`) 
                        VALUES 
                    (:nome_peca, :descricao, :preco, 'A')
                ");

        $stmt = Db::init()->prepare($sql);
        $stmt->bindValue(":nome_peca", $params['nome'], PDO::PARAM_STR);
        $stmt->bindValue(":descricao", $params['descricao'], PDO::PARAM_STR);
        $stmt->bindValue(":preco", $params['preco'], PDO::PARAM_STR);
        
        $r = $stmt->execute();

        if(!$r){
            $this->lastError = 'Ocorreu um erro ao executar!';
            return false;
        }

        $last_id = Db::init()->lastInsertId();
        
        $this->updatePeca(array('id_peca' => $last_id, '_codigo' => $last_id));
        
        $nomeNovoImagem = $last_id . $ext;
        $dir = '../img/';

        $upload = move_uploaded_file($params['imagem']['tmp_name'], $dir . $last_id);

        return true;

    }


    function selectPeca($params)
    {
        $sql = ("SELECT * FROM table_peca WHERE id_peca = :id_peca");
        $stmt = Db::init()->prepare($sql);
        $stmt->bindValue(":id_peca", $params['id_peca'], PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function put($params)
    {
        $this->lastError = null;
        $dir = '../img/';
        $tamanho = $params['imagem']['size'];
        $max = 10485760;

        if ($tamanho > $max) {
            $this->lastError = "Arquivo com tamanho inválido!";
            return false;
        }

        $sql = ("UPDATE table_peca SET 
                    nome_peca = :nome_peca, 
                    descricao = :descricao, 
                    preco = :preco 
                    WHERE id_peca = :id_peca");
                    
        $stmt = Db::init()->prepare($sql);
        $stmt->bindValue(":id_peca", $params['id_peca'], PDO::PARAM_INT);
        $stmt->bindValue(":nome_peca", $params['nome'], PDO::PARAM_STR);
        $stmt->bindValue(":descricao", $params['descricao'], PDO::PARAM_STR);
        $stmt->bindValue(":preco", $params['preco'], PDO::PARAM_STR);
        
        $r = $stmt->execute();

        if(!$r){
            $this->lastError = 'Ocorreu um erro ao executar!';
            return false;
        }

        if($params['imagem']['name']){
            
            $doc = '.jpeg';
            $extensao = strpos($params['imagem']['name'], $doc);
            if ($extensao) {
                $ext = strtolower(substr($params['imagem']['name'], -4));
            } else {
                $ext = strtolower(substr($params['imagem']['name'], -3));
            }

            $peca = $this->selectPeca(array('id_peca' => $params['id_peca']));
        
            $nomeNovoImagem = $params['id_peca'] . $ext;
            $dir = '../img/';

            $upload = move_uploaded_file($params['imagem']['tmp_name'], $dir . $peca['_codigo']);
        }

        return true;

    }

}