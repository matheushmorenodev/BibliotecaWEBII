<?php
// Configuração de conexão com o banco de dados
$host = 'localhost';
$user = 'root'; // Altere se necessário
$pass = 'root';
$db = 'biblioteca';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die('Erro de conexão: ' . $conn->connect_error);
}
?> 