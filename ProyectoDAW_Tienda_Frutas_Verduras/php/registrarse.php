<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Registrarse</title>
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
                    $nombre = $_POST["nombre"];
                    $apellido = $_POST["apellido"];
                    $contraseña = password_hash($_POST["contraseña"], PASSWORD_DEFAULT);
                    $telefono = $_POST["telefono"];
                    $mail = $_POST["mail"];
                    $direccion = $_POST["direccion"];
                    $localidad = $_POST["localidad"];

                    if (isset($_POST['telefono'])) {
                        if (strlen($telefono) != 9) {
                            echo "<p>Error: El teléfono debe contener solo 9 números.</p><br>"
                            . "<a href='../html/registro.html' class='btn btn-secondary'>Volver</a>";
                        } else {
                            if (!ctype_digit($telefono)) {
                                echo "<p>Error: El teléfono debe contener solo números.</p><br>"
                                . "<a href='../html/registro.html' class='btn btn-secondary'>Volver</a>";
                            } else {
                                $consulta = "SELECT * FROM usuarios WHERE nombre = '$nombre'";
                                $resultado = mysqli_query($conexion, $consulta);

                                if ($resultado && mysqli_num_rows($resultado) > 0) {
                                    echo "<p>Nombre de usuario ya registrado.</p><br>"
                                    . "<a href='../html/registro.html' class='btn btn-secondary'>Volver</a>";
                                } else {
                                    $sql = "INSERT INTO usuarios (nombre, apellido, contraseña, telefono, mail, direccion, localidad) "
                                            . "VALUES ('$nombre','$apellido','$contraseña','$telefono','$mail','$direccion','$localidad')";
                                    $ejecutar = mysqli_query($conexion, $sql);

                                    if (!$ejecutar) {
                                        echo"<p>Hubo un error al registrar al usuario.</p><br>"
                                        . "<a href='../html/registro.html' class='btn btn-secondary'>Volver</a>";
                                    } else {
                                        echo"<p>Se ha registrado correctamente el nuevo usuario.</p>"
                                        . "<a href='../html/registro.html' class='btn btn-secondary mb-3'>Registrar nuevo usuario</a><br>"
                                        . "<a href='../html/login.html' class='btn btn-secondary'>Iniciar sesión</a>";
                                    }
                                }
                            }
                        }
                    }
                }
                ?>
            </div>
        </div>
    </body>
</html>

