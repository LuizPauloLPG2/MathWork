<?php

require_once("../controller/CarrinhoPecaController.php");

$obj = new CarrinhoPecaController();

$params = array(
    'id_carrinhopeca' => $_POST['id_carrinhopeca'],
);

$obj->del($params);

$retornoJson = array("erro" => null, "msg" => null);

if ($obj->lastError()) {
    $retornoJson["msg"] = $obj->lastError();
    $retornoJson["erro"] = 1;
} else {
    $retornoJson["msg"] = 0;
    $retornoJson["erro"] = 0;
}

echo json_encode($retornoJson);
