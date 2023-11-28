<?php
class DB
{
    private static $conexion = null;

    public static function abreconexion()
    {
        if (self::$conexion == null) {
            try {
                $conn = new PDO('mysql:host=localhost;dbname=proyectobecas', 'marcos', '1234');
                return $conn;
            } catch (PDOException $e) {
                echo "No se ha podido conectar: " . $e->getMessage();
                return null;
            }
        }
    }
}