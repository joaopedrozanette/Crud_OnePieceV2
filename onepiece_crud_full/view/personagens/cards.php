<?php
require_once(__DIR__ . "/../../controller/PersonagemController.php");
$cont  = new PersonagemController();
$lista = $cont->listar();
include_once(__DIR__ . "/../include/header.php");
?>

<div class="d-flex justify-content-between align-items-center mb-3">
  <div class="ms-auto d-flex gap-2">
  <a class="btn btn-danger" href="./listar.php">Voltar à Lista</a>
</div>
</div>

<div class="row g-4">
  <?php foreach ($lista as $p): ?>
    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
      <div class="card border-0 shadow-sm text-center op-card h-100">
        <?php if ($p->getImageUrl()): ?>
          <img src="<?= htmlspecialchars($p->getImageUrl()); ?>" class="op-thumb" alt="<?= htmlspecialchars($p->getNome()); ?>">
        <?php else: ?>
          <div class="bg-light d-flex align-items-center justify-content-center" style="height:220px;">
            <span class="text-muted">Sem imagem</span>
          </div>
        <?php endif; ?>

        <div class="card-body">
          <h5 class="card-title mb-1"><?= htmlspecialchars($p->getNome()); ?></h5>

          <div class="text-muted small mb-2">
            <em><?= $p->getAkumaNoMi() ? htmlspecialchars($p->getAkumaNoMi()) : 'Não tem'; ?></em>
          </div>

          <div class="d-flex flex-column gap-1 small text-start">
            <div><strong>Idade:</strong> <?= (int)$p->getIdade(); ?></div>
            <div><strong>Raça:</strong> <?= htmlspecialchars($p->getRaca()->getNome() ?? ""); ?></div>
            <div><strong>Afiliação:</strong> <?= htmlspecialchars($p->getAfiliacao()->getNome() ?? ""); ?></div>
            <div><span class="badge text-bg-dark">Recompensa: ฿ <?= number_format($p->getRecompensa(), 2, ',', '.'); ?></span></div>
          </div>

          <?php if ($p->getDescricao()): ?>
            <hr class="my-3">
            <p class="card-text text-start"><?= nl2br(htmlspecialchars($p->getDescricao())); ?></p>
          <?php endif; ?>
        </div>


        <div class="card-footer bg-white border-0 pb-4">
          <div class="d-flex justify-content-center gap-2">
            <a class="btn btn-sm btn-outline-primary" href="./alterar.php?id=<?= $p->getId(); ?>">Editar</a>
            <a class="btn btn-sm btn-outline-danger" href="./excluir.php?id=<?= $p->getId(); ?>" onclick="return confirm('Excluir personagem?');">Excluir</a>
          </div>
        </div>
      </div>
    </div>
  <?php endforeach; ?>

  <?php if (empty($lista)): ?>
    <div class="col-12">
      <div class="alert alert-secondary">Nenhum personagem cadastrado.</div>
    </div>
  <?php endif; ?>
</div>

<?php include_once(__DIR__ . "/../include/footer.php"); ?>
