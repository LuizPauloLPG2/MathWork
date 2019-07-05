<?php

require_once("../controller/PecaController.php");

$obj = new PecaController();

$params = array(
    'id_peca' => $_POST['id_peca'],
    'id_fornecedor' => $_POST['id_fornecedor'],
    'nome' => $_POST['nome'],
    'descricao' => $_POST['descricao'],
    'custo' => $_POST['custo'],
    'preco' => $_POST['preco'],
    'imagem' => $_FILES['imagem'],
    'estoque' => $_POST['estoque'],
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
