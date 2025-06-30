<?php
session_start();
include 'conexion.php';
$res = $conn->query("SELECT * FROM productos");
$cliente = isset($_SESSION['rol']) && $_SESSION['rol'] === 'cliente';
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Listado de Productos</title>
  <link rel="stylesheet" href="estilos.css">
</head>
<?php include 'header.php'; ?>
<body>
  


  <h1>Catálogo de Productos</h1>
  <div class="panel-container">
    <?php while ($row = $res->fetch_assoc()): ?>
      <div class="panel-card">
        <img src="<?= $row['imagen_url'] ?>" alt="Imagen del producto">
        <h3><?= $row['nombre'] ?></h3>
        <p><?= $row['descripcion'] ?></p>
        <p><strong>Destino:</strong> <?= $row['destino'] ?></p>
        <p><strong>Precio:</strong> $<?= $row['precio'] ?></p>
        <?php if ($cliente): ?>
          <form method="POST" action="Carrito.php">
            <input type="hidden" name="id_producto" value="<?= $row['id_producto'] ?>">
            <input type="number" name="cantidad" min="1" value="1" required>
            <button type="submit">Agregar al carrito</button>
          </form>
        <?php endif; ?>
      </div>
    <?php endwhile; ?>
  </div>
</body>
</html>