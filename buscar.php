<?php
$servername = "localhost";
$username = "admin";
$password = "admin";
$dbname = "ua";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT p.*, e.Nombre AS nombreCarrera FROM publicacion p JOIN estudio e ON p.carrera = e.idEstudio";

$conditions = [];

if (!empty($_GET['tipo'])) {
    $tipoFiltros = array_map('intval', $_GET['tipo']);
    $conditions[] = "p.tipo IN (" . implode(',', $tipoFiltros) . ")";
}

if (!empty($_GET['carrera'])) {
    $carreraFiltros = array_map('intval', $_GET['carrera']);
    $conditions[] = "p.carrera IN (" . implode(',', $carreraFiltros) . ")";
}

if (!empty($conditions)) {
    $sql .= " WHERE " . implode(' AND ', $conditions);
}

$result = $conn->query($sql);

$conn->close();
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Buscar</title>
    <link id="default-stylesheet" rel="stylesheet" href="style/buscar.css">
    <link id="night-stylesheet" rel="stylesheet" href="style/funcionales/noche/buscarN.css" disabled>
    <link id="high-contrast-stylesheet" rel="stylesheet" href="style/funcionales/contraste/buscarC.css" disabled>
    <link id="read-mode-stylesheet" rel="stylesheet" href="style/funcionales/lectura/buscarS.css" disabled>
    <script src="https://kit.fontawesome.com/8f5be8334f.js" crossorigin="anonymous"></script>


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poetsen+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="fontello-10643fc5/css/fontello.css">
</head>
<body>
<div id="header-container"></div>

        
   
    <div class="main-content">
        
    <div class="main-content">
    <form action="buscar.php" method="GET">
    <aside class="filters">
        <div>
            <h3>Categoría</h3>
            <label><input type="checkbox" name="tipo[]" value="1"> TFG</label>
            <label><input type="checkbox" name="tipo[]" value="2"> TFM</label>
            <label><input type="checkbox" name="tipo[]" value="3"> ABP</label>
            <label><input type="checkbox" name="tipo[]" value="4"> Presentacion</label>
            <label><input type="checkbox" name="tipo[]" value="5"> Modelado 3D</label>
            <label><input type="checkbox" name="tipo[]" value="6"> Memoria</label>
        </div>
        <div>
            <h3>Carrera</h3>
            <label><input type="checkbox" name="carrera[]" value="1"> Ingeniería Multimedia</label>
            <label><input type="checkbox" name="carrera[]" value="2"> Matemáticas</label>
            <label><input type="checkbox" name="carrera[]" value="3"> Derecho y RI</label>
            <label><input type="checkbox" name="carrera[]" value="4"> Arquitectura</label>
            <label><input type="checkbox" name="carrera[]" value="5"> Gastronomía</label>
            <label><input type="checkbox" name="carrera[]" value="6"> Diseño</label>
        </div>
        <button type="submit">Aplicar filtros</button>
    </aside>
</form>

        <section class="search-results">
        <?php
        // Parámetros de conexión a la base de datos
        $servername = "localhost";
        $username = "admin";
        $password = "admin";
        $dbname = "ua";

        // Crear conexión
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verificar conexión
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Consulta SQL para obtener todas las publicaciones
        $sql = "SELECT p.*, e.Nombre AS nombreCarrera FROM publicacion p JOIN estudio e ON p.carrera = e.idEstudio";

        if (!empty($_GET['tipo'])) {
            $tipoFiltros = array_map('intval', $_GET['tipo']); // Asegurar que los valores son enteros
            $tipoFiltros = implode(',', $tipoFiltros); // Convertir el array en una lista separada por comas
            $sql .= " WHERE p.tipo IN ($tipoFiltros)"; // Añadir condiciones de tipo a la consulta SQL
        }

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Almacenar y mostrar los datos de cada publicación
            while ($row = $result->fetch_assoc()) {
                echo '<div class="card">';
                echo '<a href="documento.php?idPublicacion=' . htmlspecialchars($row['idPublicacion']) . '">';
                echo '<img src="https://picsum.photos/600/400?random=' . htmlspecialchars($row['idPublicacion']) . '" alt="' . htmlspecialchars($row['Nombre']) . '" class="card-image">';
                echo '<div class="card-content">';
                echo '<h2>' . htmlspecialchars($row['Nombre']) . '</h2>';
                echo '<p>' . htmlspecialchars($row['autor']) . '</p>';
                echo '<p>' . htmlspecialchars($row['nombreCarrera']) . '</p>';
                echo '<div class="stars">';
                echo '<span>' . str_repeat('⭐', htmlspecialchars($row['valoracion'])) . '</span>';
                echo '</div>';
                echo '</div>';
                echo '</a>';
                echo '</div>';
            }
        } else {
            echo "<p>No se encontraron resultados.</p>";
        }

        // Cerrar conexión
        $conn->close();
        ?>
            
        </section>
    </div>

    <?php require_once 'pie.php' ?>

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
