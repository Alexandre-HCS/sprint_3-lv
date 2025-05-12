<?php
namespace Models;
use Interfaces\Locavel;

// Classe que representa um carro

class Vestido_d extends Roupa implements Locavel{

    private bool $disponivel = true; // Define the property with a default value
    private string $nome; // Define the 'nome' property

    public function __construct(string $nome) {
        $this->nome = $nome; // Initialize 'nome' in the constructor
    }

    public function calcularAluguel(int $dias): float 
    {
        return $dias * DIARIA_VESTIDO_D;
    }

    public function alugar(): string {
        if ($this->disponivel){
            $this->disponivel = false;
            return "Vestido de debutante '{$this->nome}' alugado com sucesso!";
        }
        return "Vestido de debutante '{$this->nome}' não disponível.";
    }

    public function devolver(): string {
        if (!$this->disponivel){
            $this->disponivel = true;
            return "Vestido de debutante '{$this->nome}' devolvido com sucesso!";
        }
        return "Vestido de debutante '{$this->nome}' está disponível.";
    }
    
}

?>