<!DOCTYPE html>
<html lang='es'>
<head>
  <meta charset='UTF-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
  <title>TourNet - Login</title>
</head>
<?php include 'header.php'; ?>
<body>
  <h2>Login</h2>
  <form method='POST' action='login.php'>
    <input type='email' name='email' placeholder='Email' required><br>
    <input type='password' name='contraseña' placeholder='Contraseña' required><br>
    <button type='submit'>Entrar</button>
  </form>
  <h2>Registro</h2>
  <form method='POST' action='registro.php'>
    <input type='text' name='nombre' placeholder='Nombre completo' required><br>
    <input type='email' name='email' placeholder='Email' required><br>
    <input type='password' name='contraseña' placeholder='Contraseña' required><br>
    <button type='submit'>Registrarse</button>
  </form>
</body>
</html>