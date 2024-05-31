<header>
    <div id="izq">
        <a href="ajustes.php"><img src="fotos/gato.jpg" alt="logo" id="logo"></a>

        <div class="dropdown">
            <button class="dropbtn"><i class="fa-solid fa-bars"></i></button>
            <div class="dropdown-content">
                <a href="ajustes.php"><i class="fas fa-user"></i> Mi Perfil</a>
                <a href="colecciones.php"><i class="fas fa-folder"></i> Mis Colecciones</a>
                <a href="config.php"><i class="fas fa-cog"></i> Configuración</a>
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

        <button id="logoutButton" style="text-decoration: none; color: white; text-align: center; display: block; background: none; border: none; cursor: pointer;" onclick="logout()">
            <i class="fa-solid fa-sign-in-alt"></i>
            <span style="display: block; font-size: 12px;">Cerrar Sesión</span>
        </button>

        
    </div>

    <div id="dch">
        <p>Mosaicua</p>
    </div>
</header>
