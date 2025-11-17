<?php
session_start();
header("Content-Type: application/json");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $usuario = $data['usuario'] ?? 'invitado';
    $_SESSION['usuario'] = $usuario;
    echo json_encode(['mensaje' => "Sesión iniciada para $usuario"]);
}
?>
