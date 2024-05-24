<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Archivos subidos</title>
<script src="https://kit.fontawesome.com/8f5be8334f.js" crossorigin="anonymous"></script>


<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poetsen+One&display=swap" rel="stylesheet">
<link rel="stylesheet" href="fontello-10643fc5/css/fontello.css">
<link id="default-stylesheet" rel="stylesheet" href="style/subidos.css">
    <link id="night-stylesheet" rel="stylesheet" href="style/funcionales/noche/subidosN.css" disabled>
    <link id="high-contrast-stylesheet" rel="stylesheet" href="style/funcionales/contraste/subidosC.css" disabled>
    <link id="read-mode-stylesheet" rel="stylesheet" href="style/funcionales/lectura/subidosS.css" disabled>

</head>
<body>
<div id="header-container"></div>

<div class="container">
    <div class="tabs">
        <button class="tab-btn active">Subidas recientes</button>
        <button class="tab-btn">Categorías</button>
        <button class="tab-btn">Tamaño</button>
        <button class="tab-btn">Favoritos</button>
    </div>
</div>


<div class="group-works">
    <h3>Trabajos en grupo:</h3>
    <div class="carousel">
        <a href="documento.php" class="work">
            <img src="fotos/arquitectura.jpg">
            <div class="work-details">
                <h4>Trabajo de botánica</h4>
                <p>Jose Ramón</p>
                <p>Ing. Agrónoma</p>
                <p>⭐⭐⭐</p>
                <p>01/01/2024</p>
            </div>
        </a>

        <!-- Más trabajos aquí -->
        <a href="documento.php" class="work">
            <img src="fotos/arquitectura.jpg">
            <div class="work-details">
                <h4>Trabajo de botánica</h4>
                <p>Jose Ramón</p>
                <p>Ing. Agrónoma</p>
                <p>⭐⭐⭐</p>
                <p>01/01/2024</p>
            </div>
        </a>
        <!-- Más trabajos aquí -->

        <a href="documento.php" class="work">
            <img src="fotos/arquitectura.jpg">
            <div class="work-details">
                <h4>Trabajo de botánica</h4>
                <p>Jose Ramón</p>
                <p>Ing. Agrónoma</p>
                <p>⭐⭐⭐</p>
                <p>01/01/2024</p>
            </div>
        </a>
        <!-- Más trabajos aquí -->

        <a href="documento.php" class="work">
            <img src="fotos/arquitectura.jpg">
            <div class="work-details">
                <h4>Trabajo de botánica</h4>
                <p>Jose Ramón</p>
                <p>Ing. Agrónoma</p>
                <p>⭐⭐⭐</p>
                <p>01/01/2024</p>
            </div>
        </a>
        <!-- Más trabajos aquí -->


    </div>
</div>


<div class="group-works model-3d">
    <h3>Modelos 3D:</h3>
    <div class="carousel">
        <a href="documento.php" class="work">
            <img src="fotos/arquitectura.jpg">
            <div class="work-details">
                <h4>Trabajo de botánica</h4>
                <p>Jose Ramón</p>
                <p>Ing. Agrónoma</p>
                <p>⭐⭐⭐</p>
                <p>01/01/2024</p>
            </div>
        </a>
        <!-- Más modelos aquí -->

        <a href="documento.php" class="work">
            <img src="fotos/arquitectura.jpg">
            <div class="work-details">
                <h4>Trabajo de botánica</h4>
                <p>Jose Ramón</p>
                <p>Ing. Agrónoma</p>
                <p>⭐⭐⭐</p>
                <p>01/01/2024</p>
            </div>
        </a>
        <!-- Más modelos aquí -->

        <a href="documento.php" class="work">
            <img src="fotos/arquitectura.jpg">
            <div class="work-details">
                <h4>Trabajo de botánica</h4>
                <p>Jose Ramón</p>
                <p>Ing. Agrónoma</p>
                <p>⭐⭐⭐</p>
                <p>01/01/2024</p>
            </div>
        </a>
        <!-- Más modelos aquí -->

        <a href="documento.php" class="work">
            <img src="fotos/arquitectura.jpg">
            <div class="work-details">
                <h4>Trabajo de botánica</h4>
                <p>Jose Ramón</p>
                <p>Ing. Agrónoma</p>
                <p>⭐⭐⭐</p>
                <p>01/01/2024</p>
            </div>
        </a>
        <!-- Más modelos aquí -->

        <a href="documento.php" class="work">
            <img src="fotos/arquitectura.jpg">
            <div class="work-details">
                <h4>Trabajo de botánica</h4>
                <p>Jose Ramón</p>
                <p>Ing. Agrónoma</p>
                <p>⭐⭐⭐</p>
                <p>01/01/2024</p>
            </div>
        </a>
        <!-- Más modelos aquí -->

        <a href="documento.php" class="work">
            <img src="fotos/arquitectura.jpg">
            <div class="work-details">
                <h4>Trabajo de botánica</h4>
                <p>Jose Ramón</p>
                <p>Ing. Agrónoma</p>
                <p>⭐⭐⭐</p>
                <p>01/01/2024</p>
            </div>
        </a>
        <!-- Más modelos aquí -->

        <a href="documento.php" class="work">
            <img src="fotos/arquitectura.jpg">
            <div class="work-details">
                <h4>Trabajo de botánica</h4>
                <p>Jose Ramón</p>
                <p>Ing. Agrónoma</p>
                <p>⭐⭐⭐</p>
                <p>01/01/2024</p>
            </div>
        </a>
        <!-- Más modelos aquí -->
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

