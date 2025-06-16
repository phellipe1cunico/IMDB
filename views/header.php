<?php require_once __DIR__ . '/../models/Usuarios.php'; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMDB - Seu Catálogo de Filmes e Séries</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            padding-top: 70px; /* Espaço para a navbar fixa no topo */
        }
        .navbar-brand img {
            height: 40px; /* Ajuste o tamanho do logo se tiver um */
        }
        .card-img-top {
            width: 100%;
            height: 300px; /* Altura fixa para as imagens dos cards */
            object-fit: cover; /* Garante que a imagem cubra o espaço sem distorcer */
        }
        .card {
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: transform 0.2s ease-in-out;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .btn-action-group {
            display: flex;
            gap: 10px; /* Espaçamento entre os botões */
            margin-top: 15px;
        }
        .footer {
            text-align: center;
            padding: 20px;
            margin-top: 40px;
            background-color: #f8f9fa;
            border-top: 1px solid #e9ecef;
            color: #6c757d;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="/vitor/IMDB/inicio">
            IMDB Clone
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="/vitor/IMDB/inicio">Início</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/vitor/IMDB/filmes">Filmes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/vitor/IMDB/series">Séries</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <?php if (Usuario::estaLogado()): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user-circle"></i> Olá, <?php echo htmlspecialchars(Usuario::usuarioLogado()); ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="/vitor/IMDB/logout">Sair</a></li>
                        </ul>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/vitor/IMDB/login"><i class="fas fa-sign-in-alt"></i> Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/vitor/IMDB/cadastro"><i class="fas fa-user-plus"></i> Cadastro</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<main class="container mt-4">