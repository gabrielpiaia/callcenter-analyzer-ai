<?php
// conexao.php
// Arquivo responsável por conectar ao banco de dados MySQL

$host = "127.0.0.1"; // Host do banco
$usuario = "root"; // Usuário do banco
$senha = "root_password123"; // Senha do banco
$banco = "sistema"; // Nome do banco de dados

// Cria a conexão
$conn = mysqli_connect($host, $usuario, $senha, $banco);

// Verifica se houve erro na conexão
if (!$conn) {
    die("Falha na conexão: " . mysqli_connect_error());
}
?> 