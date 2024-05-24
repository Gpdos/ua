<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $correo = $_POST['email'];
    $contrasena = $_POST['password'];

    // Insertar los datos en la tabla usuarios
    $sql = "INSERT INTO usuarios (Usuario, Correo, Contraseña) VALUES (?, ?, ?)";

    // Preparar la declaración
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $nombre, $correo, $contrasena);

    // Ejecutar la declaración
    if ($stmt->execute()) {
        // Obtener el id del nuevo usuario
        $userId = $stmt->insert_id;

        // Generar un script JavaScript para guardar el id del usuario en sessionStorage
        echo "<script>
        sessionStorage.setItem('username', '$nombre');
            sessionStorage.setItem('userId', '$userId');
            window.location.href = 'index.php';
        </script>";
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Cerrar la conexión
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
  </div>
  <p class="login-link">¿Ya tienes cuenta? <a href="login.php">Iniciar sesión</a></p>
</div>
<script>
   function translatePageContent(targetLanguage) {
    const apiKey = 'AIzaSyC8OT8zQXEmeswRzRwnc_wi5lM8Fkjoqc8'; // Sustituye 'TU_API_KEY' con tu clave de API real
    const textElements = document.querySelectorAll('h1, h2, h3, h4, h5, h6, p, a, li'); // Selecciona los elementos que deseas traducir

    textElements.forEach(element => {
        const text = element.textContent;
        const url = `https://translation.googleapis.com/language/translate/v2?key=${apiKey}`;

        const data = {
            q: text,
            target: targetLanguage,
            format: 'text' // Asegúrate de especificar el formato si es necesario
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
                element.textContent = data.data.translations[0].translatedText;
            }
        })
        .catch(error => console.error('Error in translation:', error));
    });
}

// Escuchar cambios en el selector de idioma
document.getElementById('language-selector').addEventListener('change', function() {
    translatePageContent(this.value);
});



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
