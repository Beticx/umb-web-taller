<?php
require_once 'db.php';

function crearTarea($titulo) {
    global $conexion;
    $titulo_seguro = mysqli_real_escape_string($conexion, htmlspecialchars($titulo));
    $sql = "INSERT INTO tareas (titulo) VALUES ('$titulo_seguro')";
    return mysqli_query($conexion, $sql);
}

function obtenerTareas() {
    global $conexion;
    $sql = "SELECT * FROM tareas ORDER BY id DESC";
    $resultado = mysqli_query($conexion, $sql);
    $tareas = [];
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $tareas[] = $fila;
    }
    return $tareas;
}

function actualizarTarea($id, $completada) {
    global $conexion;
    $id = (int)$id;
    $completada = $completada ? 1 : 0;
    $sql = "UPDATE tareas SET completada = $completada WHERE id = $id";
    return mysqli_query($conexion, $sql);
}

function borrarTarea($id) {
    global $conexion;
    $id = (int)$id;
    $sql = "DELETE FROM tareas WHERE id = $id";
    return mysqli_query($conexion, $sql);
}
?>
