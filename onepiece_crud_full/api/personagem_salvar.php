<?php


require_once(__DIR__ . "/../model/Personagem.php");
require_once(__DIR__ . "/../model/Raca.php");
require_once(__DIR__ . "/../model/Afiliacao.php");
require_once(__DIR__ . "/../controller/PersonagemController.php");

header("Content-Type: application/json; charset=utf-8");

$idPost = isset($_POST['id']) && is_numeric($_POST['id']) ? (int)$_POST['id'] : 0;

$nome       = $_POST['nome'] ?? null;
$idade      = isset($_POST['idade']) && is_numeric($_POST['idade']) ? (int)$_POST['idade'] : null;
$akuma      = $_POST['akuma_no_mi'] ?? null;

$recStr     = $_POST['recompensa'] ?? "0";
$recStr     = str_replace([".", ","], ["", "."], $recStr);
$recompensa = is_numeric($recStr) ? (float)$recStr : 0;

$descricao  = $_POST['descricao'] ?? null;
$imageUrl   = $_POST['image_url'] ?? null;

$idRaca     = isset($_POST['raca_id']) && is_numeric($_POST['raca_id']) ? (int)$_POST['raca_id'] : null;
$idAfi      = isset($_POST['afiliacao_id']) && is_numeric($_POST['afiliacao_id']) ? (int)$_POST['afiliacao_id'] : null;

$p = new Personagem();
if ($idPost > 0) {
    $p->setId($idPost);
}

$p->setNome($nome);
$p->setIdade($idade);
$p->setAkumaNoMi($akuma);
$p->setRecompensa($recompensa);
$p->setDescricao($descricao);
$p->setImageUrl($imageUrl);

if ($idRaca) {
    $r = new Raca();
    $r->setId($idRaca);
    $p->setRaca($r);
}

if ($idAfi) {
    $a = new Afiliacao();
    $a->setId($idAfi);
    $p->setAfiliacao($a);
}

$cont = new PersonagemController();

if ($idPost > 0) {
    $erros = $cont->alterarModel($p);
} else {
    $erros = $cont->inserirModel($p);
}

if ($erros && count($erros) > 0) {
    echo json_encode([
        "success" => false,
        "errors"  => $erros,
        "id"      => null
    ]);
    exit;
}

$respId = $idPost > 0 ? $idPost : ($p->getId() ?? 0);

echo json_encode([
    "success" => true,
    "errors"  => [],
    "id"      => $respId
]);
