<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ajustes</title>
    <link id="default-stylesheet" rel="stylesheet" href="style/ajustes.css">
    <link id="night-stylesheet" rel="stylesheet" href="style/funcionales/noche/ajustesN.css" disabled>
    <link id="high-contrast-stylesheet" rel="stylesheet" href="style/funcionales/contraste.css" disabled>
    <link id="read-mode-stylesheet" rel="stylesheet" href="style/funcionales/lectura.css" disabled>
    <script src="https://kit.fontawesome.com/8f5be8334f.js" crossorigin="anonymous"></script>


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poetsen+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="fontello-10643fc5/css/fontello.css">
</head>
<body>
<div id="header-container"></div>


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
