<?php
namespace Models;
use Interfaces\Locavel;

// Classe que representa um carro

class Vestido_l extends Roupa implements Locavel{

    // Propriedade para indicar se o vestido está disponível
    private bool $disponivel = true;

    // Propriedade para armazenar o nome do vestido
    private string $nome;

    public function calcularAluguel(int $dias): float 
    {
        return $dias * DIARIA_VESTIDO_L;
    }

    public function alugar(): string {
        if ($this->disponivel){
            $this->disponivel = false;
            return "Vestido longo '{$this->nome}' alugado com sucesso!";
        }
        return "Vestido longo '{$this->nome}' não disponível.";
    }

    public function devolver(): string {
        if (!$this->disponivel){
            $this->disponivel = true;
            return "Vestido longo '{$this->nome}' devolvido com sucesso!";
        }
        return "Vestido longo '{$this->nome}' está disponível.";
    }
    
}

?>