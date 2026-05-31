<?php
include 'includes/auth.php';
// Seguridad estricta: Solo Admin
if ($_SESSION['rol'] != 'admin') {
    header("Location: ventas_panel.php");
    exit();
}
include 'includes/header.php';
include 'config/conexion.php';
?>

<div class="container mt-5">
    <div class="mb-3">
        <a href="admin_panel.php" class="btn btn-secondary btn-sm">&laquo; Volver al Panel</a>
    </div>

    <div class="d-flex justify-content-between align-items-center">
        <h2>Gestión de Usuarios</h2>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalUsuario">
            + Agregar Nuevo Usuario
        </button>
    </div>
    <hr>

    <table class="table table-striped mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre de Usuario</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = mysqli_query($conexion, "SELECT * FROM usuarios");
            while ($row = mysqli_fetch_assoc($query)) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['usuario']}</td>
                        <td>{$row['rol']}</td>
                        <td>
                            <a href='editar_usuario.php?id={$row['id']}' class='btn btn-warning btn-sm'>Editar</a>
                            <a href='config/eliminar_usuario.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"¿Seguro que deseas eliminar este usuario?\")'>Eliminar</a>
                        </td>
                      </tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<div class="modal fade" id="modalUsuario" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="config/agregar_usuario.php" method="POST">
        <div class="modal-header">
          <h5 class="modal-title">Registrar Nuevo Empleado</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label>Usuario</label>
            <input type="text" name="usuario" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Contraseña</label>
            <input type="password" name="password" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Rol</label>
            <select name="rol" class="form-control">
              <option value="vendedor">Vendedor</option>
              <option value="admin">Administrador</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Guardar Usuario</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>