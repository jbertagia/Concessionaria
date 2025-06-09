<?php
require_once(__DIR__ . '/../model/Peca.php');
require_once(__DIR__ . '/../config/banco.php');

class PecaController {
    public static function minhasSolicitacoes() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['usuario'])) {
            header("Location: index.php?pagina=login");
            exit;
        }

        $usuario_id = $_SESSION['usuario']['id'];
        $lista = Solicitacao::buscarTodasPorUsuario($usuario_id);
        require(__DIR__ . '/../view/minhasSolicitacoes.php');
    }

    public static function editar() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['usuario']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
            exit("CSRF inválido");
        }

        Solicitacao::atualizar(
            $_POST['id'],
            $_POST['marca'],
            $_POST['modelo'],
            $_POST['nome_peca'],
            $_POST['tipo_peca']
        );
        header("Location: index.php?pagina=minhasSolicitacoes");
    }

    public static function excluir() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['usuario']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
            exit("CSRF inválido");
        }

        Solicitacao::excluir($_GET['id']);
        header("Location: index.php?pagina=minhasSolicitacoes");
    }
}
