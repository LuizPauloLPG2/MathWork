<?php


require_once("../controller/FinalizaCompraController.php");

$obj = new FinalizaCompraController();

$params = array(
    'id_finalizacompra' => $_POST['id_finalizacompra'],
);

$obj->deleteCompra($params);

$retornoJson = array("erro" => null, "msg" => null);

if ($obj->lastError()) {
    $retornoJson["msg"] = $obj->lastError();
    $retornoJson["erro"] = 1;
} else {
    $retornoJson["msg"] = 0;
    $retornoJson["erro"] = 0;
}

echo json_encode($retornoJson);
