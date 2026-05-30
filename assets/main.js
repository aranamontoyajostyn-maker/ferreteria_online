// assets/js/main.js
$(document).ready(function() {
    // Inicializamos DataTables en la tabla de productos
    $('#tablaProductos').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json"
        }
    });
});