<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'cliente') {
    header('Location: Index.php');
    exit;
}
include 'conexion.php';
$id_usuario = $_SESSION['id_usuario'];
$res = $conn->query("SELECT c.id_producto, c.cantidad, p.precio FROM carrito c 
JOIN productos p ON c.id_producto = p.id_producto WHERE c.id_usuario = $id_usuario");

$total = 0;
$items = [];
while ($row = $res->fetch_assoc()) {
    $items[] = $row;
    $total += $row['cantidad'] * $row['precio'];
}

if ($total > 0) {
    $conn->query("INSERT INTO compras (id_usuario, total) VALUES ($id_usuario, $total)");
    $id_compra = $conn->insert_id;

    foreach ($items as $item) {
        $conn->query("INSERT INTO detalle_compras (id_compra, id_producto, cantidad, precio_unitario)
                      VALUES ($id_compra, {$item['id_producto']}, {$item['cantidad']}, {$item['precio']})");
    }

    $conn->query("DELETE FROM carrito WHERE id_usuario = $id_usuario");
    $mensaje = "✅ Compra realizada con éxito. Total: $" . $total;
} else {
    $mensaje = "⚠️ Tu carrito está vacío.";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Compra</title>
  <link rel="stylesheet" href="estilos.css">
</head>
<?php include 'header.php'; ?>
<body>
  <h1>Finalizar Compra</h1>
  <div class="panel-container">
    <div class="panel-card">
      <p><?= $mensaje ?></p>
    </div>
  </div>
</body>
</html>