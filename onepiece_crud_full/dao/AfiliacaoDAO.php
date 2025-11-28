<?php
require_once(__DIR__ . "/../util/Connection.php");
require_once(__DIR__ . "/../model/Afiliacao.php");

class AfiliacaoDAO {

    private PDO $conexao;

    public function __construct() {
        $this->conexao = Connection::getConnection();
    }

    public function listar(): array {
        $sql = "SELECT * FROM afiliacoes ORDER BY nome";
        $stm = $this->conexao->prepare($sql);
        $stm->execute();
        $resultado = $stm->fetchAll(PDO::FETCH_ASSOC);
        return $this->map($resultado);
    }

    public function buscarPorId(int $id): ?Afiliacao {
        $sql = "SELECT * FROM afiliacoes WHERE id = ?";
        $stm = $this->conexao->prepare($sql);
        $stm->execute([$id]);
        $resultado = $stm->fetchAll(PDO::FETCH_ASSOC);
        $lista = $this->map($resultado);
        return count($lista) ? $lista[0] : null;
    }

    private function map(array $resultado): array {
        $lista = [];
        foreach ($resultado as $r) {
            $obj = new Afiliacao();
            $obj->setId($r['id']);
            $obj->setNome($r['nome']);
            $lista[] = $obj;
        }
        return $lista;
    }
}
