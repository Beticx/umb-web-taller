<?php
// Configuración para usar las Variables de Entorno de Render
$DB_HOST = getenv('DB_HOST');
$DB_USER = getenv('DB_USER');
$DB_PASS = getenv('DB_PASS');
$DB_NAME = getenv('DB_NAME');

// 1. Conexión usando las variables de entorno
$conexion = mysqli_connect(
    $DB_HOST, 
    $DB_USER, 
    $DB_PASS, 
    $DB_NAME,
    3306 
);

// 2. Validación de conexión
if (mysqli_connect_errno()) {
    // Es buena práctica no exponer errores internos en producción
     //error_log("Error al conectar a MySQL: " . mysqli_connect_error());
     http_response_code(500); // Internal Server Error
     echo json_encode(['error' => 'Error de conexión a la base de datos']);
     exit();
}
?>