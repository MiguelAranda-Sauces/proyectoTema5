<?php
session_start();
if(!isset($_SESSION['usuario'])){
    header("Location: loginEjercicio02.php");
    exit;
}

if (isset($_POST['close'])) {
    session_destroy();
    header("Location: ../proyectoTema5.html");
    exit;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ejercicio 02 - Miguel Angel Aranda Garcia -</title>
        <link rel="stylesheet" type="text/css" href="webroot/css/style.css">
    </head>
    <body>
        <h1>Miguel Angel Aranda Garcia</h1>
        <h2><?php echo $_SESSION['usuario']; ?> </h2>
        <form  name="logout" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <button type="submit" name='close' value="Cerrar Sesion" >Cerrar Sesion</button>
        </form>
        <a href="../proyectoTema5.html"><button>Volver</button></a>
        <a href="ejercicio00.php"><button>Detalles Servidor</button></a>

    </body>
</html>
