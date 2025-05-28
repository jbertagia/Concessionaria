<?php

//file_put_contents(__DIR__ . "/debug_post.txt", print_r($_POST, true), FILE_APPEND);
//file_put_contents(__DIR__ . "/debug_get.txt", print_r($_GET, true), FILE_APPEND);
//file_put_contents(__DIR__ . "/debug_server.txt", print_r($_SERVER, true), FILE_APPEND);

session_start();

require_once "controller/HomeController.php";
require_once "controller/UsuarioController.php";
require_once "controller/PagamentoController.php";
require_once "controller/VeiculoController.php";

include "view/header.php";

$pagina = $_POST['pagina'] ?? $_GET['pagina'] ?? 'home';

switch ($pagina) {
    case 'home':
        HomeController::index();
        break;
    case 'cadastro':
        include "view/cadastro.php";
        break;
    case 'fazerCadastro':
        include "view/fazerCadastro.php";
        break;
    case 'login':
        include "view/login.php";
        break;
    case 'fazerLogin':
        include "view/fazerLogin.php";
        break;
    case 'fazerLogout':
        include "view/fazerLogout.php";
        break;
    case 'anunciar':
        include "view/anunciarVeiculo.php";
        break;
    case 'cadastrarVeiculo':
        include "view/cadastrarVeiculo.php";
        break;
    case 'editarVeiculo':
        include "view/editarVeiculo.php";
        break;
    case 'excluirVeiculo':
        include "view/excluirVeiculo.php";
        break;
    case 'confirmarExclusao':
        include "view/confirmarExclusao.php";
        break;
    case 'meusVeiculos':
        include "view/meusVeiculos.php";
        break;
    case 'veiculosNovos':
        include "view/veiculosNovos.php";
        break;
    case 'veiculosUsados':
        include "view/veiculosUsados.php";
        break;
    case 'pagamento':
        include "view/pagamento.php";
        break;
    case 'realizarCompra':
        include "view/realizarCompra.php";
        break;
    case 'adminUsuarios':
        include "view/adminUsuarios.php";
        break;
    case 'bloquearUsuario':
        include "view/bloquearUsuario.php";
        break;
    case 'desbloquearUsuario':
        include "view/desbloquearUsuario.php";
        break;
    case 'recuperarSenha':
        include "view/recuperarSenha.php";
        break;
    case 'processarRecuperacao':
        include "view/processarRecuperacao.php";
        break;
    case 'solicitarPeca':
        require "view/solicitarPeca.php";
        break;
    case 'cadastrarPeca':
        require_once("view/cadastrarPeca.php");
        break;
    case 'minhasSolicitacoes':
        require "controller/PecaController.php";
        PecaController::minhasSolicitacoes();
        break;
    case 'editarSolicitacao':
        require_once("controller/PecaController.php");
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            PecaController::editar();
        } else {
            require_once("view/editarSolicitacao.php");
        }
        break;
    case 'excluirSolicitacao':
        require "controller/PecaController.php";
        PecaController::excluir();
        break;
    default:
        echo "Página não encontrada.";
}

include "view/footer.php";
