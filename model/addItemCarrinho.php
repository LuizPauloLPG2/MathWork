<?php

require_once("../controller/CarrinhoController.php");

$obj = new CarrinhoController();

$params = array(
    'id_peca' => $_POST['id_peca'],
);

$obj->addItemCarrinho($params);

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
