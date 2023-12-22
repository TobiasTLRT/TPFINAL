<?php
include('conexion1.php');

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $conn->real_escape_string($_GET['id']);

    // Consulta SQL para eliminar el registro
    $sql = "DELETE FROM admin.info WHERE id = $id";
    $result = $conn->query($sql);

    if ($result) {
        header("Location: admin.php");
        exit();
    } else {
        echo "Error al eliminar el registro: " . $conn->error;
    }
} else {
    echo "ID no proporcionado";
}
?>
