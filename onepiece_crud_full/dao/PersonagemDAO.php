<?php
require_once(__DIR__ . "/../util/Connection.php");
require_once(__DIR__ . "/../model/Personagem.php");
require_once(__DIR__ . "/../model/Raca.php");
require_once(__DIR__ . "/../model/Afiliacao.php");

class PersonagemDAO {

    private PDO $conexao;

    public function __construct() {
        $this->conexao = Connection::getConnection();        
    }

    public function listar() {
        $sql = "SELECT p.*, r.nome AS nome_raca, a.nome AS nome_afiliacao
                FROM personagens p
                JOIN racas r ON r.id = p.raca_id
                JOIN afiliacoes a ON a.id = p.afiliacao_id
                ORDER BY p.id DESC";
        $stm = $this->conexao->prepare($sql);
        $stm->execute();
        $rows = $stm->fetchAll(PDO::FETCH_ASSOC);

        $lista = [];
        foreach($rows as $r) {
            $p = new Personagem();
            $p->setId((int)$r['id']);
            $p->setNome($r['nome']);
            $p->setIdade((int)$r['idade']);
            $p->setAkumaNoMi($r['akuma_no_mi']);
            $p->setRecompensa((float)$r['recompensa']);
            $p->setDescricao($r['descricao']);
            $p->setImageUrl($r['image_url']);
            $ra = new Raca(); $ra->setId((int)$r['raca_id']); $ra->setNome($r['nome_raca']); $p->setRaca($ra);
            $af = new Afiliacao(); $af->setId((int)$r['afiliacao_id']); $af->setNome($r['nome_afiliacao']); $p->setAfiliacao($af);
            $lista[] = $p;
        }
        return $lista;
    }

    public function buscarPorId(int $id): ?Personagem {
        $sql = "SELECT * FROM personagens WHERE id = ?";
        $stm = $this->conexao->prepare($sql);
        $stm->execute([$id]);
        $r = $stm->fetch(PDO::FETCH_ASSOC);
        if(!$r) return null;
        $p = new Personagem();
        $p->setId((int)$r['id']);
        $p->setNome($r['nome']);
        $p->setIdade((int)$r['idade']);
        $p->setAkumaNoMi($r['akuma_no_mi']);
        $p->setRecompensa((float)$r['recompensa']);
        $p->setDescricao($r['descricao']);
        $p->setImageUrl($r['image_url']);

        $ra = new Raca(); $ra->setId((int)$r['raca_id']); $p->setRaca($ra);
        $af = new Afiliacao(); $af->setId((int)$r['afiliacao_id']); $p->setAfiliacao($af);
        return $p;
    }

    public function inserir(Personagem $p) {
        $sql = "INSERT INTO personagens (nome, idade, akuma_no_mi, raca_id, afiliacao_id, recompensa, descricao, image_url)
                VALUES (?,?,?,?,?,?,?,?)";
        $stm = $this->conexao->prepare($sql);
        return $stm->execute([
            $p->getNome(), $p->getIdade(), $p->getAkumaNoMi(),
            $p->getRaca()->getId(), $p->getAfiliacao()->getId(),
            $p->getRecompensa(), $p->getDescricao(), $p->getImageUrl()
        ]);
    }

    public function alterar(Personagem $p) {
        $sql = "UPDATE personagens SET nome=?, idade=?, akuma_no_mi=?, raca_id=?, afiliacao_id=?, recompensa=?, descricao=?, image_url=?
                WHERE id=?";
        $stm = $this->conexao->prepare($sql);
        return $stm->execute([
            $p->getNome(), $p->getIdade(), $p->getAkumaNoMi(),
            $p->getRaca()->getId(), $p->getAfiliacao()->getId(),
            $p->getRecompensa(), $p->getDescricao(), $p->getImageUrl(),
            $p->getId()
        ]);
    }

    public function excluir(int $id) {
        $stm = $this->conexao->prepare("DELETE FROM personagens WHERE id=?");
        return $stm->execute([$id]);
    }
}
