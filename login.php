<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Inicio de sesión</title>

<link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poetsen+One&display=swap" rel="stylesheet">
<link rel="stylesheet" href="style/style.css">
<link rel="stylesheet" href="fontello-10643fc5/css/fontello.css">
<link rel="stylesheet" href="style/login.css">
</head>
<body class="login-body">
  <!--
<header>
  <div id="izq">
      <nav>
          <input type="checkbox" id="menu">
          <label for="menu" id="label_header"><i class="fa-solid fa-bars"></i></label>
          <ul id="ul_menu">
              <li class="link_menu"><a href="#">Link 1</a></li>
              <li class="link_menu"><a href="#">Link 2</a></li>
              <li class="link_menu"><a href="#">Link 3</a></li>
              <li class="link_menu"><a href="#">Link 4</a></li>
          </ul>
      </nav>

      <img src="fotos/gato.jpg" alt="logo" id="logo">
  </div>


    <div id="cen">
      <a href="index.php"><i class="fa-solid fa-house"></i></a>

      <a href="buscar.php"><i class="fa-solid fa-compass"></i></a>

      <a href="subidos.php"><i class="fa-solid fa-user"></i></a>

      <a href="crearDoc.php"><i class="fa-solid fa-plus"></i></a>
      
      <a href="login.php"><i class="fa-solid fa-sign-in-alt"></i></a>
    </div>

    <div id="dch">
        <p>Mosaicua</p>
    </div>
</header>
 -->

<div class="container">
  <div class="login-container">
    <div class="login-header">
      <img src="fotos/foto usuario.webp" alt="foto usuario">
      <div class="circle"></div>
    </div>
    <form action="#" method="post">
      <div class="form-group">
        <img src="fotos/perfil usuario 2.png" alt="Usuario">
        <input type="email" name="email" placeholder="Email ID" required>
      </div>
      <div class="form-group2">
        <img src="fotos/candado.png" alt="Contraseña">
        <input type="password" name="password" placeholder="Contraseña" required>
      </div>
      <div class="checkbox">
        <input type="checkbox" id="remember">
        <label for="remember">Recuérdame</label>
        <a href="#">¿Olvidaste tu contraseña?</a>
      </div>
      <button type="submit" class="login-btn"><a href="index.php">Iniciar Sesión</a></button>
    </form>
    <p class="register-link">¿No tienes cuenta? <a href="registro.php">Regístrate</a></p>
  </div>
</div>
</body>
</html>
