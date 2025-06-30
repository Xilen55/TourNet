<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    header('Location: Index.php');
    exit;
}
include 'conexion.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tipo = $_POST['tipo'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $destino = $_POST['destino'];
    $precio = $_POST['precio'];
    $duracion = $_POST['duracion_dias'];
    $fecha = $_POST['fecha_disponible'];
    $stock = $_POST['stock_disponible'];
    $imagen = $_POST['imagen_url'];

    $stmt = $conn->prepare("INSERT INTO productos (tipo, nombre, descripcion, destino, precio, duracion_dias, fecha_disponible, stock_disponible, imagen_url)
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssdiiss", $tipo, $nombre, $descripcion, $destino, $precio, $duracion, $fecha, $stock, $imagen);
    $stmt->execute();
    $mensaje = "✅ Producto insertado con éxito";
} else {
    $mensaje = "";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Insertar Producto</title>
  <link rel="stylesheet" href="estilos.css">
</head>
<?php include 'header.php'; ?>
<body>
  


  <h1>Insertar Nuevo Producto</h1>
  <div class="contenedor-form">
    <form method='POST'>
      <input name='tipo' placeholder='Tipo (pasaje, estadía, alquiler_auto, paquete)' required>
      <input name='nombre' placeholder='Nombre' required>
      <textarea name='descripcion' placeholder='Descripción'></textarea>
      <input name='destino' placeholder='Destino'>
      <input type='number' step='0.01' name='precio' placeholder='Precio' required>
      <input type='number' name='duracion_dias' placeholder='Duración (días)'>
      <input type='date' name='fecha_disponible'>
      <input type='number' name='stock_disponible' placeholder='Stock'>
      <input name='imagen_url' placeholder='URL de la imagen'>
      <button type='submit'>Insertar</button>
    </form>
    <p><?= $mensaje ?></p>
  </div>
</body>
</html>