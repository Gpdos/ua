<?php
// Realizar la conexión a la base de datos (asegúrate de configurar tus credenciales)
$servername = "localhost";
$username = "admin";
$password = "admin";
$dbname = "ua";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Conexión fallida: " . $conn->connect_error);
}

$loginError = "";

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['user']) && isset($_GET['password'])) {
  $user = $_GET['user'];
  $pass = $_GET['password'];

  $sql = $conn->prepare("SELECT id, Usuario FROM usuarios WHERE Usuario = ? AND Contraseña = ?");
  $sql->bind_param("ss", $user, $pass);
  $sql->execute();
  $result = $sql->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $userId = $row['id'];
    $username = $row['Usuario'];

    session_start();
    $_SESSION['username'] = $username;

    echo "<script>
          sessionStorage.setItem('username', '$user');
          sessionStorage.setItem('userId', '$userId');
            window.location.href = 'index.php';
        </script>";
    exit;
  } else {
    $loginError = "Error: Usuario o contraseña incorrectos.";
  }

  $sql->close();
}

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
  <link rel="stylesheet" href="fontello-10643fc5/css/fontello.css">
  <link id="default-stylesheet" rel="stylesheet" href="style/login.css">
  <link id="night-stylesheet" rel="stylesheet" href="style/funcionales/noche/loginN.css" disabled>
  <link id="high-contrast-stylesheet" rel="stylesheet" href="style/funcionales/contraste/loginC.css" disabled>
  <link id="read-mode-stylesheet" rel="stylesheet" href="style/funcionales/lectura/loginS.css" disabled>
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
          <img src="fotos/perfil usuario 2.png" alt="Usuario" class="icon-img">
          <input type="text" name="user" placeholder="user" required>
        </div>
        <div class="form-group2">
          <img src="fotos/candado.png" alt="Contraseña" class="icon-img">
          <input type="password" name="password" placeholder="contraseña" required>
        </div>

        <button type="submit">Entrar</button>
        
      </form>
      <?php
      if ($loginError != "") {
        echo "<p class='error-message'>$loginError</p>";
      }
      ?>
      <p class="register-link">¿No tienes cuenta? <a href="registro.php">Regístrate</a></p>
    </div>
  </div>
  <script>


    function translatePageContent(targetLanguage) {
        const apiKey = 'AIzaSyC8OT8zQXEmeswRzRwnc_wi5lM8Fkjoqc8'; // Sustituye 'TU_API_KEY' con tu clave de API real
        const textNodes = [];

        function extractTextNodes(node) {
            if (node.nodeType === Node.TEXT_NODE) {
                if (node.textContent.trim() !== '') {
                    textNodes.push(node);
                }
            } else {
                node.childNodes.forEach(extractTextNodes);
            }
        }

        const elementsToTranslate = document.querySelectorAll('h1, h2, h3, h4, h5, h6, p, a, li');
        elementsToTranslate.forEach(extractTextNodes);

        textNodes.forEach(node => {
            const text = node.textContent;
            const url = `https://translation.googleapis.com/language/translate/v2?key=${apiKey}`;

            const data = {
                q: text,
                target: targetLanguage,
                format: 'text'
            };

            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(data => {
                if (data.data && data.data.translations.length > 0) {
                    node.textContent = data.data.translations[0].translatedText;
                }
            })
            .catch(error => console.error('Error in translation:', error));
        });
    }

    function applySettings() {
        const fontSize = sessionStorage.getItem('fontSize');
        const style = sessionStorage.getItem('style');
        const language = sessionStorage.getItem('language'); // Recuperar el idioma guardado

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