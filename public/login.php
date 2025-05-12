<?php
// Incluir o Autoloas do composer para carregar automaticamente as classes utilizadas
require_once __DIR__ . '/../vendor/autoload.php';

// Incluir o arquivo com as variáveis
// Uso o DIR para mostrar qual diretório devo puxar o arquivo
require_once __DIR__ . '/../config/config.php';

// Iniciar a sessão
session_start();

// Inserir a classe de autenticação
use Services\Auth;

// Inicializa a variável para as mensagens de erro
$mensagem = '';

// Instanciar a classe de autenticação
$auth = new Auth();

// Verificar se já foi autenticado
if(Auth::verificarLogin()){
    // Direcionar usuário para a tela principal
    header('Location: index.php');
    exit;
}

// Se o usuário não estiver logado / verifica se o formulário está correto
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Se a verificação na tela de login receber os dados de NOME e SENHA, ou envia para a outra tela, ou mostra a mensagem de erro
    if($auth->login($username, $password)){
        header('Location: index.php');
        exit;
    } else {
        $mensagem = 'Falha ao executar o login! Verifique se o usuário e a senha estão corretos.';
    }
}
?>


<!-- Front End -->
<!DOCTYPE html>
 <html lang="pt-br">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Locadora de Veículos</title>
    <!-- Link Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Link ícones do bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <link rel="stylesheet" href="load-css.php">

    <!-- CSS Interno -->
    <style>
        .login-container {
            max-width: 400px;
            margin: auto;
            margin-bottom: 50px;
        }

        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }

        header img {
            max-height: 200px;
        }

        header {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card-header {
            background-color: #735943;
            text-align: center;
            color: #FFFFFF;
        }

        h4 {
            font-weight: 600;
            font-size: 1.3rem;
        }

        .card {
            border: none;
            border-radius: 10px;
        }

        .card-body {
            background-color: #9D9383;
            border-radius: 0px 0px 10px 10px;
        }

        .form-label {
            color: #FFFFFF;
            font-weight: 600;
            font-size: 1.2rem;
        }

        .custom-btn {
            background-color: #A27E60 !important;
            /* Sobrescreve o Bootstrap */
            color: white;
            border: none;
            transition: ease 0.3s;
            font-size: 1.2rem;
        }

        input {
            height: 45px;
            background-color: #E1DDD9;
            opacity: 80%;
        }

        input::placeholder {
            color: #735943 !important;
            font-size: 0.9rem;
        }

        @media (max-width: 768px) {
            .card {
                margin-left: 20px;
                margin-right: 20px;
            }
        }
    </style>

</head>
<body>
    <header class="header">
        <img src="../assets/logo-lavie.png" alt="Logo Lavie" class="logo">
    </header>
    <div class="login-container">

    <!-- Criação de Cards Bootstrap -->
        <div class="card">
            <!-- Título do card -->
            <div class="card-header p-3">
                <h4 class="mb-1">Login</h4>
            </div>

            <!-- Corpo do card -->
            <div class="card-body">

            <?php if ($mensagem): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($mensagem) ?></div>
                <?php endif; ?>
                <form method="post" class="needs-validation" novalidate>
                    <!-- Input - hidden | não aparece -->
                    <!-- Ele busca informações no JSON para validação, o usuário não vê -->
                    <!-- <input type="hidden"> -->

                    <div class="mb-4">
                        <label for="username" class="form-label">
                            Usuário:
                        </label>
                        <input type="text" name="username" class="form-control" required autocomplete="off" placeholder="Digite seu usuário aqui..." id="username">
                    </div>
                    <!-- <div class="mb-4">
                        <label for="email" class="form-label">
                            E-Mail:
                        </label>
                        <input type="text" name="username" class="form-control"  autocomplete="off" placeholder="Digite seu usuário aqui..." id="username">
                    </div> -->
                    <div class="mb-4 position-relative">
                        <label for="password" class="form-label">
                            Senha:
                        </label>
                        <input type="password" name="password" class="form-control" required placeholder="Digite sua senha aqui..." id="password">

                        <span class="password-toggle mt-3" onclick="togglePassword()">
                            <i class="bi bi-eye-slash" id="olho"></i>
                        </span>
                    </div>
                    <button type="submit" class="btn custom-btn col-md-3 d-block mx-auto mb-2 mt-2">Entrar</button>
                </form>
            </div>
        </div>
    </div>


    <script>
        function togglePassword() {
            // Alterna o tipo do campo de senha entre "password" e "text"
            let passwordInput = document.getElementById('password');
            passwordInput.type = (passwordInput.type === 'password') ? 'text' : 'password';

            // Alterna a classe do ícone
            let olho = document.getElementById('olho');
            if (olho.classList.contains('bi-eye')) {
                olho.classList.replace('bi-eye', 'bi-eye-slash');
            } else {
                olho.classList.replace('bi-eye-slash', 'bi-eye');
            }
        }
    </script>
</body>
</html>
