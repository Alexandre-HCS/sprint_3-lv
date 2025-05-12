<?php
namespace Models;

// Classe abstrata para todos os tipos de Roupas

abstract class Roupa {
    private string $nome;
    private string $marca;
    private bool   $disponivel;
    protected string $foto = '';

    public function __construct(string $nome, string $marca, string $foto = '') {
        $this->nome       = $nome;
        $this->marca      = $marca;
        $this->disponivel = true;
        $this->foto       = $foto;
    }
    // Função para cálculo de aluguel
    abstract public function calcularAluguel(int $dias) : float;

    public function isDisponivel ():bool {
        return $this->disponivel;
    }
    public function getNome(): string {
        return $this->nome;
    }

    public function setFoto(string $foto): void {
        $this->foto = $foto;
    }

    public function getFoto(): string {
        return $this->foto;
    }

    public function getMarca(): string {
        return $this->marca;
    }

    public function setDisponivel(bool $disponivel):void{
        $this->disponivel = $disponivel; 
    }
}

?>