<?php
session_start();
include 'config/conexion.php';
include 'includes/header.php';

// Si recibimos un ID, lo añadimos al carrito
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Capturamos la cantidad enviada por el formulario, por defecto es 1
    $cantidad = isset($_GET['cantidad']) ? (int)$_GET['cantidad'] : 1;
    
    $query = mysqli_query($conexion, "SELECT * FROM productos WHERE id = $id");
    $producto = mysqli_fetch_assoc($query);

    if ($producto) {
        // Contamos cuántos hay ya en el carrito para este producto específico
        $en_carrito = 0;
        if (!empty($_SESSION['carrito'])) {
            foreach ($_SESSION['carrito'] as $item) {
                if ($item['id'] == $id) $en_carrito++;
            }
        }

        // Solo añadimos si la suma de lo que ya hay + lo nuevo no supera el stock real
        if (($en_carrito + $cantidad) <= $producto['stock']) {
            // Agregamos tantas veces como el usuario haya solicitado
            for ($i = 0; $i < $cantidad; $i++) {
                $_SESSION['carrito'][] = [
                    'id' => $producto['id'],
                    'nombre' => $producto['nombre'],
                    'precio' => $producto['precio']
                ];
            }
        } else {
            echo "<script>alert('¡No hay suficiente stock disponible para esa cantidad!');</script>";
        }
    }
}
?>

<div class="container mt-5">
    <h2>Carrito de Compras</h2>
    <hr>
    <table class="table table-hover mt-4">
        <thead class="table-dark">
            <tr>
                <th>Producto</th>
                <th>Precio</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $total = 0;
            if (!empty($_SESSION['carrito'])) {
                // Usamos $i como índice para identificar qué producto borrar
                foreach ($_SESSION['carrito'] as $i => $item) {
                    echo "<tr>
                            <td>{$item['nombre']}</td>
                            <td>$ " . number_format($item['precio'], 2) . "</td>
                            <td>
                                <a href='eliminar_carrito.php?id=$i' class='btn btn-danger btn-sm'>Quitar</a>
                            </td>
                          </tr>";
                    $total += $item['precio'];
                }
            } else {
                echo "<tr><td colspan='3' class='text-center'>Tu carrito está vacío</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <div class="d-flex justify-content-between align-items-center mt-3">
        <h4>Total a pagar: $ <?php echo number_format($total, 2); ?></h4>
        <div>
            <a href="ventas_panel.php" class="btn btn-secondary">Atrás</a>
            <?php if (!empty($_SESSION['carrito'])): ?>
                <a href="finalizar_venta.php" class="btn btn-primary">Finalizar Compra</a>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>