<?php

/*
 * @autor: Miguel Angel Aranda Garcia <miguela.aragar@educa.jcyl.es>
 * @version 1.1
 * @since 24/11/2020 1.0: Creación de $_Server 1.1 Eliminación de comprobación empy("Solo queremos saber lo que mete el usuario ponlo como javier"), prueba $_Sesion
 */

/* if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']) || empty($_SERVER['PHP_AUTH_USER']) || empty($_SERVER['PHP_AUTH_PW'])) {
  header("WWW-Authenticate: Basic realm=\"Private Area\"");
  header("HTTP/1.0 401 Unauthorized");
  print "Error al logear";
  exit;
  } else {
  if (($_SERVER['PHP_AUTH_USER'] == 'admin') && (hash('sha256', $_SERVER['PHP_AUTH_PW']) == '4dd09b8f659e27847f94782920fb7e41b2c5afbd7f419a4a3ed8ab7aa5b7f944')) {
  header("Location: ejercicio01.php");
  } else {
  header("WWW-Authenticate: Basic realm=\"Private Area\"");
  header("HTTP/1.0 401 Unauthorized");
  print "Error al logear";
  exit;
  }
  } */
if (($_SERVER['PHP_AUTH_USER'] == 'admin') && (hash('sha256', $_SERVER['PHP_AUTH_PW']) == '4dd09b8f659e27847f94782920fb7e41b2c5afbd7f419a4a3ed8ab7aa5b7f944')) { //comprobamo a logeado con admin paso
    if (!isset($_COOKIE['idioma'])) { //si no esta creada la cookie de idioma la iniciamos
        setcookie('idioma', "ES");
    }
    header("Location: ejercicio01.php"); //redirigimos a ejercicio 1
} else {
    header('WWW-Authenticate: Basic realm=\"Private Area\"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'Usuario o password incorrectos';
    exit;
}
?>