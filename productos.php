<?php
include 'includes/auth.php'; 
include 'config/conexion.php';
include 'includes/header.php'; 
?>

<div class="container mt-5">
    <div class="mb-3">
        <a href="admin_panel.php" class="btn btn-secondary btn-sm">&laquo; Volver al Panel</a>
    </div>
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
                
                if ($_SESSION['rol'] == 'admin') {
                    echo "<td>
                            <a href='editar_producto.php?id={$row['id']}' class='btn btn-warning btn-sm'>Editar</a>
                            <a href='config/eliminar_producto.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"¿Estás seguro de eliminar este producto?\")'>Eliminar</a>
                          </td>";
                }
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php if ($_SESSION['rol'] == 'admin'): ?>
<div class="modal fade" id="modalProducto" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="config/agregar_producto.php" method="POST">
        <div class="modal-header">
          <h5 class="modal-title">Registrar Nuevo Producto</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Nombre del Producto</label>
            <input type="text" name="nombre" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Precio</label>
            <input type="number" name="precio" class="form-control" step="0.01" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Stock</label>
            <input type="number" name="stock" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Guardar Producto</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php endif; ?>

<?php include 'includes/footer.php'; ?>