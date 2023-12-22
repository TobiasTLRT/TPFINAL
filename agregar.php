<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (
        isset($_POST['nombre']) &&
        isset($_POST['tipo']) &&
        isset($_POST['talla']) &&
        isset($_POST['precio'])
    ) {
        $nombre = $conn->real_escape_string($_POST['nombre']);
        $tipo = $conn->real_escape_string($_POST['tipo']);
        $talla = $conn->real_escape_string($_POST['talla']);
        $precio = $conn->real_escape_string($_POST['precio']);

        $stmt = $conn->prepare("INSERT INTO info (nombre, tipo, talla, precio) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nombre, $tipo, $talla, $precio);

        if ($stmt->execute()) {
            echo "Registro exitoso";
            header("Location: formulario.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    }
}
?>
