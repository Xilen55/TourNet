<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'cliente') {
    header('Location: Index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Panel del Cliente</title>
  <link rel="stylesheet" href="estilos.css">
</head>
<?php include 'header.php'; ?>
<body>
  <h1>Panel del Cliente</h1>
  <div class="panel-container">
    <a class="panel-card" href="Ver_Productos.php">🛍️ Ver Productos</a>
    <a class="panel-card" href="Carrito.php">🛒 Mi Carrito</a>
    <a class="panel-card" href="Insertar_Compra.php">✅ Finalizar Compra</a>
    <a class="panel-card" href="Ver_Pedidos_Cliente.php">📦 Ver Pedidos</a>
  </div>
</body>
</html>