<?php
namespace Models;
use Interfaces\Locavel;

// Classe que representa um carro

class Terno_c extends Roupa implements Locavel{
    private bool $disponivel = true; // Define se o terno está disponível para aluguel
    private string $nome; // Nome do terno

    // Adiciona um construtor para inicializar o nome
    public function __construct(string $nome) {
        $this->nome = $nome;
    }

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