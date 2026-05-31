<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Encriptación segura
    $rol = $_POST['rol'];

    $query = "INSERT INTO usuarios (usuario, password, rol) VALUES ('$usuario', '$password', '$rol')";
    
    if (mysqli_query($conexion, $query)) {
        header("Location: ../usuarios.php");
    } else {
        echo "Error: " . mysqli_error($conexion);
    }
}
?>