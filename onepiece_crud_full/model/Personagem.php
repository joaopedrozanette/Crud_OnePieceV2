<?php
require_once(__DIR__ . "/Raca.php");
require_once(__DIR__ . "/Afiliacao.php");

class Personagem {

    private ?int $id = null;
    private ?string $nome = null;
    private ?int $idade = null;
    private ?string $akumaNoMi = null;
    private ?Raca $raca = null;
    private ?Afiliacao $afiliacao = null;
    private ?float $recompensa = null;
    private ?string $descricao = null;
    private ?string $imageUrl = null;

    public function getId(): ?int { return $this->id; }
    public function setId(?int $id): self { $this->id = $id; return $this; }

    public function getNome(): ?string { return $this->nome; }
    public function setNome(?string $n): self { $this->nome = $n; return $this; }

    public function getIdade(): ?int { return $this->idade; }
    public function setIdade(?int $idade): self { $this->idade = $idade; return $this; }

    public function getAkumaNoMi(): ?string { return $this->akumaNoMi; }
    public function setAkumaNoMi(?string $v): self { $this->akumaNoMi = $v; return $this; }

    public function getRaca(): ?Raca { return $this->raca; }
    public function setRaca(?Raca $r): self { $this->raca = $r; return $this; }

    public function getAfiliacao(): ?Afiliacao { return $this->afiliacao; }
    public function setAfiliacao(?Afiliacao $a): self { $this->afiliacao = $a; return $this; }

    public function getRecompensa(): ?float { return $this->recompensa; }
    public function setRecompensa(?float $v): self { $this->recompensa = $v; return $this; }

    public function getDescricao(): ?string { return $this->descricao; }
    public function setDescricao(?string $d): self { $this->descricao = $d; return $this; }

    public function getImageUrl(): ?string { return $this->imageUrl; }
    public function setImageUrl(?string $u): self { $this->imageUrl = $u; return $this; }
}
