<?php
// Configuración para usar las Variables de Entorno de Railway
// NOTA: Los nombres de las variables (KEYS) deben coincidir EXACTAMENTE
// con las que Railway genera y las que pusiste en Render.
$DB_HOST = getenv('MYSQLHOST'); 
$DB_USER = getenv('MYSQLUSER'); 
$DB_PASS = getenv('MYSQLPASSWORD'); 
$DB_NAME = getenv('MYSQLDATABASE'); 

// 1. Conexión usando las variables de entorno
$conexion = mysqli_connect(
    $DB_HOST, 
    $DB_USER, 
    $DB_PASS, 
    $DB_NAME,
    34913
); // <--- ¡EL PUNTO Y COMA FALTANTE ESTABA AQUÍ!

// 2. Validación de conexión
if (mysqli_connect_errno()) {
    // Si la conexión falla (por variables incorrectas o la DB apagada)
    http_response_code(500); // Internal Server Error
    echo json_encode(['error' => 'Error de conexión a la base de datos.']);
    exit();
}
?>