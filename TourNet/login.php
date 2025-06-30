<?php
session_start();
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $clave = $_POST['contraseña'];

    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $usuario = $resultado->fetch_assoc();
        if (password_verify($clave, $usuario['contraseña'])) {
            $_SESSION['id_usuario'] = $usuario['id_usuario'];
            $_SESSION['rol'] = $usuario['rol'];
            if ($usuario['rol'] === 'admin') {
                header("Location: admin_panel.php");
            } else {
                header("Location: cliente_panel.php");
            }
            exit;
        }
    }
    echo "<p>Usuario o contraseña incorrectos</p>";
}
?>