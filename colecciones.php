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
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Mis Colecciones</title>
<link id="default-stylesheet" rel="stylesheet" href="style/colecciones.css">
<link id="night-stylesheet" rel="stylesheet" href="style/funcionales/noche/coleccionesN.css" disabled>
<link id="high-contrast-stylesheet" rel="stylesheet" href="style/funcionales/contraste/coleccionesC.css" disabled>
<link id="read-mode-stylesheet" rel="stylesheet" href="style/funcionales/lectura/coleccionesS.css" disabled>
<script src="https://kit.fontawesome.com/8f5be8334f.js" crossorigin="anonymous"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poetsen+One&display=swap" rel="stylesheet">
<link rel="stylesheet" href="fontello-10643fc5/css/fontello.css">
</head>
<body>
<div id="header-container"></div>

<div class="container">
    <div class="left-column">
        <h3 style="color: lightblue;">GUARDADOS:</h3>
        <h4 style="color: lightblue; text-align: right;">Último mes:</h4>
        <div class="carousel-wrapper">
            <div class="carousel" style="margin-bottom: 30px;">
                <!-- PHP Code to Fetch Documents for Last Month -->
                <?php
                $found = false;
                foreach ($publicaciones as $publicacion) {
                    if ($publicacion['carrera'] == 1) {
                        $found = true;
                        $found = true;
                        echo '<a href="documento.php" class="work">
                                <img src="fotos/'.$publicacion['image'].'">
                                <div class="work-details">
                                    <h4>'.$publicacion['Nombre'].'</h4>
                                    <p>'.$publicacion['autor'].'</p>
                                    
                                    <p>'.$publicacion['fecha'].'</p>
                                </div>
                              </a>';
                    }
                }
                if (!$found) {
                    echo "<p>No se encontraron publicaciones guardadas para el último mes.</p>";
                }
                ?>
            </div>
        </div>
        <h4 style="color: lightblue; text-align:right;">Anteriormente:</h4>
        <div class="carousel-wrapper">
            <div class="carousel">
                <!-- PHP Code to Fetch Documents for Previous Months -->
                <?php
                $found = false;
                foreach ($publicaciones as $publicacion) {
                    if ($publicacion['carrera'] == 2) {
                        $found = true;
                        echo '<a href="documento.php" class="work">
                                <img src="fotos/'.$publicacion['image'].'">
                                <div class="work-details">
                                    <h4>'.$publicacion['Nombre'].'</h4>
                                    <p>'.$publicacion['autor'].'</p>
                                    
                                    <p>'.$publicacion['fecha'].'</p>
                                </div>
                              </a>';
                    }
                }
                if (!$found) {
                    echo "<p>No se encontraron publicaciones anteriores.</p>";
                }
                ?>
            </div>
        </div>
    </div>
    <div class="right-column">
        <h3 style="color: lightblue;">FILTRADOS POR CARRERA:</h3>
        <?php
        $carreras = [
            3 => "Derecho y RI",
            4 => "Arquitectura",
            5 => "Gastronomía"
        ];
        foreach ($carreras as $carrera => $nombreCarrera) {
            echo '<h4 style="color: lightblue;">Carrera: '.$nombreCarrera.'</h4>';
            echo '<div class="carousel-wrapper"><div class="carousel">';
            $found = false;
            foreach ($publicaciones as $publicacion) {
                if ($publicacion['carrera'] == $carrera) {
                    $found = true;
                    $found = true;
                        echo '<a href="documento.php" class="work">
                                <img src="fotos/'.$publicacion['image'].'">
                                <div class="work-details">
                                    <h4>'.$publicacion['Nombre'].'</h4>
                                    <p>'.$publicacion['autor'].'</p>
                                    
                                    <p>'.$publicacion['fecha'].'</p>
                                </div>
                              </a>';
                }
            }
            if (!$found) {
                echo "<p>No se encontraron publicaciones para la carrera $nombreCarrera.</p>";
            }
            echo '</div></div>';
        }
        ?>
    </div>
</div>

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
