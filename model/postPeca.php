<?php

require_once("../controller/PecaController.php");

$obj = new PecaController();

$params = array(
    'nome' => $_POST['nome'],
    'descricao' => $_POST['descricao'],
    'preco' => $_POST['preco'],
    'imagem' => $_FILES['imagem'],
);

$obj->post($params);

$retornoJson = array("erro" => null, "msg" => null);

if ($obj->lastError()) {
    $retornoJson["msg"] = $obj->lastError();
    $retornoJson["erro"] = 1;
} else {
    $retornoJson["msg"] = 0;
    $retornoJson["erro"] = 0;
    $retornoJson["last_id"] = $obj->lastInsertId();
}

echo json_encode($retornoJson);