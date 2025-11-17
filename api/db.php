<?php
// db.php - Conexión usando variables de entorno (Railway)
$host = getenv('MYSQLHOST') ?: '127.0.0.1';
$port = getenv('MYSQLPORT') ?: 3306;
$user = getenv('MYSQLUSER') ?: 'root';
$pass = getenv('MYSQLPASSWORD') ?: '';
$db   = getenv('MYSQLDATABASE') ?: 'railway';

$conexion = mysqli_init();
mysqli_real_connect($conexion, $host, (int)$port, $user, $pass, $db);

// Validación
if (mysqli_connect_errno()) {
    http_response_code(500);
    header('Content-Type: application/json');
    echo json_encode(["error" => "Error al conectar a MySQL: " . mysqli_connect_error()]);
    exit();
}
?>
