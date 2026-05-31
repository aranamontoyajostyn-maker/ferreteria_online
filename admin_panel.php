<?php
include 'includes/auth.php';
if ($_SESSION['rol'] != 'admin') {
    header("Location: ventas_panel.php");
    exit();
}
include 'includes/header.php';
include 'config/conexion.php';

// Consulta para contar productos (dato extra para el admin)
$query = "SELECT COUNT(*) as total FROM productos";
$resultado = mysqli_query($conexion, $query);
$datos = mysqli_fetch_assoc($resultado);
$total_productos = $datos['total'];
?>

<div class="container mt-5">
    <h2 class="mb-4">Dashboard de Administración</h2>
    
    <div class="row">
        <div class="col-md-4">
            <div class="card bg-info text-white mb-3">
                <div class="card-body">
                    <h5>Inventario Total</h5>
                    <h3><?php echo $total_productos; ?></h3>
                    <p>Productos registrados</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-primary text-white mb-3">
                <div class="card-body">
                    <h5>Gestionar Productos</h5>
                    <p>Agregar, editar o eliminar.</p>
                    <a href="productos.php" class="btn btn-light btn-sm">Ir a Inventario</a>
                </div>
            </div>
        </div>
        
      <div class="col-md-4">
    <div class="card bg-success text-white mb-3">
        <div class="card-body">
            <h5>Usuarios</h5>
            <p>Controlar acceso de empleados.</p>
            <a href="usuarios.php" class="btn btn-light btn-sm">Gestionar Usuarios</a>
        </div>
    </div>
</div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>