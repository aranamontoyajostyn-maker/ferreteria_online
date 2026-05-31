<?php
session_start();
include 'config/conexion.php';

if (empty($_SESSION['carrito'])) {
    header("Location: ventas_panel.php");
    exit();
}

// Si user_id no existe en la sesión, le asignamos 1 (o un ID de usuario genérico/invitado)
$id_usuario = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 1; 

$total = 0;
foreach ($_SESSION['carrito'] as $item) { $total += $item['precio']; }

// 1. Insertar en tabla ventas
$sql_venta = "INSERT INTO ventas (total, id_usuario) VALUES ($total, $id_usuario)";
if (mysqli_query($conexion, $sql_venta)) {
    $id_venta = mysqli_insert_id($conexion);

    // 2. Procesar detalles y descontar stock
    foreach ($_SESSION['carrito'] as $item) {
        // Asegúrate de que los nombres de las columnas coincidan con tu base de datos
        mysqli_query($conexion, "INSERT INTO detalle_ventas (id_venta, id_producto, cantidad, precio_unitario) 
                                 VALUES ($id_venta, {$item['id']}, 1, {$item['precio']})");
        
        mysqli_query($conexion, "UPDATE productos SET stock = stock - 1 WHERE id = {$item['id']}");
    }

    // 3. Limpiar carrito
    $_SESSION['carrito'] = [];
    echo "<script>alert('Venta realizada con éxito'); window.location='ventas_panel.php';</script>";
} else {
    echo "Error en la base de datos: " . mysqli_error($conexion);
}
?>