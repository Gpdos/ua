<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Configuración</title>
    <link rel="stylesheet" href="style/config.css">
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

    <div class="main-content">
        <div class="profile-container">
            <img src="fotos/gato.jpg" alt="Foto de perfil" class="profile-pic">
        
            <aside class="settings-menu">
                <h2>Configuración</h2>
                <ul>
                    <li><a href="ajustes.php">Ajustes de cuenta</a></li>
                    <li><a href="#seguridad">Seguridad</a></li>
                    <li><a href="#privacidad">Privacidad</a></li>
                    <li><a href="#accesibilidad">Accesibilidad</a></li>
                    <li><a href="#sesion">Cerrar sesión</a></li>
                </ul>
            </aside>
        </div>
        <section class="settings-details">
            <h2>Opciones de Accesibilidad</h2>
            <form>
                <label for="font-size">Tamaño de fuente:</label>
                <select id="font-size">
                    <option value="12px">12 px</option>
                    <option value="14px">14 px</option>
                    <option value="16px">16 px</option>
                    <option value="18px">18 px</option>
                </select>
                
                <fieldset>
                    <legend>Estilo visual:</legend>
                    <input type="radio" id="default-style" name="style" checked>
                    <label for="default-style">Por defecto</label>
                    <input type="radio" id="night-mode" name="style">
                    <label for="night-mode">Modo noche</label>
                    <input type="radio" id="high-contrast" name="style">
                    <label for="high-contrast">Alto contraste</label>
                    <input type="radio" id="read-mode" name="style">
                    <label for="read-mode">Modo lectura (sin distracciones)</label>
                </fieldset>
                <p>En nuestra página, estamos comprometidos con la accesibilidad y hemos implementado varias características para asegurar que todos los usuarios puedan navegar eficientemente y con comodidad:</p>
    <ul>
        <li><strong>Colores con Alto Contraste:</strong> Nuestra interfaz utiliza una paleta de colores con alto contraste para mejorar la legibilidad para usuarios con visión reducida.</li>
        <li><strong>Resalto de Secciones al Pasar el Ratón:</strong> Las secciones importantes de la página se resaltan cuando el usuario pasa el ratón por encima, facilitando la identificación de áreas interactivas.</li>
        <li><strong>Modo Noche:</strong> Ofrecemos un modo noche que reduce la luminosidad de la pantalla para disminuir la fatiga ocular en ambientes de baja luz.</li>
        <li><strong>Modo de Alto Contraste:</strong> Además del esquema de colores por defecto, los usuarios pueden seleccionar un modo de alto contraste que aumenta la diferencia entre el fondo y el texto.</li>
        <li><strong>Modo Lectura:</strong> Esta opción permite a los usuarios disfrutar de una vista simplificada de nuestra página, eliminando elementos distractores y centrando el contenido en el texto principal.</li>
        <li><strong>Opciones de Tamaño de Fuente:</strong> Los usuarios pueden ajustar el tamaño de la fuente desde nuestra página de configuración, lo que facilita la lectura a quienes necesitan tamaños de letra más grandes.</li>
    </ul>
                
            </form>
        </section>
    </div>

    <?php require_once 'pie.php' ?>

    
</body>
</html>
