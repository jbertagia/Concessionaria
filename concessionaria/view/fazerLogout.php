<?php
session_start();
// var_dump($_SESSION); // debug: estado da sessão antes do logout
session_destroy();
header("Location: ../index.php");
exit;
?>