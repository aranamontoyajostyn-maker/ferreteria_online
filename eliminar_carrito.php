<?php
session_start();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Borramos el elemento del arreglo carrito
    unset($_SESSION['carrito'][$id]);
    
    // Re-indexamos el arreglo para que no queden huecos
    $_SESSION['carrito'] = array_values($_SESSION['carrito']);
}

header("Location: carrito.php");
exit();
?>