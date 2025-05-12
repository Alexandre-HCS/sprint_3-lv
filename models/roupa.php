<?php
namespace Models;

// Classe abstrata para todos os tipos de Roupas

abstract class Roupa{
    protected string $nome;
    protected string $marca;
    protected bool $disponivel;

    public function __construct(string $nome, string $marca){
        $this -> nome = $nome;
        $this -> marca = $marca;  
        $this -> disponivel = true;          
    }

    // Função para cálculo de aluguel
    abstract public function calcularAluguel(int $dias) : float;

    public function isDisponivel ():bool {
        return $this->disponivel;
    }
    public function getNome(): string {
        return $this->nome;
    }
    
    public function getMarca(): string {
        return $this->marca;
    }

    public function setDisponivel(bool $disponivel):void{
        $this->disponivel = $disponivel; 
    }
}

?>