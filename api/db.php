<?php
// Configuración para usar las Variables de Entorno de Render/Railway
// Utilizamos los nombres de variables (KEYS) que PHP debe buscar en el entorno.
// Estos DEBEN coincidir con los que tienes en Render: MYSQLHOST, MYSQLUSER, etc.

$DB_HOST = getenv('MYSQLHOST'); 
$DB_USER = getenv('MYSQLUSER'); 
$DB_PASS = getenv('MYSQLPASSWORD'); 
$DB_NAME = getenv('MYSQLDATABASE'); 
$DB_PORT = getenv('MYSQLPORT'); // Leer el puerto

// 1. Conexión usando las variables de entorno
// Se usa el orden estándar: host, user, password, dbname, port
$conexion = mysqli_connect(
    $DB_HOST, 
    $DB_USER, 
    $DB_PASS, 
    $DB_NAME,
    $DB_PORT
);

// 2. Validación de conexión
if (mysqli_connect_errno()) {
    // Si la conexión falla (por variables incorrectas, el host no existe, o la DB está apagada)
    http_response_code(500); // Internal Server Error
    echo json_encode(['error' => 'Error de conexión a la base de datos o variables de entorno incorrectas.']);
    exit();
}
// Si la conexión es exitosa, el script continúa.
?>