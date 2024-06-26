<?php
$servername = "localhost";
$username = "admin";
$password = "admin";
$dbname = "ua";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$idPublicacion = "";
$nombre = "";
$carrera = "";
$tipo = "";
$valoracion = "";
$fecha = "";
$autor = "";
$archivo = "";

if (isset($_GET['idPublicacion'])) {
    $idPublicacion = $_GET['idPublicacion'];

    $sql = $conn->prepare("
        SELECT p.*, e.Nombre AS nombreCarrera, t.Nombre AS nombreTipo
        FROM publicacion p
        JOIN estudio e ON p.carrera = e.idEstudio
        JOIN tipotrabajo t ON p.tipo = t.idTipo
        WHERE p.idPublicacion = ?
    ");
    $sql->bind_param("i", $idPublicacion);
    $sql->execute();
    $result = $sql->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nombre = $row['Nombre'];
        $carrera = $row['nombreCarrera'];
        $tipo = $row['nombreTipo'];
        $valoracion = $row['valoracion'];
        $fecha = $row['fecha'];
        $autor = $row['autor'];
    } else {
        echo "No se encontró la publicación.";
    }

    $sql->close();

    $sql_archivo = $conn->prepare("SELECT contenido FROM trabajo WHERE idPubli = ?");
    $sql_archivo->bind_param("i", $idPublicacion);
    $sql_archivo->execute();
    $result_archivo = $sql_archivo->get_result();

    if ($result_archivo->num_rows > 0) {
        $row_archivo = $result_archivo->fetch_assoc();
        $archivo = $row_archivo['contenido'];
    } else {
        $archivo = "";
    }
    $sql_archivo->close();
} else {
    echo "No se proporcionó un ID de publicación.";
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['comentario']) && !empty($_POST['comentario']) && isset($_POST['idPublicacion']) && !empty($_POST['idPublicacion'])) {
    $comentario = $_POST['comentario'];
    $valoracionComentario = $_POST['valoracionComentario'];
    $idPublicacion = $_POST['idPublicacion'];
    $autorComentario = isset($_POST['autorComentario']) ? $_POST['autorComentario'] : 'Anonimo';

    $sql = $conn->prepare("INSERT INTO comentario (publicacion, texto, autor, valoracion) VALUES (?, ?, ?, ?)");
    $sql->bind_param("issi", $idPublicacion, $comentario, $autorComentario, $valoracionComentario);

    if ($sql->execute()) {
        echo "Comentario añadido con éxito.";
    } else {
        echo "Error al añadir el comentario: " . $conn->error;
    }

    $sql->close();
}

$comentarios = [];
$sql_comentarios = $conn->prepare("
    SELECT c.*, u.Usuario AS autorNombre 
    FROM comentario c 
    JOIN usuarios u ON c.autor = u.id 
    WHERE c.publicacion = ?
");
$sql_comentarios->bind_param("i", $idPublicacion);
$sql_comentarios->execute();
$result_comentarios = $sql_comentarios->get_result();

if ($result_comentarios->num_rows > 0) {
    while ($row = $result_comentarios->fetch_assoc()) {
        $comentarios[] = $row;
    }
}

$sql_comentarios->close();

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Publicacion</title>
    <link id="default-stylesheet" rel="stylesheet" href="style/documento.css">
    <link id="night-stylesheet" rel="stylesheet" href="style/funcionales/noche/documentoN.css" disabled>
    <link id="high-contrast-stylesheet" rel="stylesheet" href="style/funcionales/contraste/documentoC.css" disabled>
    <link id="read-mode-stylesheet" rel="stylesheet" href="style/funcionales/lectura/documentoS.css" disabled>
    <script src="https://kit.fontawesome.com/8f5be8334f.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poetsen+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="fontello-10643fc5/css/fontello.css">
</head>

<body>
    <div id="header-container"></div>
    <main>
        <div id="body_izq">
            <h2 id="titulo"><?php echo htmlspecialchars($nombre); ?></h2>
            <div id="publicacion">
                <div id="publicacion_arr">
                    <img src="https://picsum.photos/600/400?random=<?php echo htmlspecialchars($idPublicacion) ; ?>"
                        alt="Imagen publicacion" class="sombra">
                    <div id="descripcion" class="sombra">
                        <h3>Comentarios:</h3>
                        <?php foreach ($comentarios as $comentario): ?>
                            <div class="comentario">
                                <p><strong><?php echo htmlspecialchars($comentario['autorNombre']); ?>:</strong>
                                    <?php echo htmlspecialchars($comentario['texto']); ?></p>
                                <div class="stars">
                                    <span><?php echo str_repeat('⭐', htmlspecialchars($comentario['valoracion'])); ?></span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <div id="body_dch">
            <div id="body_arr">

                <div id="contenedorTexto">
                    <p>Comentarios: </p>
                    <form id="comentarioForm" method="POST" action="">
                        <textarea name="comentario" rows="10" cols="50" required
                            placeholder="Escribe algo interesante"></textarea>
                        <input type="hidden" name="idPublicacion"
                            value="<?php echo htmlspecialchars($idPublicacion); ?>">
                        <input type="hidden" name="autorComentario" id="autorComentario" value="">
                        <p>Valoracion: </p>
                        <div>
                            <select name="valoracionComentario" required>
                                <option value="1">⭐</option>
                                <option value="2">⭐⭐</option>
                                <option value="3">⭐⭐⭐</option>
                                <option value="4">⭐⭐⭐⭐</option>
                                <option value="5">⭐⭐⭐⭐⭐</option>
                            </select>
                            <button class="button" type="submit">Enviar</button>

                        </div>
                    </form>
                </div>
            </div>
            <div id="body_abj">
                <div id="contenedorTexto">
                    <p>Autor: <?php echo htmlspecialchars($autor); ?></p>
                    <p>Estudio: <?php echo htmlspecialchars($carrera); ?></p>
                    <p>Tipo de recurso: <?php echo htmlspecialchars($tipo); ?></p>
                    <p>Fecha de publicacion: <?php echo htmlspecialchars($fecha); ?></p>
                    <p>Bibliografia: </p>
                    <ul>
                        <li>Referencias</li>
                        <li>Lazarillo de Tormes</li>
                    </ul>
                    <a href="editarDoc.php?idPublicacion=<?php echo htmlspecialchars($idPublicacion); ?>"
                        class="button">Editar</a>
                    <?php if ($archivo): ?>
                        <a href="<?php echo htmlspecialchars($archivo); ?>" target="_blank">
                            <button>Abrir Archivo</button>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>
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
            const language = sessionStorage.getItem('language'); 

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

        // Aplicar configuración cuando la página se carga
        window.onload = function () {
            applySettings();
            loadHeader();
            // Obtener userId desde sessionStorage y asignarlo al campo oculto autorComentario
            const userId = sessionStorage.getItem('userId');
            if (userId) {
                document.getElementById('autorComentario').value = userId;
            }
            else {
                window.location.href = 'index.php';
            }
        };
    </script>
</body>

</html>