<?php

require_once("../controller/EmpresaController.php");

$obj = new EmpresaController();

$params = array(
    'aluguel' => array('nome' => 'aluguel', 'valor' => $_POST['aluguel']),
    'agua' => array('nome' => 'agua', 'valor' => $_POST['agua']),
    'energia' => array('nome' => 'energia', 'valor' => $_POST['energia']),
    'internet' => array('nome' => 'internet', 'valor' => $_POST['internet']),
    'telefone' => array('nome' => 'telefone', 'valor' => $_POST['telefone']),
    'custo_fixo' => array('nome' => 'custo_fixo', 'valor' => $_POST['custo_fixo']),
    'impostos' => array('nome' => 'impostos', 'valor' => $_POST['impostos']),
    'transportes' => array('nome' => 'transportes', 'valor' => $_POST['transportes']),
    'funcionarios' => array('nome' => 'funcionarios', 'valor' => $_POST['funcionarios']),
);

$obj->put($params);

$retornoJson = array("erro" => null, "msg" => null);

if ($obj->lastError()) {
    $retornoJson["msg"] = $obj->lastError();
    $retornoJson["erro"] = 1;
} else {
    $retornoJson["msg"] = 0;
    $retornoJson["erro"] = 0;
}

echo json_encode($retornoJson);
