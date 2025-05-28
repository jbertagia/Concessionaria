<?php
require_once __DIR__ . "/../model/Usuario.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    echo "Token CSRF inválido.";
    exit;
}

}

$nome = $_POST['nome'] ?? '';
$usuario = $_POST['usuario'] ?? '';
$senha = $_POST['senha'] ?? '';
$confirmar = $_POST['confirmar'] ?? '';
$dtnasc = $_POST['dtnasc'] ?? '';

// var_dump($_POST); // debug opcional

if ($senha !== $confirmar) {
    header("Location: index.php?pagina=cadastro&erro=senhadiferente");
    exit;
}
if (strlen($senha) < 6) {
    header("Location: index.php?pagina=cadastro&erro=senhaminima");
    exit;
}

$senhaHash = password_hash($senha, PASSWORD_DEFAULT);
$dados = ['nome' => $nome, 'usuario' => $usuario, 'senha' => $senhaHash];
$resultado = Usuario::cadastrar($nome, $usuario, $senha, $dtnasc);

if ($resultado) {
    header("Location: index.php?pagina=login&sucesso=cadastro");
    exit;
} else {
    header("Location: index.php?pagina=cadastro&erro=cadastro");
    exit;
}
?>