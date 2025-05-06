<?php
namespace Services;

use Models\{Roupa, Terno_c, Smoking, Blazer, Vestido_l, Vestido_c, Vestido_d};

// classe para gerenciar a locação
class Locadora {
    private array $roupas = [];

    public function __construct(){
        $this->carregarRoupas();
    }

    private function carregarRoupas(): void {
        if (file_exists(ARQUIVO_JSON)){

            // decodifica o arquivo JSON
            $dados = json_decode(file_get_contents(ARQUIVO_JSON),true);

            foreach ($dados as $dado){

                if ($dado['tipo']=== 'Terno_c'){
                    $roupa = new Terno_c($dado['nome'], $dado['marca']);
                } elseif ($dado['tipo'] === 'Smoking') {
                    $roupa = new Smoking($dado['nome'], $dado['marca']);
                } elseif ($dado['tipo'] === 'Blazer') {
                    $roupa = new Blazer($dado['nome'], $dado['marca']);
                } elseif ($dado['tipo'] === 'Vestido_l') {
                    $roupa = new Vestido_l($dado['nome'], $dado['marca']);
                } elseif ($dado['tipo'] === 'Vestido_c') {
                    $roupa = new Vestido_c($dado['nome'], $dado['marca']);
                } elseif ($dado['tipo'] === 'Vestido_d') {
                    $roupa = new Vestido_d($dado['nome'], $dado['marca']);
                }
                $roupa->setDisponivel($dado['disponivel']);

                $this->roupas[] = $roupa;
            }
        }
    }

    // Salvar veículos
    private function salvarVeiculos(): void{
        $dados = [];

        foreach($this->roupas as $roupa){
            $dados[] = [
                'tipo' => ($roupa instanceof \Models\Terno_c ? 'Terno_c' : ($roupa instanceof \Models\Smoking ? 'Smoking' : ($roupa instanceof \Models\Blazer ? 'Blazer' : ($roupa instanceof \Models\Vestido_l ? 'Vestido_l' : ($roupa instanceof \Models\Vestido_c ? 'Vestido_c' : 'Vestido_d'))))),
                'modelo' => $roupa -> getModelo(),
                'placa' => $roupa -> getPlaca(),
                'disponivel' => $roupa -> isDisponivel()
            ];
        }

        $dir = dirname(ARQUIVO_JSON);

        if (!is_dir($dir)){
            mkdir($dir, 0777, true);
        }

        file_put_contents(ARQUIVO_JSON, json_encode($dados, JSON_PRETTY_PRINT));
        
    }

    // Adicionar novo veículo
    public function adicionarVeiculo(Roupa $roupa): void{
        $this->roupas[] = $roupa;
        $this->salvarVeiculos();
    }

    //Remover veículo
    public function deletarVeiculo(string $nome, string $marca): string{

        foreach ($this->roupas as $key => $roupa){

            // verifica se modelo e placa correspondem
            if($roupa->getNome() === $nome && $roupa->getMarca() === $marca){
                // remove o veículo do array
                unset($this->roupas[$key]);

                // reorganizar os indices
                $this->roupas = array_values($this->roupas);

                // Salvar o novo estado
                $this->salvarVeiculos();
                return "Vestimenta '{$nome}' removido com sucesso!";
            }
        }
        return "Veículo não encontrado!";
    }

    // Alugar veículo por n dias
    public function alugarVeiculo(string $modelo, int $dias = 1): string{

        // percorre a lista de veículos
        foreach($this->veiculos as $veiculo){

            if($veiculo->getModelo() === $modelo && $veiculo->isDisponivel()){

                // calcular valor do aluguel
                $valorAluguel = $veiculo->calcularAluguel($dias);

                // Marcar como alugado
                $mensagem = $veiculo->alugar();

                $this->salvarVeiculos();

                return $mensagem . "Valor do aluguel: R$" . number_format($valorAluguel, 2, ',', '.');
            }
        }
        return "Veículo não disponível";
    }

    // Devolver veículo

    public function devolverVeiculo(string $modelo) :string{

        // Percorrer a lista
        foreach($this->veiculos as $veiculo){

            if($veiculo->getModelo() === $modelo && !$veiculo->isDisponivel()){

                // disponibilizar o veículo
                $mensagem = $veiculo->devolver();

                $this->salvarVeiculos();
                return $mensagem;
            }
        }
        return "Veículo já disponível ou não encontrado.";
    }

    // Retorna a lista de veículos

    public function listarVeiculos():array{
        return $this->veiculos;
    }

    // Calcular previsão do valor
    public function calcularPrevisaoAluguel(string $tipo, int $dias): float {

       if($tipo ==='Carro'){
            return (new Carro('','')) ->calcularAluguel($dias);
       }
       return (new Moto('','')) ->calcularAluguel($dias);
    }
}