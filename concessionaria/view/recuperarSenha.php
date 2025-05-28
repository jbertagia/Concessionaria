<?php
require_once __DIR__ . '/../config/csrf.php';
if (session_status() === PHP_SESSION_NONE) session_start();

$erro = $_GET['erro'] ?? null;
$sucesso = $_GET['sucesso'] ?? null;
?>

<h1>Recuperar Senha</h1>

<?php if ($erro === 'usuario'): ?>
    <p style="color:red">Usuário não encontrado.</p>
<?php elseif ($erro === 'dtnasc'): ?>
    <p style="color:red">Data de nascimento não confere.</p>
<?php elseif ($erro === 'senha'): ?>
    <p style="color:red">As senhas não coincidem ou são muito curtas.</p>
<?php elseif ($sucesso === 'ok'): ?>
    <p style="color:green">Senha redefinida com sucesso!</p>
    <p><a href="index.php?pagina=login">Faça Login</a></p>
<?php endif; ?>

<?php if ($sucesso !== 'ok'): ?>
<div class="filtro-container">
    <form method="POST" action="index.php?pagina=processarRecuperacao">
        <input type="hidden" name="csrf_token" value="<?= gerarTokenCSRF() ?>">
        <label>Usuário:</label><input type="text" name="usuario" required><br>
        <label>Data de Nascimento:</label><input type="date" name="dtnasc" required><br>
        <label>Nova Senha:</label><input type="password" name="nova" required><br>
        <label>Confirmar Nova Senha:</label><input type="password" name="confirmar" required><br>
        <input type="submit" value="Redefinir Senha">
    </form>
</div>
<?php endif; ?>
