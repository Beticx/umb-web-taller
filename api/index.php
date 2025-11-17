<?php
// Configuración de CORS: Permite solicitudes desde cualquier dominio (tu frontend React)
header("Access-Control-Allow-Origin: *"); 
header("Content-Type: application/json; charset=UTF-8"); 
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");

// Manejar la pre-petición OPTIONS (requerida por CORS antes de POST/PUT/DELETE)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit(0);
}

require_once 'modelo.php';

$metodo = $_SERVER['REQUEST_METHOD'];
// Captura datos del cuerpo para POST/PUT (JSON)
$datos = json_decode(file_get_contents('php://input'), true);
// Captura el ID de la URL (Query Parameter)
$id = isset($_GET['id']) ? (int)$_GET['id'] : null;

switch ($metodo) {
    case 'GET':
        $tareas = obtenerTareas();
        echo json_encode($tareas);
        break;
        
    case 'POST':
        if (isset($datos['titulo'])) {
            crearTarea($datos['titulo']);
            echo json_encode(['mensaje' => 'Tarea creada']);
        } else {
            http_response_code(400);
            echo json_encode(['mensaje' => 'Título no provisto']);
        }
        break;
        
    case 'PUT':
        // Se requiere el ID en el Query string (ej: ?id=1) y datos en el cuerpo
        if ($id && isset($datos['completada'])) {
            actualizarTarea($id, (bool)$datos['completada']);
            echo json_encode(['mensaje' => "Tarea $id actualizada"]);
        } else {
            http_response_code(400);
            echo json_encode(['mensaje' => 'Faltan ID o datos para actualizar']);
        }
        break;

    case 'DELETE':
        if ($id) {
            eliminarTarea($id);
            echo json_encode(['mensaje' => "Tarea $id eliminada"]);
        } else {
            http_response_code(400);
            echo json_encode(['mensaje' => 'ID no provisto para eliminar']);
        }
        break;
        
    default:
        http_response_code(405); 
        echo json_encode(['mensaje' => 'Método no permitido']);
        break;
}
?>