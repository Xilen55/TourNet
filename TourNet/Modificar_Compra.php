<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    header('Location: Index.php');
    exit;
}
include 'conexion.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $total = $_POST['total'];
    $stmt = $conn->prepare("UPDATE compras SET total = ? WHERE id_compra = ?");
    $stmt->bind_param("di", $total, $id);
    $stmt->execute();
    echo "Compra modificada";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Modificar Compra</title>
  <link rel="stylesheet" href="estilos.css">
</head>
<?php include 'header.php'; ?>
<body>
  


 <h1>Modificar Una Compra</h1>
 <div class="contenedor-form">
  <form method='POST'>
    <input name='id' placeholder='ID compra'>
    <input name='total' placeholder='Nuevo total'>
    <button type='submit'>Modificar</button>
  </form>
 </div>
</body>
</html>

