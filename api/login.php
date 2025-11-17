<?php
session_start(); // Inicia o reanuda la sesión

if (isset($_POST['usuario'])) {
    // Simulación simple de inicio de sesión
    $_SESSION["usuario"] = htmlspecialchars($_POST['usuario']); 
    echo "Sesión iniciada para " . $_SESSION["usuario"];
} elseif (isset($_GET['logout'])) {
    // Cierra la sesión
    session_destroy();
    echo "Sesión cerrada.";
} elseif (isset($_SESSION["usuario"])) {
    echo "Sesión activa para " . $_SESSION["usuario"];
} else {
    echo "Sistema de sesión: Envía 'usuario' por POST para iniciar sesión.";
}
?>