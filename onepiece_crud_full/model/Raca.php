<?php
class Raca {

    private ?int $id = null;
    private ?string $nome = null;

    public function __construct(int $id = null) {
        $this->id = $id;
    }

    public function getId(): ?int { return $this->id; }
    public function setId(?int $id): void { $this->id = $id; }

    public function getNome(): ?string {
        
        return $this->nome ?? null;
    }
    public function setNome(?string $nome): void { $this->nome = $nome; }

    public function __toString(): string {
        return $this->nome ?? "";
    }
}
