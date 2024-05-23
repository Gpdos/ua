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

// Inicializar un array para almacenar los datos de las publicaciones
$publicaciones = array();

// Inicializar un array para almacenar los nombres únicos del estudio
$estudios = array();

// Realizar la consulta SQL para obtener todas las publicaciones
$sql = "SELECT p.*, e.Nombre AS nombreCarrera FROM publicacion p JOIN estudio e ON p.carrera = e.idEstudio";
$result = $conn->query($sql);

// Comprobar si la consulta devuelve algún resultado
if ($result->num_rows > 0) {
    // Almacenar los datos de cada publicación en el array
    while ($row = $result->fetch_assoc()) {
        $publicaciones[] = $row;
    }
} else {
    echo "No se encontraron publicaciones.";
}

// Realizar la consulta SQL para obtener los nombres únicos de la tabla estudio
$sql_estudios = "SELECT DISTINCT idEstudio, Nombre FROM estudio";
$result_estudios = $conn->query($sql_estudios);

// Comprobar si la consulta devuelve algún resultado
if ($result_estudios->num_rows > 0) {
    // Almacenar los nombres únicos en el array
    while ($row = $result_estudios->fetch_assoc()) {
        $estudios[] = $row;
    }
} else {
    echo "No se encontraron estudios.";
}

// Cerrar la conexión
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
    <link id="read-mode-stylesheet" rel="stylesheet" href="style/funcionales/lectura.css" disabled>

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
                // Generar las opciones del selector dinámicamente con los nombres de la tabla estudio
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
                echo '<img src="https://picsum.photos/600/400?random=' . htmlspecialchars($idPublicacion) . '" alt="' . htmlspecialchars($nombre) . '">';
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
                    echo '<img src="https://picsum.photos/600/400?random=' . htmlspecialchars($idPublicacion) . '" alt="' . htmlspecialchars($nombre) . '" class="card-image">';
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

        <div id="div_abj">
            <div>
                <a href="buscar.php?1">
                    <div>
                        <h2>TFG's</h2>
                    </div>
                </a>
            </div>

            <div>
                <a href="buscar.php?2">
                    <div>
                        <h2>TFM</h2>
                    </div>
                </a>
            </div>

            <div>
                <a href="buscar.php?3">
                    <div>
                        <h2>ABP</h2>
                    </div>
                </a>
            </div>

            <div>
                <a href="buscar.php?4">
                    <div>
                        <h2>Presentacion</h2>
                    </div>
                </a>
            </div>

            <div>
                <a href="buscar.php?5">
                    <div>
                        <h2>Modelo 3D</h2>
                    </div>
                </a>
            </div>

            <div>
                <a href="buscar.php?6">
                    <div>
                        <h2>Memoria</h2>
                    </div>
                </a>
            </div>
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

        relatedContainer.innerHTML = ''; // Limpiar publicaciones relacionadas previas
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
                    const idPublicacion = block.querySelector('img').src.split('random=')[1]; // Extraer idPublicacion del src
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

function translatePageContent(targetLanguage) {
    const apiKey = 'AIzaSyCpfO9GfEIIsm_I96ZrgRAxe9ZYsFJ3Xx8'; // Sustituye 'TU_API_KEY' con tu clave de API real
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
