<?php
if (session_status() === PHP_SESSION_NONE) session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Concessionária</title>
    <link rel="stylesheet" href="<?= $basePath ?? '.' ?>/public/estilo/estilo.css">
</head>

<body>
    <div class="container">
        <header>
            <nav class="nav-bar">
                <div class="nav-esquerda">
                    <a href="index.php?pagina=home">Início</a>
                    <a href="index.php?pagina=veiculosNovos">Veículos Novos</a>
                    <a href="index.php?pagina=veiculosUsados">Veículos Usados</a>
                    <a href="index.php?pagina=anunciarVeiculo">Anunciar Veículo</a>
                    <a href="index.php?pagina=meusVeiculos">Meus Veículos</a>

                    <?php if (isset($_SESSION['usuario'])): ?>
                        <a href="index.php?pagina=solicitarPeca">Solicitar Peça</a>
                        <a href="index.php?pagina=minhasSolicitacoes">Minhas Solicitações</a>
                    <?php endif; ?>
                </div>

                <div class="nav-direita">
                    <?php if (isset($_SESSION['usuario'])): ?>
                        <span>Olá, <?= $_SESSION['usuario']['nome'] ?></span>
                        <?php if ($_SESSION['usuario']['login'] === 'administrador'): ?>
                            <a href="index.php?pagina=adminUsuarios">Gerenciar Usuários</a>
                        <?php endif; ?>
                        <a href="view/fazerLogout.php">Sair</a>
                    <?php else: ?>
                        <a href="index.php?pagina=login&redirect=home">Login</a>
                        <a href="index.php?pagina=cadastro">Cadastrar</a>
                    <?php endif; ?>
                </div>
            </nav>
        </header>
