<?php

require_once(__DIR__ . "/../controller/PersonagemController.php");
require_once(__DIR__ . "/../controller/RacaController.php");
require_once(__DIR__ . "/../controller/AfiliacaoController.php");

$id = isset($_GET['id']) && is_numeric($_GET['id']) ? (int)$_GET['id'] : 0;

$contPersonagem = new PersonagemController();
$personagem = $contPersonagem->buscar($id);

if(!$personagem) {
    echo "<div class='text-danger'>Personagem não encontrado.</div>";
    exit;
}

$nomeRaca = "—";
$raca = $personagem->getRaca();
if ($raca && $raca->getId()) {
    $contRaca = new RacaController();
    $racaBD = $contRaca->buscarPorId($raca->getId());
    if ($racaBD && $racaBD->getNome()) {
        $nomeRaca = $racaBD->getNome();
    }
}

$nomeAfiliacao = "—";
$afi = $personagem->getAfiliacao();
if ($afi && $afi->getId()) {
    $contAfiliacao = new AfiliacaoController();
    $afiBD = $contAfiliacao->buscarPorId($afi->getId());
    if ($afiBD && $afiBD->getNome()) {
        $nomeAfiliacao = $afiBD->getNome();
    }
}
?>
<div class="row">
  <div class="col-md-3 mb-2">
    <?php if($personagem->getImageUrl()): ?>
      <img src="<?= htmlspecialchars((string)$personagem->getImageUrl()); ?>"
           class="img-fluid rounded"
           alt="Imagem do personagem">
    <?php else: ?>
      <div class="text-muted">Sem imagem.</div>
    <?php endif; ?>
  </div>

  <div class="col-md-9">
    <h5 class="mb-2">
      <?= htmlspecialchars((string)($personagem->getNome() ?? "")); ?>
    </h5>

    <p class="mb-1">
      <strong>Idade:</strong>
      <?= (int)$personagem->getIdade(); ?>
    </p>

    <p class="mb-1">
      <strong>Raça:</strong>
      <?= htmlspecialchars((string)$nomeRaca); ?>
    </p>

    <p class="mb-1">
      <strong>Afilição:</strong>
      <?= htmlspecialchars((string)$nomeAfiliacao); ?>
    </p>

    <p class="mb-1">
      <strong>Recompensa:</strong>
      ฿ <?= number_format((float)$personagem->getRecompensa(), 2, ',', '.'); ?>
    </p>

    <?php if($personagem->getAkumaNoMi()): ?>
      <p class="mb-1">
        <strong>Akuma no Mi:</strong>
        <?= htmlspecialchars((string)$personagem->getAkumaNoMi()); ?>
      </p>
    <?php endif; ?>

    <?php if($personagem->getDescricao()): ?>
      <p class="mt-2 mb-0">
        <strong>Descrição:</strong><br>
        <?= nl2br(htmlspecialchars((string)$personagem->getDescricao())); ?>
      </p>
    <?php endif; ?>
  </div>
</div>
