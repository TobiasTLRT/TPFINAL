<!-- formulario.php -->
<!-- formulario.php -->
<!-- formulario.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Formulario de Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="estilos4.css">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2>Formulario de Registro</h2>
                <form action="agregar.php" method="post">
                    <div class="mb-3">
                        <label for="nombre">Nombre:</label>
                        <input type="text" id="nombre" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="tipo">Tipo:</label>
                        <input type="text" id="tipo" name="tipo" required>
                    </div>
                    <div class="mb-3">
                        <label for="talla">Talla:</label>
                        <input type="text" id="talla" name="talla" required>
                    </div>
                    <div class="mb-3">
                        <label for="precio">Precio:</label>
                        <input type="text" id="precio" name="precio" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Registrar</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
