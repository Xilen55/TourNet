<?php
$archivo = basename($_SERVER['PHP_SELF']);
$es_index = $archivo === 'Index.php';
$es_panel = in_array($archivo, ['admin_panel.php', 'cliente_panel.php']);
?>

<header class="main-header">
  <div class="logo-nombre">
    <img src="logo.png" alt="Logo" class="logo">
    <span class="titulo">TourNet</span>
  </div>
  <?php if (!$es_index): ?>
  <div class="volver">
    <?php if (!$es_panel): ?>
      <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin'): ?>
        <a href="admin_panel.php" class="btn-volver">🏠 Inicio</a>
      <?php elseif (isset($_SESSION['rol']) && $_SESSION['rol'] === 'cliente'): ?>
        <a href="cliente_panel.php" class="btn-volver">🏠 Inicio</a>
      <?php endif; ?>
    <?php endif; ?>
    <a href="Cerrar_Sesion.php" class="btn-volver">🔓 Cerrar sesión</a>
  </div>
  <?php endif; ?>
</header>