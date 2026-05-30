<?php
// Incluimos la conexión que creamos antes
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['usuario'];
    $pass = $_POST['password'];

    // Consulta para validar al usuario
    $query = "SELECT * FROM usuarios WHERE usuario = '$user' AND password = '$pass'";
    $resultado = mysqli_query($conexion, $query);

    if (mysqli_num_rows($resultado) == 1) {
        echo "¡Bienvenido al sistema!";
        // Aquí luego crearemos la sesión
    } else {
        echo "Usuario o contraseña incorrectos";
    }
}
?>