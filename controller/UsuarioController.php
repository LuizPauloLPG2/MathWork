<?php

require_once("../config/_db.php");
session_start();
class UsuarioController
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

    function login($data)
    {

        $email = $data['email_login'];
        $senha = $data['senha_login'];

        $consultaCliente = ("SELECT * FROM table_usuario 
                                WHERE 
                                    email = :email
                                    AND senha = :senha");

        $stmt = Db::init()->prepare($consultaCliente);
        $stmt->bindValue(":email", $email, PDO::PARAM_STR);
        $stmt->bindValue(":senha", $senha, PDO::PARAM_STR);
        $stmt->execute();
        $retorno = $stmt->rowCount();

        if ($retorno > 0) {
            $resultado = $stmt->fetch();
            $_SESSION["id_usuario"] = $resultado["id_usuario"];
            $_SESSION["nome_usuario"] = $resultado["nome"];
            $_SESSION["email_usuario"] = $resultado["email"];
            $_SESSION["tipo_usuario"] = $resultado["tipo"];

            return true;
        } else {
            return false;
        }
    }

    function logout()
    {
        session_destroy();
        return true;
    }

    function insertUsuario($params)
    {
        $sql = ("INSERT INTO table_usuario 
            (`nome`, `email`, `senha`, `tipo`) 
                VALUES 
            (:nome, :email, :senha, 'U')
        ");

        $stmt = Db::init()->prepare($sql);
        $stmt->bindValue(":nome", $params['nome'], PDO::PARAM_STR);
        $stmt->bindValue(":email", $params['email'], PDO::PARAM_STR);
        $stmt->bindValue(":senha", $params['senha'], PDO::PARAM_STR);

        $r = $stmt->execute();

        if (!$r) {
            return false;
        }
        return true;
    }
}
