<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Configuración</title>
    <link id="default-stylesheet" rel="stylesheet" href="style/config.css">
    <link id="night-stylesheet" rel="stylesheet" href="style/funcionales/noche/configN.css" disabled>
    <link id="high-contrast-stylesheet" rel="stylesheet" href="style/funcionales/contraste/configC.css" disabled>
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
                <h2>Configuración</h2>
                <ul>
                    <li><a href="ajustes.php">Volver</a></li>

                    <li><a href="#sesion" onclick=logout()>Cerrar sesión</a></li>
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
                    <input type="radio" id="default-style" name="style" value="default" checked>
                    <label for="default-style">Por defecto</label>
                    <input type="radio" id="night-mode" name="style" value="night">
                    <label for="night-mode">Modo noche</label>
                    <input type="radio" id="high-contrast" name="style" value="high-contrast">
                    <label for="high-contrast">Alto contraste</label>
                    <input type="radio" id="read-mode" name="style" value="read-mode">
                    <label for="read-mode">Modo lectura (sin distracciones)</label>
                </fieldset>

                <button type="button" onclick="saveSettings()">Guardar configuración</button>
                
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

    <script>
       function saveSettings() {
    // Obtener el tamaño de la fuente seleccionado
    const fontSize = document.getElementById('font-size').value;
    // Obtener el estilo visual seleccionado
    const style = document.querySelector('input[name="style"]:checked').value;

    // Guardar en sessionStorage
    sessionStorage.setItem('fontSize', fontSize);
    sessionStorage.setItem('style', style);

    // Recargar la página
    window.location.reload();
}


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
