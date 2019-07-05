<?php

require_once("../config/_db.php");

class PecaController
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

        if (!$r) {
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
            if ($ext !== "jpeg") {
                $this->lastError = "Formato de imagem inválido!";
                return false;
            }
        } else {
            $ext = strtolower(substr($params['imagem']['name'], -3));
            if (strlen($ext) != 3) {
                $this->lastError = "Formato de imagem inválido!";
                return false;
            }
        }

        $sql = ("INSERT INTO table_peca 
                    (`id_fornecedor`, `nome_peca`, `descricao`, `custo`, `preco`, `status`, `_codigo`, `estoque`) 
                        VALUES 
                    (:id_fornecedor, :nome_peca, :descricao, :custo, :preco, 'A', NULL, :estoque)
                ");

        $stmt = Db::init()->prepare($sql);
        $stmt->bindValue(":id_fornecedor", $params['id_fornecedor'], PDO::PARAM_INT);
        $stmt->bindValue(":nome_peca", $params['nome'], PDO::PARAM_STR);
        $stmt->bindValue(":descricao", $params['descricao'], PDO::PARAM_STR);
        $stmt->bindValue(":custo", $params['custo'], PDO::PARAM_STR);
        $stmt->bindValue(":preco", $params['preco'], PDO::PARAM_STR);
        $stmt->bindValue(":estoque", $params['estoque'], PDO::PARAM_STR);

        $r = $stmt->execute();

        if (!$r) {
            $this->lastError = 'Ocorreu um erro ao executar!';
            return false;
        }

        $last_id = Db::init()->lastInsertId();


        $nomeNovoImagem = $last_id . "." . $ext;
        $this->updatePeca(array('id_peca' => $last_id, '_codigo' => $nomeNovoImagem));
        $dir = '../img/';

        $upload = move_uploaded_file($params['imagem']['tmp_name'], $dir . $nomeNovoImagem);

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
                    id_fornecedor = :id_fornecedor,
                    nome_peca = :nome_peca, 
                    descricao = :descricao, 
                    custo = :custo, 
                    preco = :preco, 
                    estoque = :estoque 
                    WHERE id_peca = :id_peca");

        $stmt = Db::init()->prepare($sql);
        $stmt->bindValue(":id_peca", $params['id_peca'], PDO::PARAM_INT);
        $stmt->bindValue(":id_fornecedor", $params['id_fornecedor'], PDO::PARAM_INT);
        $stmt->bindValue(":nome_peca", $params['nome'], PDO::PARAM_STR);
        $stmt->bindValue(":descricao", $params['descricao'], PDO::PARAM_STR);
        $stmt->bindValue(":custo", $params['custo'], PDO::PARAM_STR);
        $stmt->bindValue(":preco", $params['preco'], PDO::PARAM_STR);
        $stmt->bindValue(":estoque", $params['estoque'], PDO::PARAM_INT);

        $r = $stmt->execute();

        if (!$r) {
            $this->lastError = 'Ocorreu um erro ao executar!';
            return false;
        }

        if ($params['imagem']['name']) {

            $doc = '.jpeg';
            $extensao = strpos($params['imagem']['name'], $doc);
            if ($extensao) {
                $ext = strtolower(substr($params['imagem']['name'], -4));
                if ($ext !== "jpeg") {
                    $this->lastError = "Formato de imagem inválido!";
                    return false;
                }
            } else {
                $ext = strtolower(substr($params['imagem']['name'], -3));
                if (strlen($ext) != 3) {
                    $this->lastError = "Formato de imagem inválido!";
                    return false;
                }
            }

            $peca = $this->selectPeca(array('id_peca' => $params['id_peca']));

            $dir = '../img/';

            move_uploaded_file($params['imagem']['tmp_name'], $dir . $peca['_codigo']);
        }

        return true;
    }
}
