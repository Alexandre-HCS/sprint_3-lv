<?php
namespace Models;

// Classe abstrata para todos os tipos de veículos

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
    public function getModelo(): string {
        return $this->nome;
    }
    
    public function getPlaca(): string {
        return $this->marca;
    }

    public function setDisponivel(bool $disponivel):void{
        $this->disponivel = $disponivel; 
    }
}

?>