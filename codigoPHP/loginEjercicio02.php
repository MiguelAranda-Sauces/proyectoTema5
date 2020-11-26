<?php

/*
 * @autor: Miguel Angel Aranda Garcia <miguela.aragar@educa.jcyl.es>
 * @version 1.1
 * @since 24/11/2020 1.0: Creamos el login mediante $_SERVER y Acceso a la base de datos 1.1 Eliminación de comprobación si esta vacio $_SERVER usuario y password si pulsamos cancelar devuelve error
 */

if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])) {
    header('WWW-Authenticate: Basic realm=\"Private Area\"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'Usuario o password incorrectos';
    exit;
} else {
    require_once "../config/conexionBDPDO.php"; //incluimos la conexión a la BD
    try {
        $miDB = new PDO(DNS, USER, PASSWORD, CODIFICACION);
        $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $usuarioInsertUsuario = $_SERVER['PHP_AUTH_USER'];
        $passInsertUsuario = $_SERVER['PHP_AUTH_PW'];

        $consultarDep = "SELECT CodUsuario, Password FROM Usuario WHERE CodUsuario=:CodUsuario"; //Creamos la consulta mysq

        $consultaLogin = $miDB->prepare($consultarDep); //Preparamos la consulta
        $consultaLogin->bindParam(":CodUsuario", $usuarioInsertUsuario); //Declaramos el parametro bind

        $consultaLogin->execute(); //Ejecutamos la consulta preparada
        $oUsuario = $consultaLogin->fetchObject(); //creamos el objeto PDO de usuario

        if ($oUsuario->CodUsuario == $usuarioInsertUsuario && $oUsuario->Password == hash("sha256", $usuarioInsertUsuario . $passInsertUsuario)) {//concatenamos el usuario y la password
            session_start(); //iniciamos la sesión
            $_SESSION['usuario'] = $usuarioInsertUsuario; //asignamos el valor del usuario al objero de sesion
            header("Location: ejercicio02.php"); //redirigimos
        } else {
            header('WWW-Authenticate: Basic realm=\"Private Area\"');
            header('HTTP/1.0 401 Unauthorized');
            echo 'Usuario o password incorrectos';
            exit;
        }
    } catch (PDOException $miExcepcionPDO) {
        echo "<div class='contenedorError'>";
        echo "<div class='box'>";
        echo "<p class='error'>Error " . $miExcepcionPDO->getMessage() . "</p>";
        echo "<p class='error'>Cod.Error " . $miExcepcionPDO->getCode() . "</p>";
        echo "<h2 class='error'>Error en la conexión con la base de datos</h2>";
        echo "</div>";
    } finally {
        unset($miConexion); //cerramos la conexión
    }
}
?>