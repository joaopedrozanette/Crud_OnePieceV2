<?php
require_once(__DIR__ . "/../dao/PersonagemDAO.php");
require_once(__DIR__ . "/../service/PersonagemService.php");

class PersonagemController {

    private PersonagemDAO $dao;
    private PersonagemService $service;

    public function __construct() {
        $this->dao = new PersonagemDAO();
        $this->service = new PersonagemService();
    }

    public function listar() {
        return $this->dao->listar();
    }

    public function buscar($id) {
        return $this->dao->buscarPorId((int)$id);
    }

    public function inserir($dados) {
        $p = $this->hydratar($dados);
        $erros = $this->service->validar($p);
        if($erros) return $erros;
        $ok = $this->dao->inserir($p);
        return $ok ? [] : ["Erro ao inserir personagem!"];
    }

    public function alterar($dados) {
        $p = $this->hydratar($dados);
        $erros = $this->service->validar($p);
        if($erros) return $erros;
        $ok = $this->dao->alterar($p);
        return $ok ? [] : ["Erro ao alterar personagem!"];
    }

    public function excluir($id) {
        $ok = $this->dao->excluir((int)$id);
        return $ok ? [] : ["Erro ao excluir personagem!"];
    }

    public function inserirModel(Personagem $p): array {
        $erros = $this->service->validar($p);
        if($erros) return $erros;
        $ok = $this->dao->inserir($p);
        return $ok ? [] : ["Erro ao inserir personagem!"];
    }

    public function alterarModel(Personagem $p): array {
        $erros = $this->service->validar($p);
        if($erros) return $erros;
        $ok = $this->dao->alterar($p);
        return $ok ? [] : ["Erro ao alterar personagem!"];
    }
    private function hydratar($d): Personagem {
        $p = new Personagem();
        if(isset($d['id'])) $p->setId((int)$d['id']);
        $p->setNome(trim($d['nome'] ?? ""));
        $p->setIdade(isset($d['idade']) ? (int)$d['idade'] : null);
        $p->setAkumaNoMi(trim($d['akuma_no_mi'] ?? ""));
        $p->setRecompensa(isset($d['recompensa']) ? (float)str_replace(",", ".", $d['recompensa']) : 0);
        $p->setDescricao(trim($d['descricao'] ?? ""));
        $p->setImageUrl(trim($d['image_url'] ?? ""));

        $r = new Raca();
        $r->setId(isset($d['raca_id']) ? (int)$d['raca_id'] : null);
        $p->setRaca($r);

        $a = new Afiliacao();
        $a->setId(isset($d['afiliacao_id']) ? (int)$d['afiliacao_id'] : null);
        $p->setAfiliacao($a);

        return $p;
    }
}
