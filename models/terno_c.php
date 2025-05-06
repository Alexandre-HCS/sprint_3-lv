<?php
namespace Models;
use Interfaces\Locavel;

// Classe que representa um carro

class Terno_c extends Roupa implements Locavel{

    public function calcularAluguel(int $dias): float 
    {
        return $dias * DIARIA_TERNO_C;
    }

    public function alugar(): string {
        if ($this->disponivel){
            $this->disponivel = false;
            return "Terno '{$this->nome}' alugado com sucesso!";
        }
        return "Terno '{$this->nome}' não disponível.";
    }

    public function devolver(): string {
        if (!$this->disponivel){
            $this->disponivel = true;
            return "Terno '{$this->nome}' devolvido com sucesso!";
        }
        return "Terno '{$this->nome}' está disponível.";
    }
    
}

?>