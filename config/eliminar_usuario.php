<?php
include 'conexion.php';
session_start();

// Solo permitir si es admin
if ($_SESSION['rol'] == 'admin' && isset($_GET['id'])) {
    $id = $_GET['id'];
    mysqli_query($conexion, "DELETE FROM usuarios WHERE id = $id");
}
header("Location: ../usuarios.php");
?>