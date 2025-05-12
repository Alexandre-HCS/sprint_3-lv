<?php
namespace Models;
use Interfaces\Locavel;

// Classe que representa um carro

class Vestido_c extends Roupa implements Locavel{

    private string $nome; // Define the property to store the name of the dress
    private bool $disponivel = true; // Define the property with a default value

    public function calcularAluguel(int $dias): float 
    {
        return $dias * DIARIA_VESTIDO_C;
    }

    public function alugar(): string {
        if ($this->disponivel){
            $this->disponivel = false;
            return "Vestido curto '{$this->nome}' alugado com sucesso!";
        }
        return "Vestido curto '{$this->nome}' não disponível.";
    }

    public function devolver(): string {
        if (!$this->disponivel){
            $this->disponivel = true;
            return "Vestido curto '{$this->nome}' devolvido com sucesso!";
        }
        return "Vestido curto '{$this->nome}' está disponível.";
    }
    
}

?>