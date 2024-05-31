<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "admin";
    $password = "admin";
    $dbname = "ua";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $nombre = $_POST['nombre'];
    $correo = $_POST['email'];
    $contrasena = $_POST['password'];

    $sql = "INSERT INTO usuarios (Usuario, Correo, Contraseña) VALUES (?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $nombre, $correo, $contrasena);

    if ($stmt->execute()) {
        $userId = $stmt->insert_id;

        echo "<script>
        sessionStorage.setItem('username', '$nombre');
            sessionStorage.setItem('userId', '$userId');
            window.location.href = 'index.php';
        </script>";
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registro</title>
<link id="default-stylesheet" rel="stylesheet" href="style/registro.css">
<link id="night-stylesheet" rel="stylesheet" href="style/funcionales/noche/registroN.css" disabled>
<link id="high-contrast-stylesheet" rel="stylesheet" href="style/funcionales/contraste/registroC.css" disabled>
<link id="read-mode-stylesheet" rel="stylesheet" href="style/funcionales/lectura/registroS.css" disabled>

<script src="https://kit.fontawesome.com/8f5be8334f.js" crossorigin="anonymous"></script>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poetsen+One&display=swap" rel="stylesheet">
<link rel="stylesheet" href="fontello-10643fc5/css/fontello.css">
</head>
<body>
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
      <button type="submit" class="registro-btn">Registrarse</button>
    </form>
    <p class="login-link">¿Ya tienes cuenta? <a href="login.php">Iniciar sesión</a></p>

  </div>
</div>
<script>
    // Función para aplicar configuración desde sessionStorage
    function applySettings() {
        const fontSize = sessionStorage.getItem('fontSize');
        const style = sessionStorage.getItem('style');

            if (fontSize) {
                document.documentElement.style.fontSize = fontSize;
            }

            if (style) {
                // Deshabilitar todas las hojas de estilo primero
                document.getElementById('default-stylesheet').disabled = true;
                document.getElementById('night-stylesheet').disabled = true;
                document.getElementById('high-contrast-stylesheet').disabled = true;
                document.getElementById('read-mode-stylesheet').disabled = true;

                // Habilitar la hoja de estilo seleccionada
                switch (style) {
                    case 'night':
                        document.getElementById('night-stylesheet').disabled = false;
                        break;
                    case 'high-contrast':
                        document.getElementById('high-contrast-stylesheet').disabled = false;
                        break;
                    case 'read-mode':
                        document.getElementById('read-mode-stylesheet').disabled = false;
                        break;
                    default:
                        document.getElementById('default-stylesheet').disabled = false;
                        break;
                }
            }

            // Si hay un idioma guardado, traducir el contenido de la página
            if (language) {
                translatePageContent(language);
            }
        }

        // Aplicar configuración cuando la página se carga
        window.onload = applySettings;
    </script>

</body>
</html>
