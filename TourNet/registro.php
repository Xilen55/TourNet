<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $clave = password_hash($_POST['contraseña'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO usuarios (nombre, email, contraseña) VALUES (?, ?, ?);");
    $stmt->bind_param("sss", $nombre, $email, $clave);
    $stmt->execute();
    header("Location: Index.php");
}
?>