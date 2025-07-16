<?php
// Script para criar as tabelas e inserir os dados do arquivo biblioteca.sql
// Integrantes: Pedro Galhardi, Matheus Moreno

$host = 'localhost';
$user = 'root'; // Altere se necessário
$pass = 'root';
$db = 'biblioteca'; // Banco de dados a ser criado

// Conectar ao MySQL
$conn = new mysqli($host, $user, $pass);
if ($conn->connect_error) {
    die('Erro de conexão: ' . $conn->connect_error);
}

// Criar o banco de dados se não existir
$conn->query("CREATE DATABASE IF NOT EXISTS $db");
$conn->select_db($db);

// Ler o arquivo SQL
$sql = file_get_contents(__DIR__ . '/biblioteca.sql');
if ($sql === false) {
    die('Erro ao ler o arquivo SQL.');
}

// Executar múltiplos comandos SQL
if ($conn->multi_query($sql)) {
    do {
        // Limpar resultados intermediários
        if ($result = $conn->store_result()) {
            $result->free();
        }
    } while ($conn->next_result());
    echo 'Tabelas e dados criados com sucesso!';
} else {
    echo 'Erro ao executar SQL: ' . $conn->error;
}

$conn->close();
?> 