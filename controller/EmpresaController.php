<?php

require_once("../config/_db.php");

class EmpresaController
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

    function put($params)
    {
        $this->lastError = null;

        foreach ($params as $key => $value) {
            $id_custoempresa = Db::init()->query("SELECT id_custoempresa FROM table_custoempresa WHERE nome = '" . $value['nome'] . "'")->fetch(PDO::FETCH_ASSOC);

            $sql = ("UPDATE table_custoempresa SET 
                    valor = :valor
                    WHERE id_custoempresa = :id_custoempresa");

            $stmt = Db::init()->prepare($sql);
            $stmt->bindValue(":id_custoempresa", $id_custoempresa['id_custoempresa'], PDO::PARAM_INT);
            $stmt->bindValue(":valor", $value['valor'], PDO::PARAM_STR);
            $r = $stmt->execute();

            if (!$r) {
                return false;
            }
        }
        return true;
    }
}
