<?php

require_once("../config/_db.php");
require_once("../config/_config.php");

class FinalizaCompraController
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

    function finalizaCompra($params)
    {
        $this->lastError = null;

        $data_cadastro = Config::getCurrentDay();

        $sql = ("INSERT INTO table_finalizacompra 
                    (`id_usuario`, `valor_total`, `data_cadastro`) 
                    VALUES 
                    (:id_usuario, :valor_total, :data_cadastro)");

        $stmt = Db::init()->prepare($sql);
        $stmt->bindValue(":id_usuario", $params['id_usuario'], PDO::PARAM_INT);
        $stmt->bindValue(":valor_total", $params['valor_total'], PDO::PARAM_STR);
        $stmt->bindValue(":data_cadastro", $data_cadastro, PDO::PARAM_STR);

        $r = $stmt->execute();

        if (!$r) {
            $this->lastError = 'Ocorreu um erro ao executar!';
            return false;
        }

        if (Db::init()->query("SELECT * FROM table_carrinhopeca")->rowCount() > 0) {
            $deleteCarrinhoPeca = Db::init()->exec("DELETE FROM table_carrinhopeca");
            if (!$deleteCarrinhoPeca) {
                $this->lastError = 'Ocorreu um erro ao executar!';
                return false;
            }
        }

        return true;
    }

    function deleteCompra($params)
    {
        $this->lastError = null;

        $sql = ("DELETE FROM table_finalizacompra WHERE id_finalizacompra = :id_finalizacompra");

        $stmt = Db::init()->prepare($sql);
        $stmt->bindValue(":id_finalizacompra", $params['id_finalizacompra'], PDO::PARAM_INT);

        $r = $stmt->execute();

        if (!$r) {
            $this->lastError = 'Ocorreu um erro ao executar!';
            return false;
        }

        return true;
    }
}
