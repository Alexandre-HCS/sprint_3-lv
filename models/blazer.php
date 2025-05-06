<?php
namespace Models;
use Interfaces\Locavel;

// Classe que representa um carro

class Blazer extends Roupa implements Locavel{

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