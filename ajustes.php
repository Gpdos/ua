<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ajustes</title>
    <link rel="stylesheet" href="style/ajustes.css">
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
                <h2>Ajustes de cuenta</h2>
                <ul>
                    <li><a href="#editar">Editar Perfil</a></li>
                    <li><a href="colecciones.php">Mis Colecciones</a></li>
                    <li><a href="#cuenta">Ajustes de Cuenta</a></li>
                    <li><a href="#seguridad">Seguridad</a></li>
                    <li><a href="#privacidad">Privacidad</a></li>
                    <li><a href="config.php">Accesibilidad</a></li>
                    <li><a href="#sesion">Cerrar Sesión</a></li>
                </ul>
            </aside>
        </div>
        <div class="seccionesCen">
        <section class="settings-details">
            <h2>USUARIO01</h2>
            <p>13 publicaciones</p>
            <p>Grado en Ingeniería Multimedia</p>
            <p>Universidad de Alicante</p>
        </section>
        <section class="publications">
            <div class="card">
                <a href="documento.php">
                <img src="fotos/arquitectura.jpg" alt="Arquitectura" class="card-image">
                <div class="card-content">
                    <h2>TFG Arquitectura</h2>
                    <p>Pepe Viyuela</p>
                    <p>Ing. Multimedia</p>
                    <div class="stars">
                        <span>⭐⭐⭐</span>
                    </div>
                    <p>10/06/2003</p>
                </div>
            </a>
            </div>
            <div class="card">
                <a href="documento.php">
                <img src="fotos/arquitectura.jpg" alt="Arquitectura" class="card-image">
                <div class="card-content">
                    <h2>TFG Arquitectura</h2>
                    <p>Pepe Viyuela</p>
                    <p>Ing. Multimedia</p>
                    <div class="stars">
                        <span>⭐⭐⭐</span>
                    </div>
                    <p>10/06/2003</p>
                </div>
            </a>
            </div>
            <div class="card">
                <a href="documento.php">
                <img src="fotos/arquitectura.jpg" alt="Arquitectura" class="card-image">
                <div class="card-content">
                    <h2>TFG Arquitectura</h2>
                    <p>Pepe Viyuela</p>
                    <p>Ing. Multimedia</p>
                    <div class="stars">
                        <span>⭐⭐⭐</span>
                    </div>
                    <p>10/06/2003</p>
                </div>
            </a>
            </div><!-- Aquí puede ir el contenido de las publicaciones del usuario -->
        </section>

    </div>
    </div>

    <footer>
        <p>© 2024 Mosaicua. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
