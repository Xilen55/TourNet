<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    header('Location: Index.php');
    exit;
}
include 'conexion.php';

$res = $conn->query("
    SELECT dc.id_detalle, u.nombre, p.descripcion, c.fecha_compra, dc.cantidad, dc.precio_unitario, c.total, c.estado
    FROM detalle_compras dc 
    INNER JOIN compras c ON c.id_compra = dc.id_compra
    INNER JOIN productos p ON p.id_producto = dc.id_producto
    INNER JOIN usuarios u ON u.id_usuario = c.id_usuario
    ORDER BY c.fecha_compra DESC
");
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Pedidos a Confirmar</title>
  <link rel="stylesheet" href="estilos.css">
</head>
<?php include 'header.php'; ?>
<body>
  <h1>Pedidos del Sistema</h1>
  <div class="panel-container">
    <?php while ($row = $res->fetch_assoc()): ?>
      <div class="panel-card">
        <h3>Compra #<?= $row['id_detalle'] ?></h3>
        <p><strong>Cliente:</strong> <?= $row['nombre'] ?></p>
        <p><strong>Producto:</strong> <?= $row['descripcion'] ?></p>
        <p><strong>Cantidad:</strong> <?= $row['cantidad'] ?></p>
        <p><strong>Precio Unitario:</strong> <?= $row['precio_unitario'] ?></p>
        <p><strong>Precio Total:</strong> $<?= $row['total'] ?></p>
        <p><strong>Fecha:</strong> <?= $row['fecha_compra'] ?></p>
        <p><strong>Estado:</strong> <?= $row['estado'] ?></p>
        <form method="POST" action="Confirmar_Pedido.php">
          <input type="hidden" name="id_detalle" value="<?= $row['id_detalle'] ?>">
          <select name="nuevo_estado" required>
            <option value="" disabled selected>Cambiar estado</option>
            <option value="pendiente">Pendiente</option>
            <option value="confirmado">Confirmado</option>
            <option value="anulado">Anulado</option>
          </select>
          <button type="submit">Actualizar</button>
        </form>
      </div>
    <?php endwhile; ?>
  </div>
</body>
</html>