<?php
$servername = "localhost";
$username = "admin";
$password = "admin";
$dbname = "ua";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES["fileToUpload"])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if (getimagesize($_FILES["fileToUpload"]["tmp_name"]) !== false) {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                $success = "El archivo ha sido subido.";
            } else {
                $error = "Error subiendo el archivo.";
            }
        } else {
            $error = "El archivo no es una imagen.";
        }
    }

    $nombre = $_POST['nombre'];
    $autor = $_POST['autor'];
    $carrera = $_POST['carrera'];
    $tipo = $_POST['tipo'];
    $valoracion = $_POST['valoracion'];
    $fecha = $_POST['fecha'];

    $sql = $conn->prepare("INSERT INTO publicacion (Nombre, autor, carrera, tipo, valoracion, fecha) VALUES (?, ?, ?, ?, ?, ?)");
    $sql->bind_param("ssiiis", $nombre, $autor, $carrera, $tipo, $valoracion, $fecha);

    if ($sql->execute()) {
        $success = "Publicación creada con éxito.";
    } else {
        $error = "Error al crear la publicación: " . $conn->error;
    }

    $sql->close();
}

$estudios = [];
$tipos = [];

$sql_estudios = "SELECT idEstudio, Nombre FROM estudio";
$result_estudios = $conn->query($sql_estudios);
if ($result_estudios->num_rows > 0) {
    while ($row = $result_estudios->fetch_assoc()) {
        $estudios[] = $row;
    }
}

$sql_tipos = "SELECT idTipo, Nombre FROM tipotrabajo";
$result_tipos = $conn->query($sql_tipos);
if ($result_tipos->num_rows > 0) {
    while ($row = $result_tipos->fetch_assoc()) {
        $tipos[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Crear publicacion</title>
    <link id="default-stylesheet" rel="stylesheet" href="style/crearDoc.css">
    <link id="night-stylesheet" rel="stylesheet" href="style/funcionales/noche/crearDocN.css" disabled>
    <link id="high-contrast-stylesheet" rel="stylesheet" href="style/funcionales/contraste/crearDocC.css" disabled>
    <link id="read-mode-stylesheet" rel="stylesheet" href="style/funcionales/lectura/crearDocS.css" disabled>
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
            <h2>SUBE TUS TRABAJOS Y PERMITE A OTROS USUARIOS EMPAPARSE DE TU CONOCIMIENTO</h2>
            <div id="publicacion">
                <i class="fa-regular fa-folder-open"></i>
            </div>
        </div>

        <div id="body_dch">
            <div id="body_abj">
                <div id="contenedorTexto">
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="editar_datos">
                            <p>Nombre de la Publicación:</p>
                            <textarea name="nombre" rows="1" cols="30" required></textarea>
                        </div>
                        <div class="editar_datos">
                            <p>Autor:</p>
                            <textarea name="autor" rows="1" cols="30" required></textarea>
                        </div>
                        <div class="editar_datos">
                            <p>Estudio:</p>
                            <select name="carrera" required>
                                <?php
                                foreach ($estudios as $estudio) {
                                    echo '<option value="' . htmlspecialchars($estudio['idEstudio']) . '">' . htmlspecialchars($estudio['Nombre']) . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="editar_datos">
                            <p>Tipo de Recurso:</p>
                            <select name="tipo" required>
                                <?php
                                foreach ($tipos as $tipo) {
                                    echo '<option value="' . htmlspecialchars($tipo['idTipo']) . '">' . htmlspecialchars($tipo['Nombre']) . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="editar_datos">
                            <p>Valoración:</p>
                            <input type="number" name="valoracion" min="0" max="5" required>
                        </div>
                        <div class="editar_datos">
                            <p>Fecha de Publicación:</p>
                            <input type="date" name="fecha" required>
                        </div>
                        <div class="editar_datos">
                            <p>Bibliografía:</p>
                            <textarea name="bibliografia" rows="1" cols="30" required></textarea>
                        </div>
                        <div class="editar_datos">
                            <p>Subir Archivo:</p>
                            <input type="file" name="fileToUpload">
                        </div>
                        <div>
                            <button type="submit" class="button">Crear Publicación</button>
                            <button type="button" class="button" onclick="resetForm()">Limpiar Campos</button>
                        </div>
                    </form>

                    <?php
                    if (!empty($error)) {
                        echo '<div class="error">' . htmlspecialchars($error) . '</div>';
                    }

                    if (!empty($success)) {
                        echo '<div class="success">' . htmlspecialchars($success) . '</div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </main>

    <?php require_once 'pie.php' ?>

    <script>
        function translatePageContent(targetLanguage) {
            const apiKey = 'AIzaSyC8OT8zQXEmeswRzRwnc_wi5lM8Fkjoqc8'; 
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


        function resetForm() {
            document.querySelector('form').reset();
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

        // Aplicar configuración y cargar el encabezado adecuado cuando la página se carga
        window.onload = function () {
            applySettings();
            loadHeader();
        };

    </script>
</body>

</html>