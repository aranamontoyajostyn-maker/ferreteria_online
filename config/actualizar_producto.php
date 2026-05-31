<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];

    $query = "UPDATE productos SET nombre='$nombre', precio='$precio', stock='$stock' WHERE id=$id";
    
    if (mysqli_query($conexion, $query)) {
        header("Location: ../productos.php");
    } else {
        echo "Error al actualizar: " . mysqli_error($conexion);
    }
}
?>