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

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Publicacion</title>
    <link id="default-stylesheet" rel="stylesheet" href="style/documento.css">
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
            <!-- Menú desplegable -->
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
            <h2 id="titulo"><?php echo htmlspecialchars($nombre); ?></h2>
            <div id="publicacion">
                <div id="publicacion_arr">
                    <img src="https://picsum.photos/600/400?random=<?php echo htmlspecialchars($idPublicacion); ?>" alt="Imagen publicacion" class="sombra">
                    <div id="descripcion" class="sombra">
                        <p><?php echo htmlspecialchars($tipo); ?></p>
                        <p>Valoracion media:</p>
                        <div class="stars">
                            <span><?php echo str_repeat('⭐', htmlspecialchars($valoracion)); ?></span>
                        </div>
                        <a href="editarDoc.php">
                            <button>Editar</button>
                        </a>
                    </div>
                </div>
                <hr>
                <div id="publicacion_abj">
                    <img src="https://picsum.photos/600/400?random=4" alt="Imagen publicacion" class="sombra">
                    <img src="https://picsum.photos/600/400?random=1" alt="Imagen publicacion" class="sombra">
                    <img src="https://picsum.photos/600/400?random=2" alt="Imagen publicacion" class="sombra">
                    <img src="https://picsum.photos/600/400?random=3" alt="Imagen publicacion" class="sombra">
                </div>
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
                            <span><?php echo str_repeat('⭐', htmlspecialchars($valoracion)); ?></span>
                        </div>
                        <button>Enviar</button>
                    </div>
                </div>
            </div>
            <div id="body_abj">
                <div id="contenedorTexto">
                    <p>Autor: <?php echo htmlspecialchars($autor); ?></p>
                    <?php
                    switch ($carrera) {
                                case '1':
                                    $carrera = 'Ingeniería Multimedia';
                                    break;
                                case '3':
                                    $carrera = 'Arquitectura';
                                    break;
                                case '2':
                                    $carrera = 'Economia';
                                    break;
                                default:
                                    $carrera = 'Carrera no disponible';
                                    break;
                            }
                    ?>
                    <p>Estudio: <?php echo htmlspecialchars($carrera); ?></p>
                    <p>Tipo de recurso: <?php echo htmlspecialchars($tipo); ?></p>
                    <p>Fecha de publicacion: <?php echo htmlspecialchars($fecha); ?></p>
                    <p>Bibliografia: </p>
                    <ul>
                        <li>Referencias</li>
                        <li>Lazarillo de Tormes</li>
                    </ul>
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
