<?php
include 'includes/auth.php';
include 'config/conexion.php';
include 'includes/header.php';

$id = $_GET['id'];
$query = mysqli_query($conexion, "SELECT * FROM usuarios WHERE id = $id");
$usuario = mysqli_fetch_assoc($query);
?>

<div class="container mt-5">
    <h2>Editar Usuario</h2>
    <form action="config/actualizar_usuario.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">
        
        <div class="mb-3">
            <label>Nombre de Usuario</label>
            <input type="text" name="usuario" class="form-control" value="<?php echo $usuario['usuario']; ?>" required>
        </div>
        <div class="mb-3">
            <label>Rol</label>
            <select name="rol" class="form-control">
                <option value="vendedor" <?php if($usuario['rol'] == 'vendedor') echo 'selected'; ?>>Vendedor</option>
                <option value="admin" <?php if($usuario['rol'] == 'admin') echo 'selected'; ?>>Administrador</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="usuarios.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?php include 'includes/footer.php'; ?>