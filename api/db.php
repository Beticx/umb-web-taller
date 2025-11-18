<?php
// Configuración para usar las Variables de Entorno de Render
// Usamos nombres de variables únicos (DB_HOST_PUBLIC) para evitar el caching del host interno.
$DB_HOST = getenv('DB_HOST_PUBLIC'); 
$DB_USER = getenv('MYSQLUSER'); 
$DB_PASS = getenv('MYSQLPASSWORD'); 
$DB_NAME = getenv('MYSQLDATABASE'); 
$DB_PORT = getenv('MYSQLPORT'); // Lee el puerto público

// 1. Conexión usando las variables de entorno
$conexion = mysqli_connect(
    $DB_HOST, 
    $DB_USER, 
    $DB_PASS, 
    $DB_NAME,
    $DB_PORT // Usamos la variable de puerto
);

// 2. Validación de conexión
if (mysqli_connect_errno()) {
    // Si la conexión falla (por variables incorrectas o la DB apagada)
    http_response_code(500); // Internal Server Error
    echo json_encode(['error' => 'Error de conexión a la base de datos.']);
    exit();
}
?>