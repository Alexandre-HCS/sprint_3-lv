<?php
namespace models;

// Classe abstrata para todos ps tipos de veículos

abstract class Roupa {
    private string $nome;
    private string $marca;
    private bool   $disponivel;
        
    public function __construct(string $nome, string $marca) {
        $this->nome       = $nome;
        $this->marca      = $marca;
        $this->disponivel = true;
    }

    // Função para calculo do aluguel
    abstract public function calcularAluguel(int $dias) : float;

    public function isDisponivel():  bool {
        return $this->disponivel;
    }

    public function getNome():  string {
        return $this->nome;
    }

    public function getMarca():  string {
        return $this->marca;
    }

    public function setDisponivel(bool $disponivel) : void {
        $this->disponivel = $disponivel;
    }
}


?>