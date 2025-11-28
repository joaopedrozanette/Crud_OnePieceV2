<?php
require_once(__DIR__ . "/../dao/RacaDAO.php");

class RacaController {

    private RacaDAO $racaDAO;

    public function __construct() {
        $this->racaDAO = new RacaDAO();
    }

    public function listar(): array {
        return $this->racaDAO->listar();
    }

    public function buscarPorId(int $id): ?Raca {
        return $this->racaDAO->buscarPorId($id);
    }
}
