<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    header('Location: Index.php');
    exit;
}
include 'conexion.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $conn->query("DELETE FROM productos WHERE id_producto = $id");
    echo "Producto eliminado";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Eliminar Producto</title>
  <link rel="stylesheet" href="estilos.css">
</head>
<?php include 'header.php'; ?>
<body>
  


 <h1>Eliminar Un Producto</h1>
 <div class="contenedor-form">
  <form method='GET'>
    <input name='id' placeholder='ID del producto a eliminar'>
    <button type='submit'>Eliminar</button>
  </form>
  </div>
</body>
</html>