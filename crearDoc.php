<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Crear publicacion</title>
    <link rel="stylesheet" href="style/crearDoc.css">
    <script src="https://kit.fontawesome.com/8f5be8334f.js" crossorigin="anonymous"></script>


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poetsen+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="fontello-10643fc5/css/fontello.css">
</head>

<body>

    <header>
        <div id="izq">
        
            <img src="fotos/gato.jpg" alt="logo" id="logo">

            <!-- Menú desplegable -->
            <div class="dropdown">
                <button class="dropbtn"><i class="fa-solid fa-bars"></i></button>
                <div class="dropdown-content">
                    <a href="#"><i class="fas fa-user"></i> Mi Perfil</a>
                    <a href="colecciones.php"><i class="fas fa-folder"></i> Mis Colecciones</a>
                    <a href="ajustes.php"><i class="fas fa-cog"></i> Configuración</a>
                    <a href="#"><i class="fas fa-question-circle"></i> Ayuda</a>
                </div>
            </div>
        </div>

        <div id="cen">
            <a href="index.php" style="text-decoration: none; color: white; text-align: center; display: block;">
                <i class="fa-solid fa-house"></i>
                <span style="display: block; font-size: 12px;">Inicio</span>
            </a>

            <a href="buscar.php" style="text-decoration: none; color: white; text-align: center; display: block;">
                <i class="fa-solid fa-compass"></i>
                <span style="display: block; font-size: 12px;">Buscar</span>
            </a>

            <a href="subidos.php" style="text-decoration: none; color: white; text-align: center; display: block;">
                <i class="fa-solid fa-file-alt"></i>
                <span style="display: block; font-size: 12px;">Mis archivos</span>
            </a>


            <a href="crearDoc.php" style="text-decoration: none; color: white; text-align: center; display: block;">
                <i class="fa-solid fa-plus"></i>
                <span style="display: block; font-size: 12px;">Nuevo</span>
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
        <!-- <div id="global"> -->
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
                    <div class="editar_datos">
                        <p>Autor:</p>
                        <textarea name="textarea" rows="1" cols="30">Autor...</textarea>
                    </div>
                    <div class="editar_datos">
                        <p>Estudio:</p>
                        <textarea name="textarea" rows="1" cols="30">Estudio...</textarea>
                    </div>

                    <div class="editar_datos">
                        <p>Tipo de recurso:</p>
                        <textarea name="textarea" rows="1" cols="30">Tipo de recurso...</textarea>
                    </div>

                    <div class="editar_datos">
                        <p>Fecha de publicacion:</p>
                        <textarea name="textarea" rows="1" cols="30">Fecha de publicacion...</textarea>
                    </div>

                    <div class="editar_datos">
                        <p>Bibliografia:</p>
                        <textarea name="textarea" rows="1" cols="30">Bibliografia...</textarea>
                    </div>
                </div>

            </div>
        </div>
        <!-- </div> -->
    </main>

    <footer>
        <p>© 2024 Mosaícoa. Todos los derechos reservados.</p>
    </footer>


</body>

</html>
