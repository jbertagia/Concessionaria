<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../config/csrf.php';
// var_dump($_SESSION); // debug: sessão antes de processar login

$usuario = $_POST['usuario'] ?? '';
$senha = $_POST['senha'] ?? '';
$redirect = $_POST['redirect'] ?? 'index.php';
$token = $_POST['csrf_token'] ?? '';

if (!validarTokenCSRF($token)) {
    echo "Token CSRF inválido.";
    exit;
}

require_once __DIR__ . '/../model/Usuario.php';

$dados = Usuario::buscar($usuario);

if ($dados) {
    if ($dados['bloqueado']) {
        header("Location: index.php?pagina=login&erro=bloqueado&redirect=$redirect");
        exit;
    }

    if (password_verify($senha, $dados['senha'])) {
        $_SESSION['usuario'] = $dados;
        header("Location: $redirect");
        exit;
    }
}

header("Location: index.php?pagina=login&erro=invalido&redirect=$redirect");
exit;
?>