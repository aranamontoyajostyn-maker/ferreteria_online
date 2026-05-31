<?php
// logout.php
session_start(); // Iniciamos la sesión para poder acceder a ella
session_unset(); // Borramos todas las variables de sesión
session_destroy(); // Destruimos la sesión en el servidor

// Redirigimos al login
header("Location: index.php");
exit();
?>