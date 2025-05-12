<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Incluir o autoload
require_once __DIR__ . '/../vendor/autoload.php';

// Incluir o arquivo com as variáveis
require_once __DIR__ . '/../config/config.php';

session_start();
// Importar as classes locadora e auth
use Services\{Locadora, Auth};

// Importar as classes Carro e Moto
use Models\{Terno_c, Smoking, Blazer, Vestido_l, Vestido_c, Vestido_d};

// Verificar se o usuário está logado
if(!Auth::verificarLogin()){
    header('Location: login.php');
    exit;
}

// Condição para logout
if (isset($_GET['logout'])){
    (new Auth())->logout();
    header('Location: login.php');
    exit;
}

// Criar uma instância da classe locadora
$locadora = new Locadora();

$mensagem = '';

$usuario = Auth::getUsuario();

// Verificar dados do formulário via POST
if($_SERVER['REQUEST_METHOD'] === 'POST'){

    // Verifico em qual login está (ADM/Usuário)
    if(isset($_POST['adicionar']) || isset($_POST['deletar']) || isset($_POST['alugar']) || isset($_POST['devolver'])){
        if(!Auth::isAdmin()){
            $mensagem = "Você não tem permissão para realizar essa ação";
            goto renderizar;
        }
    }

    if (isset($_POST['adicionar'])) {
        // 1) Dados do formulário
        $nome  = $_POST['nome']  ?? '';
        $marca = $_POST['marca'] ?? '';
        $tipo  = $_POST['tipo']  ?? '';
    
        // 2) Inicializa fotoPath com padrão
        $fotoPath = 'uploads/default.png';
    
        // 3) Processa o upload antes de instanciar
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/uploads/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0775, true);
            }
            $fileName   = uniqid() . '-' . basename($_FILES['foto']['name']);
            $targetFile = $uploadDir . $fileName;
            if (!move_uploaded_file($_FILES['foto']['tmp_name'], $targetFile)) {
                die('Falha ao mover o arquivo de imagem.');
            }
            // caminho relativo usado no JSON e na exibição
            $fotoPath = 'uploads/' . $fileName;
        }
    
        // 4) Instancia a roupa **uma vez** usando $fotoPath
        switch ($tipo) {
            case 'Terno_c':
                $roupa = new Terno_c($nome, $marca, $fotoPath);
                break;
            case 'Smoking':
                $roupa = new Smoking($nome, $marca, $fotoPath);
                break;
            case 'Blazer':
                $roupa = new Blazer($nome, $marca, $fotoPath);
                break;
            case 'Vestido_l':
                $roupa = new Vestido_l($nome, $marca, $fotoPath);
                break;
            case 'Vestido_c':
                $roupa = new Vestido_c($nome, $marca, $fotoPath);
                break;
            case 'Vestido_d':
                $roupa = new Vestido_d($nome, $marca, $fotoPath);
                break;
            default:
                die('Tipo de roupa inválido.');
        }
    
        // 5) Adiciona e redireciona
        $locadora->adicionarRoupa($roupa);
        header('Location: index.php?sucesso=1');
        exit;
    }
    

    elseif(isset($_POST['alugar'])){
        $dias = isset($_POST['dias']) ? (int)$_POST['dias'] : 1;
        $mensagem = $locadora->alugarRoupa($_POST['nome'], $dias);
    }
    elseif(isset($_POST['devolver'])){
        $mensagem = $locadora->devolverRoupa($_POST['nome']);
    }
    elseif(isset($_POST['deletar'])){
        $mensagem = $locadora->deletarRoupa($_POST['nome'], $_POST['marca']);
    }
    elseif(isset($_POST['calcular'])){
        $dias = (int)$_POST['dias_calculo'];
        $tipo = $_POST['tipo_calculo'];
        $valor = $locadora->calcularPrevisaoAluguel($dias, $tipo);

        $mensagem = "Previsão de valor para {$dias} dias: R$" . number_format($valor, 2, ',','.');
    }
}

renderizar:
require_once __DIR__ . '/../views/template.php';