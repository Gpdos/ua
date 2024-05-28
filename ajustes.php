<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ajustes</title>
    <link id="default-stylesheet" rel="stylesheet" href="style/ajustes.css">
    <link id="night-stylesheet" rel="stylesheet" href="style/funcionales/noche/ajustesN.css" disabled>
    <link id="high-contrast-stylesheet" rel="stylesheet" href="style/funcionales/contraste/ajustesC.css" disabled>
    <link id="read-mode-stylesheet" rel="stylesheet" href="style/funcionales/lectura/ajustesS.css" disabled>
    <script src="https://kit.fontawesome.com/8f5be8334f.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poetsen+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="fontello-10643fc5/css/fontello.css">
</head>
<body>

<?php
// Realizar la conexión a la base de datos
$servername = "localhost";
$username = "admin"; // Asegúrate de cambiar 'admin' por el nombre de usuario real
$password = "admin"; // Asegúrate de cambiar 'admin' por la contraseña real
$dbname = "ua";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Suponiendo que el nombre de usuario se obtiene y se asigna a la variable $username de alguna forma segura
$username = 'Javier'; // Esta línea debe ser ajustada para obtener el nombre de usuario de forma segura

// Consulta SQL para recuperar publicaciones del usuario
$sql = "SELECT * FROM publicacion WHERE autor = '" . $username . "'";
$result = $conn->query($sql);

$number_of_posts = $result->num_rows; // Número de publicaciones

// Cerrar la conexión
$conn->close();
?>
<div id="header-container"></div>

<div class="main-content">
    <div class="profile-container">
        <img src="fotos/gato.jpg" alt="Foto de perfil" class="profile-pic">
        <aside class="settings-menu">
            <h2>Ajustes de cuenta</h2>
            <ul>

                <li><a href="colecciones.php">Mis Colecciones</a></li>
                <li><a href="config.php">Accesibilidad</a></li>
            </ul>
        </aside>
    </div>
    
    <div class="seccionesCen">
        <section class="settings-details">
            <h2 id="user-name">USUARIO01</h2>
            <p id="post-count">Publicaciones: <?php echo $number_of_posts; ?></p>
            <p>Grado en Ingeniería Multimedia</p>
            <p>Universidad de Alicante</p>
        </section>
        
    </div>

    <div class="publications">
        <h2>Publicaciones:</h2>
        <?php if ($number_of_posts > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <div class="publication-card"> <!-- Agregamos un div para cada publicación -->
                    <h2><?php echo $row['Nombre']; ?></h2>
                    <p>Autor: <?php echo $row['autor']; ?></p>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No se encontraron publicaciones.</p>
        <?php endif; ?>
    </div>

</div>

    <?php require_once 'pie.php' ?>
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

        function loadHeader() {
            const userId = sessionStorage.getItem('userId');
            const headerContainer = document.getElementById('header-container');

            if (userId) {
                fetch('encabezado.php')
                    .then(response => response.text())
                    .then(data => headerContainer.innerHTML = data)
                    .catch(error => console.error('Error cargando encabezado:', error));
            } else {
                fetch('encabezadosinreg.php')
                    .then(response => response.text())
                    .then(data => headerContainer.innerHTML = data)
                    .catch(error => console.error('Error cargando encabezadosinreg:', error));
            }
        }

        function logout() {
            // Eliminar los elementos del sessionStorage
            sessionStorage.removeItem('userId');
            sessionStorage.removeItem('username');
            window.location.href = 'index.php';
        }

        // Aplicar configuración y cargar el encabezado adecuado cuando la página se carga
        window.onload = function() {
            applySettings();
            loadHeader();
            document.getElementById('user-name').textContent = sessionStorage.getItem('username') || 'USUARIO01';
            document.getElementById('post-count').textContent = 'Publicaciones: <?php echo $number_of_posts; ?>';
        };
</script>

</body>
</html>