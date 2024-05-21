<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registro</title>
<link rel="stylesheet" href="style/registro.css">

<script src="https://kit.fontawesome.com/8f5be8334f.js" crossorigin="anonymous"></script>


<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poetsen+One&display=swap" rel="stylesheet">
<link rel="stylesheet" href="fontello-10643fc5/css/fontello.css">
</head>
<body>
<!--
  <header>
    <div id="izq">
        <nav>
            <input type="checkbox" id="menu">
            <label for="menu"><i class="fa-solid fa-bars" id="label_header"></i></label>
            <ul id="ul_menu">
                <li class="link_menu">Link 1</li>
                <li class="link_menu">Link 2</li>
                <li class="link_menu">Link 3</li>
                <li class="link_menu">Link 4</li>
            </ul>
        </nav>

        <img src="fotos/gato.jpg" alt="logo" id="logo">

    </div>

    <div id="cen">
        <i class="fa-solid fa-house"></i>

        <i class="fa-solid fa-compass"></i>

        <i class="fa-solid fa-user"></i>

        <i class="fa-solid fa-plus"></i>

    </div>
    <div id="dch">
        <p>Mosaicua</p>
    </div>
</header>
-->

<div class="container">
  <h1 class="bienvenido">¡Bienvenido!</h1>
  <p class="mensaje">Por favor, ingresa tus datos personales.</p>
  <div class="registro-container">
    <form action="#" method="post">
      <div class="form-group">
        <input type="text" id="nombre" name="nombre" placeholder="Nombre" required>
      </div>
      <div class="form-group">
        <input type="text" id="apellidos" name="apellidos" placeholder="Apellidos" required>
      </div>
      <div class="form-group">
        <input type="email" id="email" name="email" placeholder="Correo electrónico" required>
      </div>
      <div class="form-group">
        <input type="password" id="password" name="password" placeholder="Contraseña" required>
      </div>
      <div class="form-group">
        <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirmar contraseña" required>
      </div>
      <div class="form-group checkbox">
        <input type="checkbox" id="aceptar" required>
        <label for="aceptar">Aceptar términos y condiciones</label>
      </div>
      <button type="submit" class="registro-btn"><a href="index.php">Registrarse</a></button>
    </form>
  </div>
  <p class="login-link">¿Ya tienes cuenta? <a href="login.php">Iniciar sesión</a></p>
</div>


</body>
</html>