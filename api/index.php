<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");

require_once 'modelo.php';

$metodo = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);

if ($metodo === 'OPTIONS') {
    http_response_code(200);
    exit();
}

switch ($metodo) {
    case 'GET':
        echo json_encode(obtenerTareas());
        break;
    case 'POST':
        if (!empty($input['titulo'])) {
            crearTarea($input['titulo']);
            echo json_encode(['mensaje' => 'Tarea creada']);
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'Falta el título']);
        }
        break;
    case 'PUT':
        if (!empty($input['id'])) {
            actualizarTarea($input['id'], $input['completada'] ?? 0);
            echo json_encode(['mensaje' => 'Tarea actualizada']);
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'Falta id']);
        }
        break;
    case 'DELETE':
        if (!empty($input['id'])) {
            borrarTarea($input['id']);
            echo json_encode(['mensaje' => 'Tarea eliminada']);
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'Falta id']);
        }
        break;
    default:
        http_response_code(405);
        echo json_encode(['mensaje' => 'Método no permitido']);
}
?>
