<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $usuario = $_POST['usuario'];
    $rol = $_POST['rol'];

    $query = "UPDATE usuarios SET usuario='$usuario', rol='$rol' WHERE id=$id";
    
    if (mysqli_query($conexion, $query)) {
        header("Location: ../usuarios.php");
    } else {
        echo "Error al actualizar: " . mysqli_error($conexion);
    }
}
?>