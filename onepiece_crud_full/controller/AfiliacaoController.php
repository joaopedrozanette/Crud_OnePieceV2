<?php
require_once(__DIR__ . "/../dao/AfiliacaoDAO.php");

class AfiliacaoController {

    private AfiliacaoDAO $afiliacaoDAO;

    public function __construct() {
        $this->afiliacaoDAO = new AfiliacaoDAO();
    }

    public function listar(): array {
        return $this->afiliacaoDAO->listar();
    }

    public function buscarPorId(int $id): ?Afiliacao {
        return $this->afiliacaoDAO->buscarPorId($id);
    }
}
