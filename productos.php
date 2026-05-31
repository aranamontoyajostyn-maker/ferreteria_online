<?php
// Incluimos la protección y la conexión
include 'includes/auth.php'; 
include 'config/conexion.php';
// Incluimos el header que ya creamos
include 'includes/header.php'; 
?>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center">
        <h2>Inventario de Ferretería</h2>
        <span class="badge bg-primary">Usuario: <?php echo $_SESSION['usuario']; ?> (<?php echo $_SESSION['rol']; ?>)</span>
    </div>
    <hr>

    <?php if ($_SESSION['rol'] == 'admin'): ?>
        <div class="mb-3">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalProducto">
                + Agregar Producto
            </button>
        </div>
    <?php endif; ?>

    <table id="tablaProductos" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Stock</th>
                <?php if ($_SESSION['rol'] == 'admin'): ?>
                    <th>Acciones</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = mysqli_query($conexion, "SELECT * FROM productos");
            while ($row = mysqli_fetch_assoc($query)) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['nombre']}</td>
                        <td>{$row['precio']}</td>
                        <td>{$row['stock']}</td>";
                
                // Si es admin, mostramos botones de edición/eliminación
                if ($_SESSION['rol'] == 'admin') {
                    echo "<td>
                            <button class='btn btn-warning btn-sm'>Editar</button>
                            <button class='btn btn-danger btn-sm'>Eliminar</button>
                          </td>";
                }
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php 
// Incluimos el footer
include 'includes/footer.php'; 
?>