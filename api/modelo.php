<?php
require_once 'db.php';

// ** Funciones CRUD **

// CREATE (Crear)
function crearTarea($titulo) {
    global $conexion;
    // Uso de consultas preparadas para mayor seguridad contra inyección SQL
    $sql = "INSERT INTO tareas (titulo, completada) VALUES (?, 0)";
    $stmt = mysqli_prepare($conexion, $sql);
    
    // Si la preparación tiene éxito, vincula el parámetro y ejecuta
    if ($stmt) {
        // 's' significa que el parámetro es un string
        mysqli_stmt_bind_param($stmt, "s", $titulo); 
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return true;
    }
    return false;
}

// READ (Leer todas)
function obtenerTareas() {
    global $conexion;
    $sql = "SELECT id, titulo, completada FROM tareas ORDER BY id DESC";
    $resultado = mysqli_query($conexion, $sql);
    $tareas = [];
    while ($fila = mysqli_fetch_assoc($resultado)) {
        // Asegura que 'completada' sea un valor booleano o numérico según necesite React
        $fila['completada'] = (bool)$fila['completada']; 
        $tareas[] = $fila;
    }
    return $tareas;
}

// UPDATE (Actualizar) - Para marcar como completada
function actualizarTarea($id, $completada) {
    global $conexion;
    $sql = "UPDATE tareas SET completada = ? WHERE id = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    
    if ($stmt) {
        // 'i' para entero, 's' para string. Aquí 'i' para completada (0/1) y 'i' para id
        $completada_int = $completada ? 1 : 0;
        mysqli_stmt_bind_param($stmt, "ii", $completada_int, $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return true;
    }
    return false;
}

// DELETE (Eliminar)
function eliminarTarea($id) {
    global $conexion;
    $sql = "DELETE FROM tareas WHERE id = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return true;
    }
    return false;
}
?>