<?php
namespace Models;
use Interfaces\Locavel;

// Classe que representa um carro

class Smoking extends Roupa implements Locavel{
    private bool $disponivel = true; // Define a property to track availability
    private string $nome; // Define a property to store the name of the smoking

    public function __construct(string $nome) {
        $this->nome = $nome;
    }

    public function calcularAluguel(int $dias): float 
    {
        return $dias * DIARIA_SMOKING;
    }

    public function alugar(): string {
        if ($this->disponivel){
            $this->disponivel = false;
            return "Smoking '{$this->nome}' alugado com sucesso!";
        }
        return "Smoking '{$this->nome}' não disponível.";
    }

    public function devolver(): string {
        if (!$this->disponivel){
            $this->disponivel = true;
            return "Smoking '{$this->nome}' devolvido com sucesso!";
        }
        return "Smoking '{$this->nome}' está disponível.";
    }
    
}

?>