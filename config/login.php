<?php
// Comentario: Iniciamos sesión y conectamos a la BD
session_start();
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['usuario'];
    $pass = $_POST['password'];

    // Consulta para validar al usuario
    $query = "SELECT * FROM usuarios WHERE usuario = '$user' AND password = '$pass'";
    $resultado = mysqli_query($conexion, $query);

    if (mysqli_num_rows($resultado) == 1) {
        $fila = mysqli_fetch_assoc($resultado);
        
        // Guardamos los datos en la sesión
        $_SESSION['usuario'] = $fila['usuario'];
        $_SESSION['rol'] = $fila['rol'];
        $_SESSION['user_id'] = $fila['id']; // <--- LÍNEA AGREGADA: Guarda el ID del usuario
        
        // Redirigir según el rol
        if ($fila['rol'] == 'admin') {
            header("Location: ../admin_panel.php");
        } else {
            header("Location: ../ventas_panel.php");
        }
        exit(); // Es importante poner exit después de un header location
        
    } else {
        echo "Usuario o contraseña incorrectos. <a href='../index.php'>Volver al login</a>";
    }
}
?>