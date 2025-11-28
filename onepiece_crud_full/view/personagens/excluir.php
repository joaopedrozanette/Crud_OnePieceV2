<?php
require_once(__DIR__ . "/../../controller/PersonagemController.php");   
$cont = new PersonagemController();
if(isset($_GET['id'])){
    $cont->excluir((int)$_GET['id']);
}
header("location: listar.php");
