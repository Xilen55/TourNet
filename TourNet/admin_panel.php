<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    header('Location: Index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Panel del Administrador</title>
  <link rel="stylesheet" href="estilos.css">
</head>
<?php include 'header.php'; ?>
<body>
  <h1>Panel del Administrador</h1>
  <div class="panel-container">
    <a class="panel-card" href="Insertar_Producto.php">➕ Insertar Producto</a>
    <a class="panel-card" href="Modificar_Producto.php">✏️ Modificar Producto</a>
    <a class="panel-card" href="Eliminar_Producto.php">🗑️ Eliminar Producto</a>
    <a class="panel-card" href="Modificar_Compra.php">✏️ Modificar Compra</a>
    <a class="panel-card" href="Eliminar_Compra.php">🗑️ Eliminar Compra</a>
    <a class="panel-card" href="Ver_Productos.php">🛍️ Ver Productos</a>
    <a class="panel-card" href="Pedidos_Admin.php">📦 Ver Pedidos</a>
  </div>
</body>
</html>