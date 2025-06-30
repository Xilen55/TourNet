<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    header('Location: Index.php');
    exit;
}
include 'conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $producto = $conn->query("SELECT * FROM productos WHERE id_producto = $id")->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $stmt = $conn->prepare("UPDATE productos SET nombre=?, precio=?, stock_disponible=? WHERE id_producto=?");
    $stmt->bind_param("sdii", $nombre, $precio, $stock, $id);
    $stmt->execute();
    echo "Producto modificado";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Modificar Producto</title>
  <link rel="stylesheet" href="estilos.css">
</head>
<?php include 'header.php'; ?>
<body>
  


  <h1>Modificar Un Producto</h1>
  <div class="contenedor-form">
    <form method='POST'>
      <input type='nombre' name='id' value='<?php echo $producto["id_producto"] ?? ""; ?>' placeholder='ID producto'><br>
      <input name='nombre' value='<?php echo $producto["nombre"] ?? ""; ?>' placeholder='Nombre nuevo'><br>
      <input type='number' name='precio' value='<?php echo $producto["precio"] ?? ""; ?>' placeholder='Precio nuevo'><br>
      <input type='number' name='stock' value='<?php echo $producto["stock_disponible"] ?? ""; ?>' placeholder='Stock nuevo'><br>
      <button type='submit'>Modificar</button>
    </form>
  </div>
</body>
</html>
