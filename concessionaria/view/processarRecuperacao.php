<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../config/csrf.php';

if (!validarTokenCSRF($_POST['csrf_token'] ?? '')) {
    echo "Token CSRF inválido.";
    exit;
}
?>

<?php
require_once __DIR__ . "/../model/Usuario.php";

$usuario = $_POST['usuario'] ?? '';
$dtnasc = $_POST['dtnasc'] ?? '';
$nova = $_POST['nova'] ?? '';
$confirmar = $_POST['confirmar'] ?? '';

$dados = Usuario::buscar($usuario);

if (!$dados) {
    header("Location: index.php?pagina=recuperarSenha&erro=usuario");
    exit;
}

if ($dados['dtnasc'] !== $dtnasc) {
    header("Location: index.php?pagina=recuperarSenha&erro=dtnasc");
    exit;
}

if ($nova !== $confirmar || strlen($nova) < 6) {
    header("Location: index.php?pagina=recuperarSenha&erro=senha");
    exit;
}

$novaHash = password_hash($nova, PASSWORD_DEFAULT);
Usuario::atualizarSenha($dados['id'], $novaHash);

header("Location: index.php?pagina=recuperarSenha&sucesso=ok");
exit;
