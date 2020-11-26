<?php
if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']) || empty($_SERVER['PHP_AUTH_USER']) || empty($_SERVER['PHP_AUTH_PW'])) {
    header("Location: loginEjercicio01.php");
    exit;
} else {
    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTF-8">
            <title>Ejercicio 01 - Miguel Angel Aranda Garcia -</title>
            <link rel="stylesheet" type="text/css" href="webroot/css/style.css">
        </head>
        <body>
            <h1>Miguel Angel Aranda Garcia</h1>
            <p><?php echo $_COOKIE['idioma']; ?></p>
            <a href="../proyectoTema5.html"><button>Volver</button></a>
            <a href="ejercicio00.php"><button>Detalles Servidor</button></a>

        </body>
    </html>
    <?php
}
?>