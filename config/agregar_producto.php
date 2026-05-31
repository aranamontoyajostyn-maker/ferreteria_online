<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];

    $query = "INSERT INTO productos (nombre, precio, stock) VALUES ('$nombre', '$precio', '$stock')";
    
    if (mysqli_query($conexion, $query)) {
        header("Location: ../productos.php?exito=1");
    } else {
        echo "Error: " . mysqli_error($conexion);
    }
}
?>