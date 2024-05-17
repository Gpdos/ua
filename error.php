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
    <?php require_once 'encabezadosinreg.php' ?>

    <main>
    <div class="paginacentral">
                <form action="registro.php">
                    <h2>ATENCIÓN</h2>
                    <h4>Regístrate o inicia sesión para poder acceder</h4>
                    <div class="boton">
                        <input type="submit" value="REGÍSTRATE!">
                    </div>
                </form>
                <form action="login.php">
                    <div class="boton">
                        <input type="submit" value="INICIA SESIÓN!">
                    </div>
                </form>
            </div>
    </main>
    <?php require_once 'pie.php' ?>
</body>

</html>
