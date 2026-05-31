<?php
include 'includes/auth.php';
include 'config/conexion.php';
include 'includes/header.php';

// Obtenemos el ID del producto
$id = $_GET['id'];
$query = mysqli_query($conexion, "SELECT * FROM productos WHERE id = $id");
$producto = mysqli_fetch_assoc($query);
?>

<div class="container mt-5">
    <h2>Editar Producto</h2>
    <form action="config/actualizar_producto.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $producto['id']; ?>">
        
        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="nombre" class="form-control" value="<?php echo $producto['nombre']; ?>" required>
        </div>
        <div class="mb-3">
            <label>Precio</label>
            <input type="number" name="precio" class="form-control" step="0.01" value="<?php echo $producto['precio']; ?>" required>
        </div>
        <div class="mb-3">
            <label>Stock</label>
            <input type="number" name="stock" class="form-control" value="<?php echo $producto['stock']; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        <a href="productos.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?php include 'includes/footer.php'; ?>