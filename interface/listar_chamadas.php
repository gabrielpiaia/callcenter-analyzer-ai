<?php
session_start();
$user = $_SESSION['nome'];
$dir = __DIR__ . "/chamadas/$user/";
if (!is_dir($dir)) {
    mkdir($dir, 0777, true);
}

// Se foi solicitado o JSON de uma chamada específica
if (isset($_GET['json'])) {
    $base = pathinfo($_GET['json'], PATHINFO_FILENAME);
    $jsonFile = $dir . $base . '.json';
    if (file_exists($jsonFile)) {
        $jsonContent = json_decode(file_get_contents($jsonFile), true);
        echo json_encode(['json' => $jsonContent]);
    } else {
        echo json_encode(['json' => null]);
    }
    exit;
}

$arquivos = array_diff(scandir($dir), array('.', '..'));
// Apenas arquivos .wav
$arquivos_wav = array_filter($arquivos, function($f) {
    return pathinfo($f, PATHINFO_EXTENSION) === 'wav';
});
echo json_encode(array_values($arquivos_wav));
