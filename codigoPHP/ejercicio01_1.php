<?php
/*
 * @autor: Miguel Angel Aranda Garcia <miguela.aragar@educa.jcyl.es>
 * @version 1.0
 * @since 24/11/2020 1.0:
 */

 if (!isset($_SERVER['PHP_AUTH_USER'])) {
        header("WWW-Authenticate: Basic realm=\"Private Area\"");
        header("HTTP/1.0 401 Unauthorized");
        print "Sorry - you need valid credentials to be granted access!\n";
        exit;
    } else {
        if (($_SERVER['PHP_AUTH_USER'] == 'paul') && ($_SERVER['PHP_AUTH_PW'] == 'hudson')) {
            print "Welcome to the private area!";
        } else {
            header("WWW-Authenticate: Basic realm=\"Private Area\"");
            header("HTTP/1.0 401 Unauthorized");
            print "Sorry - you need valid credentials to be granted access!\n";
            exit;
        }
    }

?>
<!DOCTYPE html>

<html>
    <head>
        <title>Login header sha2</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../webroot/css/stylelogin.css">
        <link rel="stylesheet" type="text/css" href="../webroot/css/style_1.css">
    </head>
    <body>
        <div id="cabecera">
            <div id="titulo">
                <h1>Login header sha2</h1>
            </div>
            <div class="nav">
                <a href="../mtoDepartamentos.php" class="boton volver"><img class="icoBoton" src="../img/volver-flecha-izquierda.png"><span class="texto">Volver</span></a>
            </div>
        </div>
        <div id="contenedor"> 


            <?php
            require_once '../core/201109libreriaValidacion.php'; //incluimos la libreria de validación

            define("OBLIGATORIO", 1); //definimos e inicializamos la constante obligatorio a 1

            $entradaOK = true; //declaramos y inicializamos la variable entradaObligatorioK, esta variable decidira si es correcta la entrada de datos del formulario

            $aFormulario = [//declaramos y inicializamos el array de los campos del formulario a null
                "usuario" => null,
                "password" => null
            ];
            $aError = [//declaramos y inicializamos el array de los errores de los campos del formulario a null
                "usuario" => null,
                "password" => null
            ];

            if (isset($_REQUEST["login"])) {
                $aError["usuario"] = validacionFormularios::comprobarAlfabetico($_REQUEST["usuario"], 20, 1, OBLIGATORIO); //Validamos la entrada del formulario para el campo textfieldObligatorio siendo este alfabetico
                //$aError["password"] = validacionFormularios::validarPassword($_REQUEST["password"], 50, 3, OBLIGATORIO); //Validamos la entrada del formulario para el campo password siendo este alfabetico de tamaño max 50 minimo 3


                foreach ($aError as $errores => $value) { //Recorremos todos los campos del array $aError
                    if ($value != null) { //Si algun campo de $aError tiene un valor diferente null entonces entra
                        $entradaOK = false; // asignamos el valor a false en caso de que entre
                    }
                }
            } else {//si el usuario no ha pulsado el boton de enviar
                $entradaOK = false; //asignamos el valor a false ya que no se a enviado nada.
            }
            if ($entradaOK) {// si el valor es true entra
                
                echo "<div id='form'><h3>Se a insertado el departamento correctamente</h3></div>";
            } else {
                ?>
                <div id="form">
                    <form class="descript" action= "<?php echo $_SERVER["PHP_SELF"] ?>" method= "POST">
                        <div class="campos">
                            <label class="labelTitle" for="usuario">Usuario: </label>
                            <input  class="inputText" type="text" name="usuario" placeholder="Introduzca el nombre del usuario" 
                                    value="<?php echo isset($_REQUEST["usuario"]) ? isset($aError["usuario"]) ? null : $_REQUEST["usuario"] : null ?>"><!-- Comprobamos si el campo usuario a sido enviada, en cado positivo comprobamos si tiene error, en caso afirmativo borra el value del campo, en caso contrario deja el value se mantiene con el valor insertado correctamente y si el campo no a sido enviado el value se queda blanco-->
                                    <?php echo isset($aError["usuario"]) ? "<span class='error'>" . "<br>" . $aError["usuario"] . "</span>" : null ?>
                        </div>
                        <div class="campos">
                            <label class="labelTitle" for="password">Password: </label>
                            <input  class="inputText" type="password" name="password" 
                                    value="<?php echo isset($_REQUEST["password"]) ? isset($aError["password"]) ? null : $_REQUEST["password"] : null ?>"><!-- Comprobamos si el campo password a sido enviada, en cado positivo comprobamos si tiene error, en caso afirmativo borra el value del campo, en caso contrario deja el value se mantiene con el valor insertado correctamente y si el campo no a sido enviado el value se queda blanco-->
                            <?php echo isset($aError["password"]) ? "<span class='error'>" . "<br>" . $aError["password"] . "</span>" : null ?><!-- Comprobamos si el campo password tiene error en caso afirmativo muestra un mensaje de error, en caso contrario no h ace nada-->
                        </div>
                        <div class="botonSend">
                            <input class="botonEnvio" type= "submit" value= "Sing In" name= "login">
                            <input class = "botonEnvio" type = "submit" value = "Cancelar" name = "volver">
                        </div>
                    </form>

                </div>

                <?php
            }
            ?>
        </div>
        <footer>
            <div class="pie">
                <a href="../../index.html" class="nombre">Miguel Ángel Aranda García</a>
                <a href="https://github.com/MiguelAranda-Sauces" class="git" ><img class="git" src="../img/git.png"></a>
            </div>

        </footer>
    </body>
</html>
