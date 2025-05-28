<?php
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['login'] !== 'administrador') {
    echo "<p style='color:red; margin: 20px;'>Acesso restrito.</p>";
    return;
}

require_once __DIR__ . "/../controller/UsuarioController.php";

$usuarios = UsuarioController::listarTodos();
?>

<h1>Gerenciar Usuários</h1>
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
                        <a href="index.php?pagina=desbloquearUsuario&id=<?= $u['id'] ?>">Desbloquear</a>
                    <?php else: ?>
                        <a href="index.php?pagina=bloquearUsuario&id=<?= $u['id'] ?>">Bloquear</a>
                    <?php endif; ?>
                <?php else: ?>
                    -
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
