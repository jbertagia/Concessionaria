<?php
class Banco {
    private static $pdo;

    public static function conectar() {
        if (!isset(self::$pdo)) {
            try {
                $host = "localhost";
                $dbname = "concessionaria";
                $usuario = "root";
                $senha = "";

                self::$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $usuario, $senha);
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                // var_dump("Conexão estabelecida com sucesso.");
            } catch (PDOException $e) {
                die("Erro na conexão: " . $e->getMessage());
            }
        }

        return self::$pdo;
    }
}