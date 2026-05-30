<?php
// Comentario: Iniciamos sesión y conectamos a la BD
session_start();
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['usuario'];
    $pass = $_POST['password'];

    // Consulta para validar (Nota: En producción se debe usar password_verify)
    $query = "SELECT * FROM usuarios WHERE usuario = '$user' AND password = '$pass'";
    $resultado = mysqli_query($conexion, $query);

    if (mysqli_num_rows($resultado) == 1) {
        $fila = mysqli_fetch_assoc($resultado);
        $_SESSION['usuario'] = $fila['usuario'];
        $_SESSION['rol'] = $fila['rol'];
        
        // Redirigir al sistema
        header("Location: ../productos.php");
    } else {
        echo "Usuario o contraseña incorrectos";
    }
}
// Fin del proceso de login
?>