<?php

require_once(__DIR__ . "/../../controller/PersonagemController.php");
require_once(__DIR__ . "/../../controller/RacaController.php");
require_once(__DIR__ . "/../../controller/AfiliacaoController.php");

$personagemCont  = new PersonagemController();
$racaCont        = new RacaController();
$afiliacaoCont   = new AfiliacaoController();

$personagem = null;
$msgErro = "";
$erros = [];

$racas = $racaCont->listar();
$afiliacoes = $afiliacaoCont->listar();

$id = isset($_GET['id']) && is_numeric($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id > 0) {
    $personagem = $personagemCont->buscar($id);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $idPost = isset($_POST['id']) && is_numeric($_POST['id']) ? (int)$_POST['id'] : 0;

    $p = new Personagem();
    if ($idPost > 0) {
        $p->setId($idPost);
    }

    $p->setNome($_POST['nome'] ?? null);
    $p->setIdade(is_numeric($_POST['idade'] ?? null) ? (int)$_POST['idade'] : null);
    $p->setAkumaNoMi($_POST['akuma_no_mi'] ?? null);

    $recStr = $_POST['recompensa'] ?? "0";
    $recStr = str_replace([".", ","], ["", "."], $recStr);
    $p->setRecompensa(is_numeric($recStr) ? (float)$recStr : 0);

    $p->setDescricao($_POST['descricao'] ?? null);
    $p->setImageUrl($_POST['image_url'] ?? null);

    $idRaca = isset($_POST['raca_id']) && is_numeric($_POST['raca_id']) ? (int)$_POST['raca_id'] : null;
    if ($idRaca) {
        $r = new Raca();
        $r->setId($idRaca);
        $p->setRaca($r);
    }

    $idAfi = isset($_POST['afiliacao_id']) && is_numeric($_POST['afiliacao_id']) ? (int)$_POST['afiliacao_id'] : null;
    if ($idAfi) {
        $a = new Afiliacao();
        $a->setId($idAfi);
        $p->setAfiliacao($a);
    }

    if ($idPost > 0) {
        $erros = $personagemCont->alterarModel($p);
    } else {
        $erros = $personagemCont->inserirModel($p);
    }

    if (!$erros) {
        header("Location: listar.php");
        exit;
    }

    $msgErro = implode("<br>", $erros);
    $personagem = $p;
}

include_once(__DIR__ . "/../include/header.php");
?>

<style>
    .content-wrapper {
        margin-top: 190px;
        margin-bottom: 40px;
    }
    .op-form-card {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 18px;
    }
</style>

<div class="content-wrapper">
  <div class="row justify-content-center">
    <div class="col-12 col-lg-10">

      <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">
          <?= (!$personagem || !$personagem->getId()) ? 'Novo Personagem' : 'Editar Personagem'; ?>
        </h1>
        <a class="btn btn-danger" href="listar.php">Voltar</a>
      </div>

      <div class="card op-form-card shadow-lg border-0">
        <div class="card-body p-4">

          <form name="frmCadastroPersonagem" method="post" class="row g-3">

            <input type="hidden" name="id"
                   value="<?= $personagem && $personagem->getId() ? $personagem->getId() : 0; ?>">

            <div class="col-md-6">
              <label class="form-label">Nome</label>
              <input class="form-control" name="nome"
                     value="<?= $personagem ? htmlspecialchars($personagem->getNome()) : ''; ?>">
            </div>

            <div class="col-md-3">
              <label class="form-label">Idade</label>
              <input class="form-control" name="idade" type="number" min="1"
                     value="<?= $personagem && $personagem->getIdade() ? $personagem->getIdade() : ''; ?>">
            </div>

            <div class="col-md-3">
              <label class="form-label">Recompensa (฿)</label>
              <input class="form-control" name="recompensa"
                     value="<?= $personagem && $personagem->getRecompensa() !== null ? $personagem->getRecompensa() : '0'; ?>">
            </div>

            <div class="col-md-6">
              <label class="form-label">Akuma no Mi</label>
              <input class="form-control" name="akuma_no_mi"
                     value="<?= $personagem ? htmlspecialchars($personagem->getAkumaNoMi()) : ''; ?>">
            </div>

            <div class="col-md-3">
              <label class="form-label">Raça</label>
              <select class="form-select" name="raca_id">
                <option value="">-- selecione --</option>
                <?php foreach($racas as $r): ?>
                  <option value="<?= $r->getId(); ?>"
                    <?php
                      $idR = $personagem && $personagem->getRaca() ? $personagem->getRaca()->getId() : 0;
                      echo ($idR == $r->getId() ? 'selected' : '');
                    ?>>
                    <?= htmlspecialchars($r->getNome()); ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="col-md-3">
              <label class="form-label">Afiliação</label>
              <select class="form-select" name="afiliacao_id">
                <option value="">-- selecione --</option>
                <?php foreach($afiliacoes as $a): ?>
                  <option value="<?= $a->getId(); ?>"
                    <?php
                      $idA = $personagem && $personagem->getAfiliacao() ? $personagem->getAfiliacao()->getId() : 0;
                      echo ($idA == $a->getId() ? 'selected' : '');
                    ?>>
                    <?= htmlspecialchars($a->getNome()); ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="col-12">
              <label class="form-label">URL da Imagem</label>
              <input class="form-control" name="image_url" placeholder="https://..."
                     value="<?= $personagem ? htmlspecialchars($personagem->getImageUrl()) : ''; ?>">
            </div>

            <div class="col-12">
              <label class="form-label">Descrição</label>
              <textarea class="form-control" name="descricao" rows="4"
                placeholder="Breve descrição do personagem..."><?=
                  $personagem ? htmlspecialchars($personagem->getDescricao()) : '';
                ?></textarea>
            </div>

            <div class="col-12 d-flex gap-2 mt-2">
              <button type="submit" class="btn btn-success">Gravar</button>

              <?php if(!$personagem || !$personagem->getId()): ?>
                <button type="button" class="btn btn-warning"
                        onclick="salvarPersonagemAjax()">
                  Gravar AJAX
                </button>
              <?php endif; ?>

              <a class="btn btn-outline-danger" href="listar.php">Cancelar</a>
            </div>

          </form>

          <?php if($msgErro): ?>
            <div class="alert alert-danger mt-3"><?= $msgErro; ?></div>
          <?php endif; ?>

          <div id="divMsgErro" class="alert alert-danger mt-3" style="display:none;"></div>

        </div>
      </div>

    </div>
  </div>
</div>

<?php include_once(__DIR__ . "/../include/footer.php"); ?>

<script src="js/personagem.js"></script>
