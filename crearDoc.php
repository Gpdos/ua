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

// Inicializar variables para almacenar los mensajes de error y éxito
$error = "";
$success = "";

// Manejar la solicitud POST cuando se envía el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $autor = $_POST['autor'];
    $carrera = $_POST['carrera'];
    $tipo = $_POST['tipo'];
    $valoracion = $_POST['valoracion'];
    $fecha = $_POST['fecha'];

    // Preparar y ejecutar la consulta SQL para insertar los datos en la tabla de publicaciones
    $sql = $conn->prepare("INSERT INTO publicacion (Nombre, autor, carrera, tipo, valoracion, fecha) VALUES (?, ?, ?, ?, ?, ?)");
    $sql->bind_param("ssiiis", $nombre, $autor, $carrera, $tipo, $valoracion, $fecha);

    if ($sql->execute()) {
        $success = "Publicación creada con éxito.";
    } else {
        $error = "Error al crear la publicación: " . $conn->error;
    }

    // Cerrar la consulta
    $sql->close();
}

// Obtener las opciones de estudio y tipo de trabajo para los selectores
$estudios = [];
$tipos = [];

// Consulta para obtener los estudios
$sql_estudios = "SELECT idEstudio, Nombre FROM estudio";
$result_estudios = $conn->query($sql_estudios);
if ($result_estudios->num_rows > 0) {
    while ($row = $result_estudios->fetch_assoc()) {
        $estudios[] = $row;
    }
}

// Consulta para obtener los tipos de trabajo
$sql_tipos = "SELECT idTipo, Nombre FROM tipotrabajo";
$result_tipos = $conn->query($sql_tipos);
if ($result_tipos->num_rows > 0) {
    while ($row = $result_tipos->fetch_assoc()) {
        $tipos[] = $row;
    }
}

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Crear publicacion</title>
    <link id="default-stylesheet" rel="stylesheet" href="style/crearDoc.css">
    <link id="night-stylesheet" rel="stylesheet" href="style/funcionales/noche.css" disabled>
    <link id="high-contrast-stylesheet" rel="stylesheet" href="style/funcionales/contraste.css" disabled>
    <link id="read-mode-stylesheet" rel="stylesheet" href="style/funcionales/lectura.css" disabled>
    <script src="https://kit.fontawesome.com/8f5be8334f.js" crossorigin="anonymous"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poetsen+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="fontello-10643fc5/css/fontello.css">
</head>

<body>

    <header>
        <div id="izq">
            <a href="ajustes.php"><img src="fotos/gato.jpg" alt="logo" id="logo"></a>
            <div class="dropdown">
                <button class="dropbtn"><i class="fa-solid fa-bars"></i></button>
                <div class="dropdown-content">
                    <a href="ajustes.php"><i class="fas fa-user"></i> Mi Perfil</a>
                    <a href="colecciones.php"><i class="fas fa-folder"></i> Mis Colecciones</a>
                    <a href="config.php"><i class="fas fa-cog"></i> Configuración</a>
                    <a href="#"><i class="fas fa-question-circle"></i> Ayuda</a>
                </div>
            </div>
        </div>

        <div id="cen">
            <a href="index.php" style="text-decoration: none; color: white; text-align: center; display: block;">
                <i class="fa-solid fa-house"></i>
                <span style="display: block; font-size: 12px;">Inicio</span>
            </a>
            <a href="subidos.php" style="text-decoration: none; color: white; text-align: center; display: block;">
                <i class="fa-solid fa-file-alt"></i>
                <span style="display: block; font-size: 12px;">Mis archivos</span>
            </a>
            <a href="buscar.php" style="text-decoration: none; color: white; text-align: center; display: block;">
                <i class="fa-solid fa-compass"></i>
                <span style="display: block; font-size: 12px;">Buscar</span>
            </a>
            <a href="crearDoc.php" style="text-decoration: none; color: white; text-align: center; display: block;">
                <i class="fa-solid fa-plus"></i>
                <span style="display: block; font-size: 12px;">Nuevo</span>
            </a>
            <a href="ajustes.php" style="text-decoration: none; color: white; text-align: center; display: block;">
                <i class="fa-solid fa-user"></i>
                <span style="display: block; font-size: 12px;">Mi Perfil</span>
            </a>
            <a href="login.php" style="text-decoration: none; color: white; text-align: center; display: block;">
                <i class="fa-solid fa-sign-in-alt"></i>
                <span style="display: block; font-size: 12px;">Cerrar Sesión</span>
            </a>
        </div>

        <div id="dch">
            <p>Mosaicua</p>
        </div>
    </header>

    <main>
        <div id="body_izq">
            <h2>Titulo publicacion</h2>
            <div id="publicacion">
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
                        <div>
                            <button type="submit">Crear Publicación</button>
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

        // Aplicar configuración cuando la página se carga
        window.onload = applySettings;
    </script>
</body>

</html>
