<!DOCTYPE html>
<html lang='es'>
<head>
  <meta charset='UTF-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
  <title>TourNet - Inicio</title>
  <link rel='stylesheet' href='estilos.css'>
</head>
<body>
  <h1>Bienvenido a TourNet</h1>

  <div class='contenedor-form'>
    <h2>Login</h2>
    <form method='POST' action='login.php'>
      <input type='email' name='email' placeholder='Correo electrónico' required>
      <input type='password' name='contraseña' placeholder='Contraseña' required>
      <button type='submit'>Entrar</button>
    </form>
  </div>

  <div class='contenedor-form'>
    <h2>Registro</h2>
    <form method='POST' action='registro.php'>
      <input type='text' name='nombre' placeholder='Nombre completo' required>
      <input type='email' name='email' placeholder='Correo electrónico' required>
      <input type='password' name='contraseña' placeholder='Contraseña' required>
      <button type='submit'>Registrarse</button>
    </form>
  </div>
</body>
</html>