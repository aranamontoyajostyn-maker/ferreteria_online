<?php
// Comentario: Este archivo verifica si hay una sesión activa
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}
// Fin de la protección
?>