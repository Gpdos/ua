<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Inicio</title>
    <link rel="stylesheet" href="style/index.css">
    <link rel="stylesheet" href="style/styles.css">

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
            <div class="section-header">
                <!-- <label for="lang">Lenguaje</label> -->
                <select name="lenguajes" id="lang">
                    <option value="#">Ingeniería Multimedia</option>
                    <option value="#">Arquitectura</option>
                    <option value="#">Derecho</option>
                </select>
                <!-- <input type="submit" value="Enviar" /> -->
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
                <!-- <div id="div_flecha"> -->
                    <i class="fa-solid fa-circle-right"></i>
                <!-- </div> -->
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
    <footer>
        <p>© 2024 Mosaícoa. Todos los derechos reservados.</p>
    </footer>
</body>

</html>
