<?php
require_once __DIR__ . "/../controller/UsuarioController.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario'])) {
    echo "Acesso negado.";
    exit;
}

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['login'] !== 'administrador') {
    echo "Acesso restrito.";
    include "footer.php";
    exit;
}

$usuarios = UsuarioController::listarTodos();
// var_dump($usuarios); // debug opcional

?>

<h2>Lista de Usuários</h2>
<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Usuário</th>
        <th>Status</th>
        <th>Ação</th>
    </tr>
    <?php foreach ($usuarios as $u): ?>
        <tr>
            <td><?= $u['id'] ?></td>
            <td><?= $u['nome'] ?></td>
            <td><?= $u['login'] ?></td>
            <td><?= $u['bloqueado'] ? 'Bloqueado' : 'Ativo' ?></td>
            <td>
                <?php if ($u['login'] !== 'administrador'): ?>
                    <?php if ($u['bloqueado']): ?>
                        <a href="desbloquearUsuario.php?id=<?= $u['id'] ?>">Desbloquear</a>
                    <?php else: ?>
                        <a href="bloquearUsuario.php?id=<?= $u['id'] ?>">Bloquear</a>
                    <?php endif; ?>
                <?php else: ?>
                    -
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
