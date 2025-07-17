<?php
session_start();
header('Content-Type: application/json');
if (!isset($_SESSION['nome'])) {
    echo json_encode(['sucesso' => false, 'erro' => 'Usuário não autenticado.']);
    exit;
}
$user = $_SESSION['nome'];
$dir = __DIR__ . "/chamadas/$user/";
if (!is_dir($dir)) {
    mkdir($dir, 0777, true);
}
if (!isset($_FILES['arquivo']) || $_FILES['arquivo']['error'] !== UPLOAD_ERR_OK) {
    echo json_encode(['sucesso' => false, 'erro' => 'Arquivo não enviado ou erro no upload.']);
    exit;
}
$nome = basename($_FILES['arquivo']['name']);
if (strtolower(pathinfo($nome, PATHINFO_EXTENSION)) !== 'wav') {
    echo json_encode(['sucesso' => false, 'erro' => 'Somente arquivos .wav são permitidos.']);
    exit;
}
$destino = $dir . $nome;
if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $destino)) {
    echo json_encode(['sucesso' => true]);
} else {
    echo json_encode(['sucesso' => false, 'erro' => 'Falha ao salvar arquivo.']);
}
