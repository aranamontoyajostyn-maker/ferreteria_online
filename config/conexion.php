<?php
// config/conexion.php
// Datos de conexión local
$host = "localhost";
$user = "root";
$pass = "";
$db   = "ferreteria";

// Establecemos la conexión
$conexion = mysqli_connect($host, $user, $pass, $db);

// Verificamos si la conexión funciona
if (mysqli_connect_errno()) {
    echo "Fallo al conectar a MySQL: " . mysqli_connect_error();
    exit();
}
// La conexión está activa
?>