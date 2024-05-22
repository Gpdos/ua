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

    // Preparar y ejecutar la consulta SQL para obtener los datos de la publicación junto con el nombre de la carrera y el tipo de trabajo
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

    // Comprobar si la consulta devuelve algún resultado
    if ($result->num_rows > 0) {
        // Obtener los datos de la publicación
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

    // Cerrar la consulta
    $sql->close();
} else {
    echo "No se proporcionó un ID de publicación.";
}

// Manejar la solicitud POST para agregar un comentario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['comentario']) && !empty($_POST['comentario']) && isset($_POST['idPublicacion']) && !empty($_POST['idPublicacion'])) {
    // Obtener los datos del formulario
    $comentario = $_POST['comentario'];
    $valoracionComentario = $_POST['valoracionComentario'];
    $idPublicacion = $_POST['idPublicacion'];
    $autorComentario = isset($_POST['autorComentario']) ? $_POST['autorComentario'] : 'Anonimo';

    // Preparar y ejecutar la consulta SQL para insertar el comentario
    $sql = $conn->prepare("INSERT INTO comentario (publicacion, texto, autor, valoracion) VALUES (?, ?, ?, ?)");
    $sql->bind_param("issi", $idPublicacion, $comentario, $autorComentario, $valoracionComentario);

    if ($sql->execute()) {
        echo "Comentario añadido con éxito.";
    } else {
        echo "Error al añadir el comentario: " . $conn->error;
    }

    // Cerrar la consulta
    $sql->close();
}

// Obtener los comentarios existentes para la publicación
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

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Publicacion</title>
    <link id="default-stylesheet" rel="stylesheet" href="style/documento.css">
    <link id="night-stylesheet" rel="stylesheet" href="style/funcionales/noche/documentoN.css" disabled>
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
                        <h3>Comentarios:</h3>
                        <?php foreach ($comentarios as $comentario): ?>
                            <div class="comentario">
                                <p><strong><?php echo htmlspecialchars($comentario['autorNombre']); ?>:</strong> <?php echo htmlspecialchars($comentario['texto']); ?></p>
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
                        <textarea name="comentario" rows="10" cols="50" required>Escribe algo interesante</textarea>
                        <input type="hidden" name="idPublicacion" value="<?php echo htmlspecialchars($idPublicacion); ?>">
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
                            <button type="submit">Enviar</button>
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
                    <a href="editarDoc.php?idPublicacion=<?php echo htmlspecialchars($idPublicacion); ?>">
                    <button>Editar</button>
                </a>
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
        window.onload = function() {
            applySettings();

            // Obtener userId desde sessionStorage y asignarlo al campo oculto autorComentario
            const userId = sessionStorage.getItem('userId');
            if (userId) {
                document.getElementById('autorComentario').value = userId;
            }
        };
    </script>
</body>
</html>
