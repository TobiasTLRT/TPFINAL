<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('conexion1.php');

$mensaje = '';

// Verificar si se ha enviado el formulario para actualizar un registro
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se han proporcionado todos los campos necesarios
    if (isset($_POST['id'], $_POST['nombre'], $_POST['tipo'], $_POST['talla'], $_POST['precio'])) {
        $id = $conn->real_escape_string($_POST['id']);
        $nombre = $conn->real_escape_string($_POST['nombre']);
        $tipo = $conn->real_escape_string($_POST['tipo']);
        $talla = $conn->real_escape_string($_POST['talla']);
        $precio = $conn->real_escape_string($_POST['precio']);

        // Consulta preparada para evitar inyección SQL
        $sql = $conn->prepare("UPDATE admin.info SET nombre = ?, tipo = ?, talla = ?, precio = ? WHERE id = ?");
        $sql->bind_param("ssssi", $nombre, $tipo, $talla, $precio, $id);

        if ($sql->execute()) {
            $mensaje = "Registro actualizado correctamente.";
        } else {
            $mensaje = "Error al actualizar el registro: " . $sql->error;
            $mensaje .= " - Código de error: " . $sql->errno;
        }

        $sql->close(); // Cerrar la consulta preparada
    } else {
        $mensaje = "Por favor, completa todos los campos.";
    }
}

// Obtener el ID del registro a editar desde la URL
if (isset($_GET['id'])) {
    $id_editar = $conn->real_escape_string($_GET['id']);

    // Consulta SQL para obtener la información del registro a editar
    $editar_sql = "SELECT id, nombre, tipo, talla, precio FROM admin.info WHERE id = $id_editar";
    $editar_result = $conn->query($editar_sql);

    if ($editar_result && $editar_result->num_rows > 0) {
        $row_editar = $editar_result->fetch_assoc();
    } else {
        $mensaje = "No se encontró el registro a editar.";
    }
} else {
    $mensaje = "No se proporcionó el ID del registro a editar.";
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Editar Registro - Panel de Administrador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="estilos4.css">
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>Editar Registro</h2>

            <?php if (!empty($mensaje)) : ?>
                <div class="alert alert-info" role="alert">
                    <?php echo htmlspecialchars($mensaje, ENT_QUOTES, 'UTF-8'); ?>
                </div>
            <?php endif; ?>

            <form method="post" action="">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($row_editar['id'], ENT_QUOTES, 'UTF-8'); ?>">
                <div class="mb-3">
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($row_editar['nombre'], ENT_QUOTES, 'UTF-8'); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="tipo">Tipo</label>
                    <input type="text" id="tipo" name="tipo" value="<?php echo htmlspecialchars($row_editar['tipo'], ENT_QUOTES, 'UTF-8'); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="talla">Talla</label>
                    <input type="text" id="talla" name="talla" value="<?php echo htmlspecialchars($row_editar['talla'], ENT_QUOTES, 'UTF-8'); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="precio">Precio</label>
                    <input type="text" id="precio" name="precio" value="<?php echo htmlspecialchars($row_editar['precio'], ENT_QUOTES, 'UTF-8'); ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Actualizar Registro</button>
            </form>

            <br>
            <a href="admin.php">Volver al Panel de Administrador</a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Cerrar la conexión a la base de datos al final del script
$conn->close();
?>
