<?php

require_once("../controller/UsuarioController.php");

$obj = new UsuarioController();

$retornoJson = array("_err" => null, "msg" => null);

if ($obj->insertUsuario(array(
    'nome' => $_POST['nome'],
    'email' => $_POST['email'],
    'senha' => $_POST['senha'],
))) {
    $retornoJson["_err"] = 0;
} else {
    $retornoJson["_err"] = 1;
}

echo json_encode($retornoJson);
