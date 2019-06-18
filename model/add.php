<?php

require_once("../controller/CarrinhoController.php");

$obj = new CarrinhoController();

$params = array(
    'id_carrinho' => $_POST['id_carrinho'],
);

$obj->add($params);

$retornoJson = array("erro" => null, "msg" => null);

if ($obj->lastError()) {
    $retornoJson["msg"] = $obj->lastError();
    $retornoJson["erro"] = 1;
} else {
    $retornoJson["msg"] = 0;
    $retornoJson["erro"] = 0;
}

echo json_encode($retornoJson);
