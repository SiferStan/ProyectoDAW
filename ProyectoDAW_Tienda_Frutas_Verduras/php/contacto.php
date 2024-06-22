<!DOCTYPE html>
<?php
session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Contacto</title>
        <link
            rel="stylesheet"
            href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css"
            integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I"
            crossorigin="anonymous"
            />
        <link rel="stylesheet" type="text/css" href="../estilos/cabeceraEcoDelicias.css" >

    </head>
    <body>
        <header>
            <div class="container">
                <div class="row align-items-center">                    
                    <div class="col-md-6 d-flex align-items-center">
                        <img src="../imágenes/Logo_EcoDelicias.jpg" alt="EcoDelicias" class="rounded-circle mr-3" id="logo-titulo"/>
                        <span class="logo">EcoDelicias</span>
                    </div>
                    <div class="col-md-6">
                        <ul class="menu d-flex justify-content-end">
                            <li><a href="../index.php">Inicio</a></li>
                            <li><a href="../html/login.html">Login</a></li>
                            <li><a href="../html/tienda.html">Tienda</a></li>
                            <li><a href="../html/quienes_somos.html">¿Quiénes somos?</a></li>
                        </ul>
                    </div>                    
                </div>
            </div>
        </header>
        <div class="container contenedor-centrado">
            <div class="div-centrado">
                <?php
                $usuario = "root";
                $password = "123456";
                $servidor = "localhost";
                $basededatos = "proyectodaw";

                $conexion = mysqli_connect($servidor, $usuario, $password) or die("Error al conectarse al servidor de la base de datos");
                $bd = mysqli_select_db($conexion, $basededatos) or die("Error al conectarse a la base de datos");

                if ($_SERVER["REQUEST_METHOD"] === "POST") {
                    if ($_SESSION['numeroaleatorio'] == $_REQUEST['captcha']) {
                        $correocontacto = $_POST["correocontacto"];
                        $mensaje = $_POST["mensaje"];

                        $sql = "INSERT INTO contacto VALUES ('$correocontacto','$mensaje')";
                        $ejecutar = mysqli_query($conexion, $sql);

                        if (!$ejecutar) {
                            echo"<p>Hubo un error al registrar el formulario de contacto.</p><br>"
                            . "<a href='../html/registro.html' class='btn btn-secondary'>Volver</a>";
                        } else {
                            echo"<p>Se ha registrado correctamente el mensaje.</p>"
                            . "<script src='../js/vuelta.js'></script>";
                        }
                    } else {
                        echo"<p>Captcha incorrecto, vuelva a intentarlo.</p><br>"
                            . "<a href='../index.php#email' class='btn btn-secondary'>Volver</a>";
                    }
                }
                ?>
            </div>
        </div>
    </body>
</html>

