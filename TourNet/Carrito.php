<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'cliente') {
    header('Location: Index.php');
    exit;
}
include 'conexion.php';
$id_usuario = $_SESSION['id_usuario'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_producto = $_POST['id_producto'];
    $cantidad = $_POST['cantidad'];
    $stmt = $conn->prepare("INSERT INTO carrito (id_usuario, id_producto, cantidad) VALUES (?, ?, ?)");
    $stmt->bind_param("iii", $id_usuario, $id_producto, $cantidad);
    $stmt->execute();
}

$res = $conn->query("SELECT p.nombre, p.precio, c.cantidad, p.imagen_url FROM carrito c JOIN productos p ON c.id_producto = p.id_producto WHERE c.id_usuario = $id_usuario");
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Mi Carrito</title>
  <link rel="stylesheet" href="estilos.css">
</head>
<?php include 'header.php'; ?>
<body>
  


  <h1>Mi Carrito</h1>
  <div class="panel-container">
    <?php $hay_productos = false; ?>
    <?php while ($row = $res->fetch_assoc()): ?>
      <?php $hay_productos = true; ?>
      <div class="panel-card">
        <img src="<?= $row['imagen_url'] ?>" alt="Imagen">
        <h3><?= $row['nombre'] ?></h3>
        <p><strong>Cantidad:</strong> <?= $row['cantidad'] ?></p>
        <p><strong>Subtotal:</strong> $<?= $row['cantidad'] * $row['precio'] ?></p>
      </div>
    <?php endwhile; ?>
  </div>

  <?php if ($hay_productos): ?>
    <div class="contenedor-form" style="max-width:300px;">
      <form action="Insertar_Compra.php" method="POST">
        <button type="submit">Finalizar compra</button>
      </form>
    </div>
  <?php else: ?>
    <p style="text-align:center;">No tenés productos en el carrito.</p>
  <?php endif; ?>
</body>
</html>