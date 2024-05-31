<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Inicio</title>
    <link id="default-stylesheet" rel="stylesheet" href="style/index.css">
    <link id="night-stylesheet" rel="stylesheet" href="style/funcionales/noche/indexN.css" disabled>
    <link id="high-contrast-stylesheet" rel="stylesheet" href="style/funcionales/contraste/indexC.css" disabled>
    <link id="read-mode-stylesheet" rel="stylesheet" href="style/funcionales/lectura/indexS.css" disabled>

    <script src="https://kit.fontawesome.com/8f5be8334f.js" crossorigin="anonymous"></script>


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poetsen+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="fontello-10643fc5/css/fontello.css">


</head>

<body>
<?php require_once 'encabezadosinreg.php' ?>
    <?php require_once 'encabezado.php' ?>

    <main>
        <div id="body_izq">
            <div class="section-header">
                <select name="lenguajes" id="lang">
                    <option value="#">Ingeniería Multimedia</option>
                    <option value="#">Arquitectura</option>
                    <option value="#">Derecho</option>
                </select>
            </div>

            <div class="content">
                <div class="content-block">
                    <img src="https://picsum.photos/600/400?random=4" alt="Práctica 1" >
                    <span>UA: Práctica 1</span>
                </div>
                <div class="content-block">
                    <img src="https://picsum.photos/600/400?random=3" alt="Prototipo Movimiento">
                    <span>FV: Prototipo movimiento</span>
                </div>
                <div class="content-block">
                    <img src="https://picsum.photos/600/400?random=2" alt="Prototipo Torreta">
                    <span>FV: Prototipo torreta</span>
                </div>
                <div class="content-block">
                    <img src="https://picsum.photos/600/400?random=1" alt="Hito 2">
                    <span>FV: Hito 2</span>
                </div>  
            </div>
        </div>

        <div id="body_der">
            <div id="div_arr">
                <h2 class="titulo">Recientes</h2>

                <div class="card">
                    <a href="documento.php">
                        <img src="https://picsum.photos/600/400?random=1" alt="Arquitectura" class="card-image">
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
                <div class="card">
                    <a href="documento.php">
                        <img src="https://picsum.photos/600/400?random=2" alt="Arquitectura" class="card-image">
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
                <div class="card">
                    <a href="documento.php">
                        <img src="https://picsum.photos/600/400?random=3" alt="Arquitectura" class="card-image">
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
                <div class="card">
                    <a href="documento.php">
                        <img src="https://picsum.photos/600/400?random=4" alt="Arquitectura" class="card-image">
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
                    <i class="fa-solid fa-circle-right"></i>
            </div>

            <div id="div_abj">
                <div>
                    <a href="buscar.php">
                        <div>
                            <h2>TFG's</h2>
                        </div>
                    </a>
                </div>

                <div>
                    <a href="buscar.php">
                        <div>
                            <h2>ABP</h2>
                        </div>
                    </a>
                </div>

                <div>
                    <a href="buscar.php">
                        <div>
                            <h2>Memorias</h2>
                        </div>
                    </a>
                </div>

                <div>
                    <a href="buscar.php">
                        <div>
                            <h2>Portfolio</h2>
                        </div>
                    </a>
                </div>

                <div>
                    <a href="buscar.php">
                        <div>
                            <h2>Proyectos</h2>
                        </div>
                    </a>
                </div>

                <div>
                    <a href="buscar.php">
                        <div>
                            <h2>Presentaciones</h2>
                        </div>
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
        window.onload = applySettings;
    </script>
</body>

</html>
