<?php
require_once '../config/config.php';

function conectarAoBancoDeDados() {
    try {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        if ($conn->connect_error) {
            throw new Exception("Erro na conexão: " . $conn->connect_error);
        }
        return $conn;
    } catch (Exception $e) {
        error_log($e->getMessage()); // Log do erro
        return null; // Retorna null em caso de erro
    }
}

?>