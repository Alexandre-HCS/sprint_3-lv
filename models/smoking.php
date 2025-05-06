<?php
namespace Models;
use Interfaces\Locavel;

// Classe que representa um carro

class Smoking extends Roupa implements Locavel{

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