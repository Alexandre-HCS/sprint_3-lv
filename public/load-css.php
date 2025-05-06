<?php
// Caminho real para o CSS (ajuste conforme necessário)
$cssFile = __DIR__ . '/../css/style.css';

if (file_exists($cssFile)) {
    header("Content-Type: text/css");
    readfile($cssFile);
    exit;
} else {
    http_response_code(404);
    echo "CSS file not found.";
}
