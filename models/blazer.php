<?php
namespace Models;
use Interfaces\Locavel;

// Classe que representa um carro

class Blazer extends Roupa implements Locavel{

    private bool $disponivel = true; // Indica se a Blazer está disponível para aluguel
    private string $nome; // Nome da Blazer

    public function __construct(string $nome) {
        $this->nome = $nome;
    }

    public function calcularAluguel(int $dias): float 
    {
        return $dias * DIARIA_BLAZER;
    }

    public function alugar(): string {
        if ($this->disponivel){
            $this->disponivel = false;
            return "Blazer '{$this->nome}' alugado com sucesso!";
        }
        return "Blazer '{$this->nome}' não disponível.";
    }

    public function devolver(): string {
        if (!$this->disponivel){
            $this->disponivel = true;
            return "Blazer '{$this->nome}' devolvido com sucesso!";
        }
        return "Blazer '{$this->nome}' está disponível.";
    }
    
}

?>