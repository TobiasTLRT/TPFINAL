<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('conexion1.php');

$mensaje = '';

try {
    // Verificar si se ha enviado el formulario para agregar un nuevo registro
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Verificar si se han proporcionado todos los campos necesarios
        if (isset($_POST['nombre'], $_POST['tipo'], $_POST['talla'], $_POST['precio'])) {
            $nombre = $conn->real_escape_string($_POST['nombre']);
            $tipo = $conn->real_escape_string($_POST['tipo']);
            $talla = $conn->real_escape_string($_POST['talla']);
            $precio = $conn->real_escape_string($_POST['precio']);

            // Consulta preparada para evitar inyección SQL
            $sql = $conn->prepare("INSERT INTO admin.info (nombre, tipo, talla, precio) VALUES (?, ?, ?, ?)");
            $sql->bind_param("ssss", $nombre, $tipo, $talla, $precio);

            if ($sql->execute()) {
                $mensaje = "Nuevo registro agregado correctamente.";
                echo "Operación de inserción exitosa.";
            } else {
                $mensaje = "Error al agregar el registro: " . $sql->error;
                $mensaje .= " - Código de error: " . $sql->errno;
                // Agregar esta línea para imprimir el error detallado
                echo "Error detallado: " . $conn->error;
            }

            $sql->close(); // Cerrar la consulta preparada
        } else {
            $mensaje = "Por favor, completa todos los campos.";
        }
    }

    // Verificar si se ha enviado la solicitud de eliminar un registro
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['eliminar'])) {
        $eliminar_id = $conn->real_escape_string($_GET['eliminar']);

        // Consulta SQL para eliminar el registro
        $eliminar_sql = "DELETE FROM admin.info WHERE id = $eliminar_id";

        if ($conn->query($eliminar_sql)) {
            $mensaje = "Registro eliminado correctamente.";
            echo "Operación de eliminación exitosa.";
        } else {
            $mensaje = "Error al eliminar el registro: " . $conn->error;
            // Agregar esta línea para imprimir el error detallado
            echo "Error detallado: " . $conn->error;
        }
    }

    // Consulta SQL para obtener la información de los clientes
    $sql = "SELECT id, nombre, tipo, talla, precio FROM admin.info";
    $resultado = $conn->query($sql);

} catch (Exception $e) {
    $mensaje = "Error: " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Panel de Administrador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>Tabla para agregar</h2>

            <?php if (!empty($mensaje)) : ?>
                <div class="alert alert-info" role="alert">
                    <?php echo $mensaje; ?>
                </div>
            <?php endif; ?>

            <form method="post" action="">
                <div class="mb-3">
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" name="nombre" required>
                </div>
                <div class="mb-3">
                    <label for="tipo">Tipo</label>
                    <input type="text" id="tipo" name="tipo" required>
                </div>
                <div class="mb-3">
                    <label for="talla">Talla</label>
                    <input type="text" id="talla" name="talla" required>
                </div>
                <div class="mb-3">
                    <label for="precio">Precio</label>
                    <input type="text" id="precio" name="precio" required>
                </div>
                <button type="submit" class="btn btn-primary">Agregar Registro</button>
            </form>

            <?php if ($resultado) : ?>
                <?php if ($resultado->num_rows > 0) : ?>
                    <table class="table table-bordered mt-4">
                        <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Tipo</th>
                            <th>Talla</th>
                            <th>Precio</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php while ($row = $resultado->fetch_assoc()) : ?>
                            <tr>
                                <td><?php echo $row['nombre']; ?></td>
                                <td><?php echo $row['tipo']; ?></td>
                                <td><?php echo $row['talla']; ?></td>
                                <td><?php echo $row['precio']; ?></td>
                                <td>
                                    <a href="editar.php?id=<?php echo $row['id']; ?>" class="btn btn-warning">Editar</a>
                                    <a href="admin.php?eliminar=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este registro?')">Eliminar</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                        </tbody>
                    </table>
                <?php else : ?>
                    <p>No hay información de clientes.</p>
                <?php endif; ?>
            <?php else : ?>
                <p>Error al ejecutar la consulta: <?php echo $conn->error; ?></p>
            <?php endif; ?>
              <div class="cliente">
            <br>
            <a href="index.php">Ver pagina del cliente</a>
        </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>

