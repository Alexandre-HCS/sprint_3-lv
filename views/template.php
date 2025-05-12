<?php
require_once __DIR__ . '/../services/Auth.php';

use Services\Auth;

$usuario = Auth::getUsuario();

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Locadora de Roupas</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="load-css.php">
    <style>
        label.form-label {
            color: #000000;
        }

        /* Wrapper para o campo de busca com ícone */
        .input-icon-wrapper {
            position: relative;
            display: block;
            max-width: 750px;
            width: 90vw;
            margin: 1rem auto;
            /* Centraliza o input na tela */
        }

        /* Estilo do input de busca */
        .input-icon-wrapper input {
            width: 100%;
            padding-left: 2.5rem;
            /* Espaço para o ícone */
            height: 38px;
            border-radius: 30px;
            border: 1px solid #ccc;
        }

        /* Ícone de busca dentro do input */
        .input-icon-wrapper i {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            color: #000000;
            font-size: 1rem;
        }

        /* Estilos responsivos para dispositivos menores */
        @media (max-width: 768px) {
            .input-icon-wrapper {
                margin: 1rem auto;
            }

            .carousel img {
                max-width: 50vh;
                max-height: 40vh;
            }

            .carousel-control-prev-icon {
                margin-left: -30px;
            }

            .carousel-control-next-icon {
                margin-right: -30px;
            }

            .card {
                margin-left: 25px;
            }
        }

        /* Ajustes de posição dos ícones do carrossel */
        .carousel-control-prev-icon {
            margin-left: -60px;
        }

        .carousel-control-next-icon {
            margin-right: -60px;
        }

        /* Cor geral do conteúdo da página */
        .container {
            color: #f0f0f0;
        }

        /* Imagens de produtos */
        .img-fluid {
            width: 200px;
            height: 250px;
            object-fit: cover;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Estilo base dos botões */
        .btn {
            font-size: 0.9rem;
            border-radius: 15px;
            transition: ease 0.3s;
        }

        /* Hover nos botões genéricos */
        .btn:hover {
            color: #FFFFFF;
            background-color: #084020;
        }

        /* Botões dentro de células da tabela */
        td .btn {
            width: 100px;
            border-radius: 0px;
        }

        /* Botão de edição personalizado */
        .custom-btn {
            background-color: #594432;
            color: #FFFFFF;
            font-size: 0.9rem;
            transition: 0.3s ease;
        }

        /* Hover no botão de edição */
        .custom-btn:hover {
            background-color: #8A694E;
            color: #000000;
        }

        /* Estilo do título principal */
        h1.text-center {
            color: #FFFFFF;
            font-family: lemonada, sans-serif;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        /* Imagem da tabela */
        .table-img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Badge de status */
        .badge {
            color: #42825D;
            font-size: 1rem;
        }

        /* Badge com status de alerta */
        .badge.warning {
            color: #AD3939;
        }

        /* Cartões personalizados */
        .card {
            background-color: #594432;
            color: #FFFFFF;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Cabeçalho da tabela */
        .table thead th {
            color: #FFFFFF;
            background-color: #594432;
            padding: 10px;
        }

        /* Limita o tamanho da row */
        .row {
            max-width: 100%;
        }

        /* Largura da célula de status */
        .status {
            width: 110px !important;
        }

        /* Estilo do botão personalizado */
        .btn-custom {
            background-color: #594432;
            color: #FFFFFF;
            transition: ease 0.3s;
        }

        /* Hover do botão personalizado */
        .btn-custom:hover {
            background-color: #8A694E;
            color: #000000;
        }

        /* Cabeçalho do modal */
        .modal-header {
            background-color: #594432;
            color: #FFFFFF;
        }

        /* Inputs e selects dentro do modal */
        .modal-body input,
        .modal-body select {
            background-color: #BFB8AE;
        }

        /* Botões dentro do modal */
        .modal-body .btn-modal {
            background-color: #A27E60;
            border-radius: 0px;
            color: #FFFFFF;
            transition: ease 0.3s;
        }

        /* Hover do botão do modal */
        .modal-body .btn-modal:hover {
            background-color: #C8C3BC;
            color: #000000;
        }

        /* Células da tabela - altura fixa e centralização vertical */
        td {
            height: 120px !important;
            vertical-align: middle !important;
            padding: 7px !important;
            text-align: center;
            border: 2px solid #000000;
        }

        /* Parágrafos dentro de <td> centralizados verticalmente */
        td p {
            margin: 0 !important;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
            /* Ocupa toda a altura da célula */
        }
    </style>
</head>

<body>
    <header class="custom-header container-fluid position-relative">
        <i class="bi bi-person-circle"></i>
        <h4>Bem vindo, <strong><?= htmlspecialchars($usuario['username']) ?></strong></h4>
        <a href="?logout=1" class="btn btn-danger"><i class="bi bi-box-arrow-right"></i> Sair</a>
    </header>
    <nav class="navbar navbar-expand-lg navbar-light">
        <?php if (Auth::isAdmin()): ?>
            <ul>
                <li>Cadastrar Produtos</li>
                <li>Produtos Cadastrados</li>
                <li>Fornecedores</li>
            </ul>
        <?php else: ?>
            <ul>
                <!-- Lista de seções navegáveis (poderia ser transformada em links reais) -->
                <li>Peças Disponiveis</li>
                <li>Promoções</li>
                <li>Alugar Peças</li>
            </ul>
        <?php endif; ?>
    </nav>
    <div class="container py-4">
        <!-- Barra superior com informações do usuário -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                </div>
            </div>
        </div>

        <?php if ($mensagem): ?>
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($mensagem) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Formulário para adicionar novo Roupa -->
        <main class="mx-5">
            <div class="row same-height-row">
                <?php if (Auth::isAdmin()): ?>

                    <h1 class="my-5">Sistema La Vie Elegance</h1>
                    <div class="col-md-6 div-custom">
                        <div class="card h-100 custom-card border-0">
                            <div class="card-header">
                                <h4 class="mb-0">Adicionar Nova Roupa</h4>
                            </div>
                            <div class="card-body custom-c-body">
                                <form method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                                    <div class="mb-3">
                                        <label for="nome" class="form-label">Nome:</label>
                                        <input type="text" name="nome" class="form-control custom-form-1" required>
                                        <div class="invalid-feedback">Informe um nome válido.</div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="marca" class="form-label">Marca:</label>
                                        <input type="text" name="marca" class="form-control custom-form-1" required>
                                        <div class="invalid-feedback">Informe uma marca válida.</div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Tipo:</label>
                                        <select name="tipo" class="form-select custom-select-1" required>
                                            <option value="Terno_c">Terno completo</option>
                                            <option value="Smoking">Smoking</option>
                                            <option value="Blazer">Blazer</option>
                                            <option value="Vestido_l">Vestido Longo</option>
                                            <option value="Vestido_c">Vestido Curto</option>
                                            <option value="Vestido_d">Vestido de debutante</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="foto">Foto da roupa:</label>
                                        <input type="file" name="foto" id="foto" accept="image/*" required>
                                    </div>
                                    <button type="submit" name="adicionar" class="btn btn-success w-100">Adicionar Roupa</button>
                                </form>
                            </div>
                        </div>
                    </div>


                    <!-- Formulário para cálculo de aluguel -->
                    <div class="col-<?= Auth::isAdmin() ? 'md-6' : '12' ?>">
                        <div class="card h-100 div-custom border-0">
                            <div class="card-header custom-c-header">
                                <h4 class="mb-0">Calcular Previsão de Aluguel</h4>
                            </div>
                            <div class="card-body custom-c-body">
                                <form method="post" class="needs-validation" novalidate>
                                    <div class="mb-3">
                                        <label for="tipo_calculo" class="form-label">Tipo de vestimenta:</label>
                                        <select name="tipo_calculo" class="form-select custom-select-1" required>
                                            <option value="Terno_c">Terno completo</option>
                                            <option value="Smoking">Smoking</option>
                                            <option value="Blazer">Blazer</option>
                                            <option value="Vestido_l">Vestido Longo</option>
                                            <option value="Vestido_c">Vestido Curto</option>
                                            <option value="Vestido_d">Vestido de debutante</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="qtd_pecas" class="form-label">Quantidade de dias:</label>
                                        <input type="number" name="dias_calculo" class="form-control custom-form-1" min="1" value="1" required>
                                    </div>
                                    <button type="submit" name="calcular" class="btn btn-success w-100">Calcular Previsão</button>
                                </form>
                                <?php if (!empty($mensagem)): ?>
                                    <div class="alert alert-info mt-3"><?= $mensagem ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
            </div>
        <?php endif; ?>
        <?php if (!Auth::isAdmin()): ?>
            <!-- Campo de pesquisa com ícone de lupa -->
            <div class="input-icon-wrapper mt-4 pesquisa">
                <input type="text"> <!-- Campo de texto para busca -->
                <i class="bi bi-search"></i> <!-- Ícone de lupa (Bootstrap Icons) -->
            </div>

            <!-- Seção principal da página contendo o carrossel de promoções -->
            <main class="container">
                <h1 class="text-center mb-3 mt-3">Promoções do Mês</h1>

                <!-- Carrossel de imagens usando componente do Bootstrap -->
                <div class="d-flex justify-content-center">
                    <div class="carousel slide" id="carouselExemplo" data-bs-ride="carousel" data-bs-interval="2000">
                        <div class="carousel-inner text-center">
                            <!-- Imagem ativa (primeira a aparecer) -->
                            <div class="carousel-item active">
                                <img src="../assets/banner1.png" alt="img 1" class="d-block mx-auto">
                            </div>
                            <!-- Segunda imagem -->
                            <div class="carousel-item">
                                <img src="../assets/banner2.png" alt="img 2" class="d-block mx-auto">
                            </div>
                            <!-- Terceira imagem -->
                            <div class="carousel-item">
                                <img src="../assets/banner3.png" alt="img 3" class="d-block mx-auto">
                            </div>
                        </div>

                        <!-- Botão anterior do carrossel -->
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExemplo"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon seta"></span>
                        </button>

                        <!-- Botão próximo do carrossel -->
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExemplo"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon seta"></span>
                        </button>
                    </div>
                </div>
            </main>

            <!-- Seção com 8 imagens de peças principais para aluguel -->
            <section class="container">
                <h1 class="text-center mb-4 mt-4">Principais Peças</h1>

                <!-- Grid responsivo com 4 colunas por linha em dispositivos médios -->
                <div class="row row-cols-1 row-cols-md-4 g-4">
                    <!-- Cada item .col representa uma peça de roupa -->
                    <div class="col text-center">
                        <img src="../assets/peca-principal1.jpg" alt="Vestido Gucci com Laço" class="img-fluid">
                        <p>Vestido Gucci com Laço</p>
                        <!-- Botões de ação -->
                        <button class="btn btn-sm custom-btn">Calcular aluguel</button>
                        <button class="btn btn-sm btn-success">Alugar peça</button>
                    </div>
                    <div class="col text-center">
                        <img src="../assets/peca-principal2.jpg" alt="Vestido Casamento Delicado" class="img-fluid">
                        <p>Vestido Casamento Delicado</p>
                        <button class="btn btn-sm custom-btn">Calcular aluguel</button>
                        <button class="btn btn-sm btn-success">Alugar peça</button>
                    </div>
                    <div class="col text-center">
                        <img src="../assets/peca-principal3.jpg" alt="Vestido Lilás Madrinha" class="img-fluid">
                        <p>Vestido Lilás Madrinha</p>
                        <button class="btn btn-sm custom-btn">Calcular aluguel</button>
                        <button class="btn btn-sm btn-success">Alugar peça</button>
                    </div>
                    <div class="col text-center">
                        <img src="../assets/peca-principal4.jpg" alt="Vestido Prata de Gala" class="img-fluid">
                        <p>Vestido Prata de Gala</p>
                        <button class="btn btn-sm custom-btn">Calcular aluguel</button>
                        <button class="btn btn-sm btn-success">Alugar peça</button>
                    </div>
                    <div class="col text-center">
                        <img src="../assets/peca-principal5.jpg" alt="Terno Noivo Azul Marinho" class="img-fluid">
                        <p>Terno Noivo Azul Marinho</p>
                        <button class="btn btn-sm custom-btn">Calcular aluguel</button>
                        <button class="btn btn-sm btn-success">Alugar peça</button>
                    </div>
                    <div class="col text-center">
                        <img src="../assets/peca-principal6.jpg" alt="Terno Masculino Rosa" class="img-fluid">
                        <p>Terno Masculino - Rosa</p>
                        <button class="btn btn-sm custom-btn">Calcular aluguel</button>
                        <button class="btn btn-sm btn-success">Alugar peça</button>
                    </div>
                    <div class="col text-center">
                        <img src="../assets/peca-principal7.jpg" alt="Camiseta Polo Masculina" class="img-fluid">
                        <p>Camiseta Polo Masculina</p>
                        <button class="btn btn-sm custom-btn">Calcular aluguel</button>
                        <button class="btn btn-sm btn-success">Alugar peça</button>
                    </div>
                    <div class="col text-center">
                        <img src="../assets/peca-principal8.jpg" alt="Calça de Terno Comum" class="img-fluid">
                        <p>Calça de Terno Comum</p>
                        <button class="btn btn-sm custom-btn">Calcular aluguel</button>
                        <button class="btn btn-sm btn-success">Alugar peça</button>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <!-- Tabela de Roupas cadastrados -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Peças Cadastradas</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped custom-c-body">
                                <thead>
                                    <tr>
                                        <th style="visibility: hidden; ">Tipo</th>
                                        <th>Foto</th>
                                        <th>Nome</th>
                                        <th>Marca</th>
                                        <th>Status</th>
                                        <?php if (Auth::isAdmin()): ?>
                                            <th>Ações</th>
                                        <?php endif; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($locadora->listarRoupas() as $roupa): ?>
                                        <tr>
                                            <td style="visibility: hidden;">
                                                <?= $roupa instanceof \Models\Terno_c ? 'Terno_c' : ($roupa instanceof \Models\Smoking ? 'Smoking' : ($roupa instanceof \Models\Blazer ? 'Blazer' : ($roupa instanceof Models\Vestido_l ? 'Vestido_l' : ($roupa instanceof Models\Vestido_c ? 'Vestido_c' : 'Vestido_d')))); ?>
                                            </td>
                                            <td>
                                                <img src="<?= htmlspecialchars($roupa->getFoto()) ?>"
                                                    alt="Foto de <?= htmlspecialchars($roupa->getNome()) ?>"
                                                    class="img-thumbnail" style="max-width:100px;">
                                            </td>
                                            <td><?= htmlspecialchars($roupa->getNome()) ?></td>
                                            <td><?= htmlspecialchars($roupa->getMarca()) ?></td>
                                            <td>
                                                <span class="badge bg-<?= $roupa->isDisponivel() ? 'success' : 'warning' ?>">
                                                    <?= $roupa->isDisponivel() ? 'Disponível' : 'Alugado' ?>
                                                </span>
                                            </td>
                                            <?php if (Auth::isAdmin()): ?>
                                                <td>
                                                    <div class="action-wrapper">
                                                        <form method="post" class="btn-group-actions">
                                                            <input type="hidden" name="nome" value="<?= htmlspecialchars($roupa->getNome()) ?>">
                                                            <input type="hidden" name="marca" value="<?= htmlspecialchars($roupa->getMarca()) ?>">

                                                            <!-- Botão Deletar (sempre disponível para admin) -->
                                                            <button type="submit" name="deletar" class="btn btn-danger btn-sm delete-btn">Deletar</button>

                                                            <!-- Botões condicionais baseados no status do Roupa -->
                                                            <div class="rent-group">
                                                                <?php if (!$roupa->isDisponivel()): ?>

                                                                    <!-- Roupa alugado: Botão Devolver -->
                                                                    <button type="submit" name="devolver" class="btn btn-warning btn-sm">Devolver</button>
                                                                <?php else: ?> <!-- Roupa disponível: Campo de dias e Botão Alugar -->
                                                                    <button type="submit" name="alugar" class="btn btn-primary btn-sm">Alugar</button>
                                                                <?php endif; ?>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </main>

    <!-- Rodapé -->
    <?php if (!Auth::isAdmin()): ?>
        <footer style="background-color: #2a1e15; color: #fff; padding: 20px 10px; text-align: center; margin-top: 30px; margin-bottom: 0; width: 100%;">
            <div style="margin-bottom: 10px; font-size: 22px;">
                <a href="#" style="color: #fff; margin: 0 15px;"><i class="bi bi-instagram"></i></a>
                <a href="#" style="color: #fff; margin: 0 15px;"><i class="bi bi-facebook"></i></a>
                <a href="#" style="color: #fff; margin: 0 15px;"><i class="bi bi-whatsapp"></i></a>
            </div>
            <p style="color: #fff; font-size: 14px;">
                La Vie Elegance © 2025 - Contato: <a href="mailto:clothes@lavieelegance.com"
                    style="color: #fff; text-decoration: none;">clothes@lavieelegance.com</a>
            </p>
        </footer>
    <?php endif; ?>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>