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

// Inicializar variables para almacenar los datos de la publicación
$idPublicacion = "";
$nombre = "";
$carrera = "";
$tipo = "";
$valoracion = "";
$fecha = "";
$autor = "";

// Comprobar si se ha enviado un ID de publicación
if (isset($_GET['idPublicacion'])) {
    $idPublicacion = $_GET['idPublicacion'];

    // Preparar y ejecutar la consulta SQL para obtener los datos de la publicación
    $sql = $conn->prepare("SELECT * FROM publicacion WHERE idPublicacion = ?");
    $sql->bind_param("i", $idPublicacion);
    $sql->execute();
    $result = $sql->get_result();

    // Comprobar si la consulta devuelve algún resultado
    if ($result->num_rows > 0) {
        // Obtener los datos de la publicación
        $row = $result->fetch_assoc();
        $nombre = $row['Nombre'];
        $carrera = $row['carrera'];
        $tipo = $row['tipo'];
        $valoracion = $row['valoracion'];
        $fecha = $row['fecha'];
        $autor = $row['autor'];
    } else {
        echo "No se encontró la publicación.";
    }

    // Cerrar la consulta
    $sql->close();
} else {
    echo "No se proporcionó un ID de publicación.";
}

// Comprobar si se ha enviado el formulario para actualizar los datos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idPublicacion = $_POST['idPublicacion'];
    $nombre = $_POST['nombre'];
    $carrera = $_POST['carrera'];
    $tipo = $_POST['tipo'];
    $valoracion = $_POST['valoracion'];
    $fecha = $_POST['fecha'];
    $autor = $_POST['autor'];

    // Preparar y ejecutar la consulta SQL para actualizar los datos de la publicación
    $sql = $conn->prepare("UPDATE publicacion SET Nombre = ?, carrera = ?, tipo = ?, valoracion = ?, fecha = ?, autor = ? WHERE idPublicacion = ?");
    $sql->bind_param("sssiisi", $nombre, $carrera, $tipo, $valoracion, $fecha, $autor, $idPublicacion);

    if ($sql->execute()) {
        echo "Publicación actualizada correctamente.";
        // Redirigir a la página de detalle de la publicación
        header("Location: documento.php?idPublicacion=" . $idPublicacion);
        exit;
    } else {
        echo "Error al actualizar la publicación: " . $conn->error;
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
    <title>Editar Publicacion</title>
    <link id="default-stylesheet" rel="stylesheet" href="style/editarDoc.css">
    <link id="night-stylesheet" rel="stylesheet" href="style/funcionales/noche/editarDocN.css" disabled>
    <link id="high-contrast-stylesheet" rel="stylesheet" href="style/funcionales/contraste/editarDocC.css" disabled>
    <link id="read-mode-stylesheet" rel="stylesheet" href="style/funcionales/lectura/editarDocS.css" disabled>
    <script src="https://kit.fontawesome.com/8f5be8334f.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poetsen+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="fontello-10643fc5/css/fontello.css">
</head>
<body>
<div id="header-container"></div>
    <main>
        <!-- <div id="global"> -->
        <div id="body_izq">
            <h2>Editar Publicación</h2>

            <div id="publicacion">
                <img src="https://picsum.photos/600/400?random=11" alt="Imagen publicacion" class="sombra">
                <img src="https://picsum.photos/600/400?random=10" alt="Imagen publicacion" class="sombra">
                <img src="https://picsum.photos/600/400?random=9" alt="Imagen publicacion" class="sombra">
                <img src="https://picsum.photos/600/400?random=8" alt="Imagen publicacion" class="sombra">
                <img src="https://picsum.photos/600/400?random=7" alt="Imagen publicacion" class="sombra">
                <img src="https://picsum.photos/600/400?random=6" alt="Imagen publicacion" class="sombra">
                <img src="https://picsum.photos/600/400?random=5" alt="Imagen publicacion" class="sombra">
                <img src="https://picsum.photos/600/400?random=4" alt="Imagen publicacion" class="sombra">
                <img src="https://picsum.photos/600/400?random=3" alt="Imagen publicacion" class="sombra">
                <img src="https://picsum.photos/600/400?random=2" alt="Imagen publicacion" class="sombra">
                <img src="https://picsum.photos/600/400?random=1" alt="Imagen publicacion" class="sombra">
                <i class="fa-regular fa-folder-open"></i>
            </div>
        </div>

        <div id="body_dch">
            <div id="body_arr">
                <div id="contenedorTexto">
                    <p>Comentarios: </p>
                    <textarea name="textarea" rows="10" cols="50">Escribe algo interesante</textarea>
                    <p>Valoracion: </p>
                    <div>
                        <div class="stars">
                            <span>⭐⭐⭐</span>
                        </div>
                        <button>Enviar</button>
                    </div>
                </div>
            </div>
            <div id="body_abj">
                <div id="contenedorTexto">
                    <form method="POST" action="editarDoc.php">
                        <input type="hidden" name="idPublicacion" value="<?php echo htmlspecialchars($idPublicacion); ?>">
                        <div class="editar_datos">
                            <p>Nombre:</p>
                            <textarea name="nombre" rows="1" cols="30"><?php echo htmlspecialchars($nombre); ?></textarea>
                        </div>
                        <div class="editar_datos">
                            <p>Carrera:</p>
                            <textarea name="carrera" rows="1" cols="30"><?php echo htmlspecialchars($carrera); ?></textarea>
                        </div>
                        <div class="editar_datos">
                            <p>Tipo de recurso:</p>
                            <textarea name="tipo" rows="1" cols="30"><?php echo htmlspecialchars($tipo); ?></textarea>
                        </div>
                        <div class="editar_datos">
                            <p>Valoración:</p>
                            <textarea name="valoracion" rows="1" cols="30"><?php echo htmlspecialchars($valoracion); ?></textarea>
                        </div>
                        <div class="editar_datos">
                            <p>Fecha de publicación:</p>
                            <textarea name="fecha" rows="1" cols="30"><?php echo htmlspecialchars($fecha); ?></textarea>
                        </div>
                        <div class="editar_datos">
                            <p>Autor:</p>
                            <textarea name="autor" rows="1" cols="30"><?php echo htmlspecialchars($autor); ?></textarea>
                        </div>
                        <div class="editar_datos">
                            <button type="submit">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- </div> -->
    </main>

    <?php require_once 'pie.php' ?>

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
        };
    </script>
</body>
</html>
