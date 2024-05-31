<?php
$servername = "localhost";
$username = "admin";
$password = "admin";
$dbname = "ua";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$publicaciones = array();
$estudios = array();
$imagenes = array();

$sql = "SELECT p.*, e.Nombre AS nombreCarrera FROM publicacion p JOIN estudio e ON p.carrera = e.idEstudio";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $publicaciones[] = $row;
    }
} else {
    echo "No se encontraron publicaciones.";
}

$sql_estudios = "SELECT DISTINCT idEstudio, Nombre FROM estudio";
$result_estudios = $conn->query($sql_estudios);

if ($result_estudios->num_rows > 0) {
    while ($row = $result_estudios->fetch_assoc()) {
        $estudios[] = $row;
    }
} else {
    echo "No se encontraron estudios.";
}

$sql_imagenes = "SELECT idPubli, archivo FROM foto";
$result_imagenes = $conn->query($sql_imagenes);

if ($result_imagenes->num_rows > 0) {
    while ($row = $result_imagenes->fetch_assoc()) {
        if (!isset($imagenes[$row['idPubli']])) {
            $imagenes[$row['idPubli']] = $row['archivo'];
        }
    }
} else {
    echo "No se encontraron imágenes.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio</title>
    <link id="default-stylesheet" rel="stylesheet" href="style/index.css">
    <link id="night-stylesheet" rel="stylesheet" href="style/funcionales/noche/indexN.css" disabled>
    <link id="high-contrast-stylesheet" rel="stylesheet" href="style/funcionales/contraste/indexC.css" disabled>
    <link id="read-mode-stylesheet" rel="stylesheet" href="style/funcionales/lectura/indexS.css" disabled>

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
        <div class="section-header">
            <select name="lenguajes" id="lang" onchange="filtrarPublicaciones()">
                <option value="0">Seleccione un estudio</option>
                <?php
                foreach ($estudios as $estudio) {
                    echo '<option value="' . htmlspecialchars($estudio['idEstudio']) . '">' . htmlspecialchars($estudio['Nombre']) . '</option>';
                }
                ?>
            </select>
        </div>

        <div class="content" id="content">
            <?php 
            foreach ($publicaciones as $publicacion) {
                $idPublicacion = isset($publicacion['idPublicacion']) ? $publicacion['idPublicacion'] : '';
                $nombre = isset($publicacion['Nombre']) ? $publicacion['Nombre'] : 'Nombre no disponible';
                $autor = isset($publicacion['autor']) ? $publicacion['autor'] : 'Autor no disponible';
                $carrera = isset($publicacion['nombreCarrera']) ? $publicacion['nombreCarrera'] : 'Carrera no disponible';
                $valoracion = isset($publicacion['valoracion']) ? $publicacion['valoracion'] : 0;

                echo '<div class="content-block" data-carrera="' . htmlspecialchars($publicacion['carrera']) . '">';
                if (isset($imagenes[$idPublicacion])) {
                    echo '<img src="' . htmlspecialchars($imagenes[$idPublicacion]) . '" alt="' . htmlspecialchars($nombre) . '">';
                } else {
                    echo '<img src="https://picsum.photos/600/400?random=' . htmlspecialchars($idPublicacion) . '" alt="' . htmlspecialchars($nombre) . '">';
                }
                echo '<span>UA: ' . htmlspecialchars($nombre) . '</span>';
                echo '</div>';
            }
            ?>
        </div>
        <div class="content" id="filtered-content" style="display: none;">
            <h3>Publicaciones relacionadas:</h3>
            <div id="related-publications"></div>
        </div>
    </div>

    <div id="body_der">
        <div id="div_arr">
            <h2 class="titulo">Recientes</h2>

            <div class="publicaciones">
                <?php 
                foreach ($publicaciones as $publicacion) {
                    $idPublicacion = isset($publicacion['idPublicacion']) ? $publicacion['idPublicacion'] : '';
                    $nombre = isset($publicacion['Nombre']) ? $publicacion['Nombre'] : 'Nombre no disponible';
                    $autor = isset($publicacion['autor']) ? $publicacion['autor'] : 'Autor no disponible';
                    $carrera = isset($publicacion['nombreCarrera']) ? $publicacion['nombreCarrera'] : 'Carrera no disponible';
                    $valoracion = isset($publicacion['valoracion']) ? $publicacion['valoracion'] : 0;

                    echo '<div class="card">';
                    echo '<a href="documento.php?idPublicacion=' . htmlspecialchars($idPublicacion) . '">';
                    if (isset($imagenes[$idPublicacion])) {
                        echo '<img src="' . htmlspecialchars($imagenes[$idPublicacion]) . '" alt="' . htmlspecialchars($nombre) . '" class="card-image">';
                    } else {
                        echo '<img src="https://picsum.photos/600/400?random=' . htmlspecialchars($idPublicacion) . '" alt="' . htmlspecialchars($nombre) . '" class="card-image">';
                    }
                    echo '<div class="card-content">';
                    echo '<h2>' . htmlspecialchars($nombre) . '</h2>';
                    echo '<p>' . htmlspecialchars($autor) . '</p>';
                    echo '<p>' . htmlspecialchars($carrera) . '</p>';
                    echo '<div class="stars">';
                    echo '<span>' . str_repeat('⭐', htmlspecialchars($valoracion)) . '</span>';
                    echo '</div>';
                    echo '</div>';
                    echo '</a>';
                    echo '</div>';
                }
                ?>
            </div>
            <i class="fa-solid fa-circle-right"></i>
        </div>
    </div>
</main>
<?php require_once 'pie.php' ?>

<script>
    function filtrarPublicaciones() {
        const select = document.getElementById('lang');
        const selectedCarrera = select.value;
        const contentBlocks = document.querySelectorAll('.content-block');
        const relatedContainer = document.getElementById('related-publications');
        const filteredContent = document.getElementById('filtered-content');
        let hasExactMatch = false;

        relatedContainer.innerHTML = ''; 
        filteredContent.style.display = 'none';

        contentBlocks.forEach(block => {
            if (selectedCarrera === "0" || block.dataset.carrera === selectedCarrera) {
                block.style.display = "block";
                if (block.dataset.carrera === selectedCarrera) {
                    hasExactMatch = true;
                }
            } else {
                block.style.display = "none";
                if (block.dataset.carrera === selectedCarrera) {
                    const idPublicacion = block.querySelector('img').src.split('random=')[1]; 
                    const publicationName = block.querySelector('span').innerText;
                    const publicationLink = document.createElement('a');
                    publicationLink.href = `documento.php?idPublicacion=${idPublicacion}`;
                    publicationLink.innerText = publicationName;
                    relatedContainer.appendChild(publicationLink);
                }
            }
        });

        if (!hasExactMatch && relatedContainer.childElementCount > 0) {
            filteredContent.style.display = 'block';
        }
    }

    function applySettings() {
        const fontSize = sessionStorage.getItem('fontSize');
        const style = sessionStorage.getItem('style');
        const language = sessionStorage.getItem('language');

        if (fontSize) {
            document.documentElement.style.fontSize = fontSize;
        }

        if (style) {
            document.getElementById('default-stylesheet').disabled = true;
            document.getElementById('night-stylesheet').disabled = true;
            document.getElementById('high-contrast-stylesheet').disabled = true;
            document.getElementById('read-mode-stylesheet').disabled = true;

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

        if (language) {
            translatePageContent(language);
        }
    }

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
        sessionStorage.removeItem('userId');
        sessionStorage.removeItem('username');
        window.location.href = 'index.php';
    }

    window.onload = function() {
        applySettings();
        loadHeader();
    };

</script>
</body>
</html>
