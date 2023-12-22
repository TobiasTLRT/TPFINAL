<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('conexion.php');

$mensaje = "";  

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se ha enviado el formulario
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $conn->real_escape_string($_POST['username']); // Evitar inyección SQL
        $password = $conn->real_escape_string($_POST['password']); // Evitar inyección SQL

        // Consulta preparada para evitar inyección SQL
        $sql = $conn->prepare("INSERT INTO datos (usuario, CONTRASEÑA) VALUES (?, ?)");
        $sql->bind_param("ss", $username, $password);

        if ($sql->execute()) {
            $mensaje = "¡Salió todo bien! Usuario registrado.";

            // Redirigir a la tienda de ropa después del registro exitoso
            header("Location: admin.php");
            exit(); 
        } else {
            $mensaje = "Algo salió mal: " . $sql->error;
            $mensaje .= " - Código de error: " . $sql->errno;
        }

        $sql->close(); // Cerrar la consulta preparada
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="estilos1.css">
</head>
<body>
    
<div class="container">
    <div class="row justify-content-center login-container">
        <div class="col-md-6 col-lg-4">
            <?php if (!empty($mensaje)) : ?>
                <div class="alert <?php echo ($mensaje === '¡Salió todo bien! Usuario registrado.') ? 'alert-success' : 'alert-danger'; ?>" role="alert">
                    <?php echo $mensaje; ?>
                </div>
            <?php endif; ?>
            <form class="login-form" method="post" action="">
                <h2>Login</h2>
                <div class="mb-3">
                    <label for="username">Usuario</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit">Iniciar sesión</button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
