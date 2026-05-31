<?php
include 'includes/auth.php';
// Redirigimos según el rol
if ($_SESSION['rol'] == 'admin') {
    header("Location: admin_panel.php");
} else {
    header("Location: ventas_panel.php");
}
exit();
?>