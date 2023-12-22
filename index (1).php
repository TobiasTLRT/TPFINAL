<?php
include('conexion1.php');

$sql = "SELECT id, nombre, tipo, talla, precio FROM admin.info";
$resultado = $conn->query($sql);

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos5.css">
    <title>Tienda de Ropa</title>
</head>
<body>
    <header>
        <h1>Bienvenido a Nuestra Tienda de Ropa</h1>
    </header>

    <nav>
        <a href="index.php">Inicio</a>
        <a href="productos.php">Productos</a>
        <a href="contacto.php">Contacto</a>
    </nav>

    <main>
        <section>
            <h2>Productos</h2>

            <?php
            if ($resultado) {
                if ($resultado->num_rows > 0) {
                    echo '<div class="productos-container">';
                    while ($row = $resultado->fetch_assoc()) {
                        echo '<div class="producto">';
                        echo '<p><strong>Nombre:</strong> ' . $row['nombre'] . '</p>';
                        echo '<p><strong>Tipo:</strong> ' . $row['tipo'] . '</p>';
                        echo '<p><strong>Talla:</strong> ' . $row['talla'] . '</p>';
                        echo '<p><strong>Precio:</strong> ' . $row['precio'] . '</p>';
                        echo '<button class="comprar" onclick="comprarProducto(' . $row['id'] . ')">Comprar</button>';
                        echo '<button class="carrito" onclick="agregarAlCarrito(' . $row['id'] . ')">Agregar al carrito</button>';
                        echo '</div>';
                    }
                    echo '</div>';
                } else {
                    echo '<p>No hay información de productos.</p>';
                }
            } else {
                echo '<p>Error al ejecutar la consulta: ' . $conn->error . '</p>';
            }
            ?>
        </section>

        <section>
            <h2>Contacto</h2>
            <p>¿Tienes alguna pregunta? ¡Contáctanos!</p>
            <p>Email: info@tiendaropa.com</p>
            <p>Teléfono: +123 456 789</p>
           
        </section>
    </main>

    <footer>
        <p>&copy; 2023 Tienda de Ropa</p>
    </footer>

    <script>
        function comprarProducto(id) {
            console.log('Comprar producto con ID ' + id);
        }

        function agregarAlCarrito(id) {
            console.log('Agregar al carrito producto con ID ' + id);
        }
    </script>
</body>
</html>
