<?php


require_once(__DIR__ . "/../model/Personagem.php");
require_once(__DIR__ . "/../model/Raca.php");
require_once(__DIR__ . "/../model/Afiliacao.php");
require_once(__DIR__ . "/../controller/PersonagemController.php");


$nome   = $_POST['nome'] ?? null;
$idade  = is_numeric($_POST['idade'] ?? null) ? (int)$_POST['idade'] : null;
$akuma  = $_POST['akuma_no_mi'] ?? null;

$recStr = $_POST['recompensa'] ?? "0";
$recStr = str_replace([".", ","], ["", "."], $recStr);
$recompensa = is_numeric($recStr) ? (float)$recStr : 0;

$idRaca      = is_numeric($_POST['raca_id'] ?? null) ? (int)$_POST['raca_id'] : null;
$idAfiliacao = is_numeric($_POST['afiliacao_id'] ?? null) ? (int)$_POST['afiliacao_id'] : null;
$imageUrl    = $_POST['image_url'] ?? null;
$descricao   = $_POST['descricao'] ?? null;

$personagem = new Personagem();
$personagem->setNome($nome);
$personagem->setIdade($idade);
$personagem->setAkumaNoMi($akuma);
$personagem->setRecompensa($recompensa);
$personagem->setImageUrl($imageUrl);
$personagem->setDescricao($descricao);

if ($idRaca) {
    $r = new Raca();
    $r->setId($idRaca);
    $personagem->setRaca($r);
}

if ($idAfiliacao) {
    $a = new Afiliacao();
    $a->setId($idAfiliacao);
    $personagem->setAfiliacao($a);
}

$cont = new PersonagemController();

$erros = $cont->inserirModel($personagem);

if (!empty($erros)) {
    echo implode("<br>", $erros);
} else {
    echo "";
}
