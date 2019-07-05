<?php

require_once("../controller/FinalizaCompraController.php");

$obj = new FinalizaCompraController();

$params = array(
    'id_usuario' => $_POST['id_usuario'],
    'valor_total' => $_POST['valor_total'],
);

$obj->finalizaCompra($params);

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
