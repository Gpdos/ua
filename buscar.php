<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Buscar</title>
    <link id="default-stylesheet" rel="stylesheet" href="style/buscar.css">
    <link id="night-stylesheet" rel="stylesheet" href="style/funcionales/noche/buscarN.css" disabled>
    <link id="high-contrast-stylesheet" rel="stylesheet" href="style/funcionales/contraste/buscarC.css" disabled>
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
        
        <aside class="filters">
            <div class="search-bar">
                <input type="text" placeholder="Buscar...">
            </div>
            <h2>Filtros de búsqueda</h2>
            <div>
                <h3>Categoría</h3>
                <label><input type="checkbox"> Proyectos</label>
                <label><input type="checkbox"> Fin de grado</label>
                <label><input type="checkbox"> Prácticas</label>
                <label><input type="checkbox"> Más</label>
            </div>
            <div>
                <h3>Grado</h3>
                <label><input type="checkbox"> Ingeniería Civil</label>
                <label><input type="checkbox"> Ingeniería Multimedia</label>
                <label><input type="checkbox"> Arquitectura técnica</label>
                <label><input type="checkbox"> Más</label>
            </div>
            <div>
                <h3>Curso</h3>
                <label><input type="checkbox"> 1º</label>
                <label><input type="checkbox"> 2º</label>
                <label><input type="checkbox"> 3º</label>
                <label><input type="checkbox"> 4º</label>
                <label><input type="checkbox"> Máster</label>
            </div>
            <div>
                <h3>Formato</h3>
                <label><input type="checkbox"> PDF</label>
                <label><input type="checkbox"> Excel</label>
                <label><input type="checkbox"> PowerPoint</label>
                <label><input type="checkbox"> Más</label>
            </div>
        </aside>
        <section class="search-results">
           
            <?php for ($i = 0; $i < 4; $i++): ?>
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
                        </div>
                    </a>
                </div>
            <?php endfor; ?>
            
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
