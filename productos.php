<?php
// Comentario: Protegemos la página con el archivo auth.php
include 'includes/auth.php'; 
include 'config/conexion.php';
// Incluimos nuestro header que contiene los CDN de Bootstrap y DataTables
include 'includes/header.php'; 
?>

<div class="container mt-5">
    <h2>Inventario de Ferretería</h2>
    <hr>
    <table id="tablaProductos" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Stock</th>
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
                        <td>{$row['stock']}</td>
                      </tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php 
// Comentario: Incluimos el footer que tiene los scripts de DataTables
include 'includes/footer.php'; 
?>