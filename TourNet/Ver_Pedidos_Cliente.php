<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'cliente') {
    header('Location: Index.php');
    exit;
}
include 'conexion.php';
$id_usuario = $_SESSION['id_usuario'];

$res = $conn->query("
    SELECT dc.id_detalle, p.descripcion, c.fecha_compra, dc.cantidad, dc.precio_unitario, c.total, c.estado
    FROM detalle_compras dc 
    INNER JOIN compras c ON c.id_compra = dc.id_compra
    INNER JOIN productos p ON p.id_producto = dc.id_producto
    WHERE id_usuario = $id_usuario
    ORDER BY fecha_compra DESC
");
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Mis Pedidos</title>
  <link rel="stylesheet" href="estilos.css">
</head>
<body>
  <?php include 'header.php'; ?>
  <h1>Mis Pedidos</h1>
  <div class="panel-container">
    <?php while ($row = $res->fetch_assoc()): ?>
      <div class="panel-card">
        <h3>Compra #<?= $row['id_detalle'] ?></h3>
        <p><strong>Producto:</strong> <?= $row['descripcion'] ?></p>
        <p><strong>Cantidad:</strong> <?= $row['cantidad'] ?></p>
        <p><strong>Precio Unitario:</strong> <?= $row['precio_unitario'] ?></p>
        <p><strong>Precio Total:</strong> $<?= $row['total'] ?></p>
        <p><strong>Fecha:</strong> <?= $row['fecha_compra'] ?></p>
        <p><strong>Estado:</strong> <?= ucfirst($row['estado']) ?></p>
      </div>
    <?php endwhile; ?>
  </div>
</body>
</html>