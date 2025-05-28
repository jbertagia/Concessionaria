<?php
require_once __DIR__ . "/../controller/UsuarioController.php";

if (isset($_GET['id'])) {
    UsuarioController::bloquear($_GET['id']);
}
header("Location: index.php?pagina=adminUsuarios");
exit;
?>