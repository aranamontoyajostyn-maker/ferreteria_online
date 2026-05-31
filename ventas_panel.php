<?php
include 'includes/auth.php';
include 'includes/header.php';
include 'config/conexion.php';
?>

<div class="container mt-5">
    <h2>Realizar Venta</h2>
    <div class="mb-3">
        <input type="text" id="buscador" class="form-control" placeholder="Buscar producto por nombre...">
    </div>

    <table class="table table-hover">
        <thead class="table-dark">
            <tr>
                <th>Producto</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = mysqli_query($conexion, "SELECT * FROM productos WHERE stock > 0");
            while ($row = mysqli_fetch_assoc($query)) {
                echo "<tr>
                        <td>{$row['nombre']}</td>
                        <td>$ {$row['precio']}</td>
                        <td>{$row['stock']}</td>
                        <td>
                            <form action='carrito.php' method='GET' class='d-flex'>
                                <input type='hidden' name='id' value='{$row['id']}'>
                                <input type='number' name='cantidad' value='1' min='1' max='{$row['stock']}' class='form-control form-control-sm me-2' style='width: 70px;'>
                                <button type='submit' class='btn btn-success btn-sm'>Añadir</button>
                            </form>
                        </td>
                      </tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include 'includes/footer.php'; ?>