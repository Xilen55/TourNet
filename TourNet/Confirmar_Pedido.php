<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    header('Location: Index.php');
    exit;
}

include 'conexion.php';
$mensaje = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id_detalle'];
    $estado = $_POST['nuevo_estado'];

    $stmt = $conn->prepare("UPDATE compras SET estado = ? WHERE id_compra = ?");
    $stmt->bind_param("si", $estado, $id);
    $stmt->execute();

    $mensaje = "✅ Estado de la compra #" . $id . " actualizado a '" . $estado . "'";
} else {
    $mensaje = "⚠️ No se recibió ningún dato para actualizar.";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Actualizar Pedido</title>
  <link rel="stylesheet" href="estilos.css">
</head>
<?php include 'header.php'; ?>
<body>
  


  <div class="panel-container">
    <div class="panel-card">
      <h3><?= $mensaje ?></h3>
    </div>
  </div>
</body>
</html>