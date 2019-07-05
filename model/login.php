<?php

require_once("../controller/UsuarioController.php");

$obj = new UsuarioController();

$retornoJson = array("_err" => null, "msg" => null);

if ($obj->login(array(
    'email_login' => $_POST['email_login'],
    'senha_login' => $_POST['senha_login']
))) {
    $retornoJson["_err"] = 0;
} else {
    $retornoJson["_err"] = 1;
}

echo json_encode($retornoJson);
