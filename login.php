<?php
// Realizar la conexión a la base de datos (asegúrate de configurar tus credenciales)
$servername = "localhost";
$username = "admin";
$password = "admin";
$dbname = "ua";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Inicializar variables para mensajes
$loginError = "";

// Comprobar si el formulario fue enviado usando GET
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['user']) && isset($_GET['password'])) {
    // Obtener las credenciales del formulario
    $user = $_GET['user'];
    $pass = $_GET['password'];

    // Preparar y ejecutar la consulta SQL para verificar las credenciales
    $sql = $conn->prepare("SELECT * FROM usuarios WHERE Usuario = ? AND Contraseña = ?");
    $sql->bind_param("ss", $user, $pass);
    $sql->execute();
    $result = $sql->get_result();

    // Comprobar si la consulta devuelve algún resultado
    if ($result->num_rows > 0) {
        // Credenciales correctas, iniciar sesión
        session_start();
        $_SESSION['username'] = $user;
        header("Location: index.php");
        exit;
    } else {
        // Credenciales incorrectas, mostrar mensaje de error
        $loginError = "Error: Usuario o contraseña incorrectos.";
    }

    // Cerrar la consulta
    $sql->close();
}

// Cerrar la conexión
$conn->close();
?>

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

<div class="container">
  <div class="login-container">
    <div class="login-header">
      <img src="fotos/foto usuario.webp" alt="foto usuario">
      <div class="circle"></div>
    </div>
    <form action="login.php" method="get">
      <div class="form-group">
        <img src="fotos/perfil usuario 2.png" alt="Usuario">
        <input type="text" name="user" placeholder="user" required>
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
      <button type="submit">Login</button>
    </form>
    <?php
    // Mostrar mensaje de error si existe
    if ($loginError != "") {
        echo "<p style='color:red;'>$loginError</p>";
    }
    ?>
    <p class="register-link">¿No tienes cuenta? <a href="registro.php">Regístrate</a></p>
  </div>
</div>
</body>
</html>
