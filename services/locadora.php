<?php
namespace Services;

use Models\{Roupa, Terno_c, Smoking, Blazer, Vestido_l, Vestido_c, Vestido_d};

// classe para gerenciar a locação
class Locadora {
    private array $roupas = [];

    public function __construct(){
        $this->carregarRoupas();
        return 0.0; // Default return value if no match is found
    }

    private function carregarRoupas(): void {
        if (file_exists(ARQUIVO_JSON)){

            // decodifica o arquivo JSON
            $dados = json_decode(file_get_contents(ARQUIVO_JSON),true);

            foreach ($dados as $dado){

                if ($dado['tipo']=== 'Terno_c'){
                    $roupa = new Terno_c($dado['nome'], $dado['marca'], $dado['foto']);
                } elseif ($dado['tipo'] === 'Smoking') {
                    $roupa = new Smoking($dado['nome'], $dado['marca'], $dado['foto']);
                } elseif ($dado['tipo'] === 'Blazer') {
                    $roupa = new Blazer($dado['nome'], $dado['marca'], $dado['foto']);
                } elseif ($dado['tipo'] === 'Vestido_l') {
                    $roupa = new Vestido_l($dado['nome'], $dado['marca'], $dado['foto']);
                } elseif ($dado['tipo'] === 'Vestido_c') {
                    $roupa = new Vestido_c($dado['nome'], $dado['marca'], $dado['foto']);
                } elseif ($dado['tipo'] === 'Vestido_d') {
                    $roupa = new Vestido_d($dado['nome'], $dado['marca'], $dado['foto']);
                }
                        $roupa->setDisponivel($dado['disponivel']);
                        $this->roupas[] = $roupa;
                    }
                }
            }

    // Salvar Roupas
    private function salvarRoupas(): void{
        $dados = [];

        foreach($this->roupas as $roupa){
            $dados[] = [
                'tipo' => ($roupa instanceof \Models\Terno_c ? 'Terno_c' : ($roupa instanceof \Models\Smoking ? 'Smoking' : ($roupa instanceof \Models\Blazer ? 'Blazer' : ($roupa instanceof \Models\Vestido_l ? 'Vestido_l' : ($roupa instanceof \Models\Vestido_c ? 'Vestido_c' : 'Vestido_d'))))),
                'nome' => $roupa -> getNome(),
                'marca' => $roupa -> getMarca(),
                'disponivel' => $roupa -> isDisponivel()
            ];
        }

        $dir = dirname(ARQUIVO_JSON);

        if (!is_dir($dir)){
            mkdir($dir, 0777, true);
        }

        file_put_contents(ARQUIVO_JSON, json_encode($dados, JSON_PRETTY_PRINT));
        
    }

    // Adicionar nova roupa
    public function adicionarRoupa(Roupa $roupa): string{

        // verifica se já existe
        foreach ($this->roupas as $roupa){
            if($roupa->getNome() === $roupa->getNome() && $roupa->getMarca() === $roupa->getMarca()){
                return "Roupa já cadastrada!";
            }
        }

        // adiciona a roupa
        $this->roupas[] = $roupa;

        // Salvar o novo estado
        $this->salvarRoupas();
        return "Roupa '{$roupa->getNome()}' adicionada com sucesso!";
    }

    //Remover roupa
    public function deletarRoupa(string $nome, string $marca): string{

        foreach ($this->roupas as $key => $roupa){

            // verifica se nome e marca correspondem
            if($roupa->getNome() === $nome && $roupa->getMarca() === $marca){
                // remove o Roupa do array
                unset($this->roupas[$key]);

                // reorganizar os indices
                $this->roupas = array_values($this->roupas);

                // Salvar o novo estado
                $this->salvarRoupas();
                return "Vestimenta '{$nome}' removido com sucesso!";
            }
        }
        return "Roupa não encontrado!";
    }

    // Alugar Roupa por n dias
    public function alugarRoupa(string $nome, int $dias = 1): string{

        // percorre a lista de Roupas
        foreach($this->roupas as $roupa){

            if($roupa->getNome() === $nome && $roupa->isDisponivel()){

                // calcular valor do aluguel
                $valorAluguel = $roupa->calcularAluguel($dias);

                // Marcar como alugado
                $mensagem = $roupa->alugar();

                $this->salvarRoupas();

                return $mensagem . "Valor do aluguel: R$" . number_format($valorAluguel, 2, ',', '.');
            }
        }
        return "Roupa não disponível";
    }

    // Devolver Roupa

    public function devolverRoupa(string $nome) :string{

        // Percorrer a lista
        foreach($this->roupas as $roupa){

            if($roupa->getNome() === $nome && !$roupa->isDisponivel()){

                // disponibilizar o Roupa
                $mensagem = $roupa->devolver();

                $this->salvarRoupas();
                return $mensagem;
            }
        }
        return "Roupa já disponível ou não encontrado.";
    }

    // Retorna a lista de Roupas

    public function listarRoupas():array{
        return $this->roupas;
    }

    // Calcular previsão do valor
    public function calcularPrevisaoAluguel($tipo, $dias): float {

    if($tipo ==='Terno_c'){
        return (new Terno_c('','')) ->calcularAluguel($dias);
    }
    elseif ($tipo === 'Smoking') {
        return (new Smoking('','')) ->calcularAluguel($dias);
    } elseif ($tipo === 'Blazer') {
            return (new Blazer('','')) ->calcularAluguel($dias);
    } elseif ($tipo === 'Vestido_l') {
            return (new Vestido_l('','')) ->calcularAluguel($dias);
    } elseif ($tipo === 'Vestido_c') {
            return (new Vestido_c('','')) ->calcularAluguel($dias);
    } elseif ($tipo === 'Vestido_d') {
            return (new Vestido_d('','')) ->calcularAluguel($dias);
    }
    return 0.0; // Default return value if no match is found
    }
}
?>