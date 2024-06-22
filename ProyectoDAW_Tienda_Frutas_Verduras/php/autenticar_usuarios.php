<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Autenticación</title>
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
                session_start();

                $usuario = "root";
                $password = "123456";
                $servidor = "localhost";
                $basedatos = "proyectodaw";

                $conexion = mysqli_connect($servidor, $usuario, $password) or die("Error al conectarse al servidor de la base de datos");
                $bd = mysqli_select_db($conexion, $basedatos) or die("Error al conectarse a la base de datos");

                if ($_SERVER["REQUEST_METHOD"] === "POST") {
                    $administrator = "Admin";
                    $nombre = $_POST["nombre"];
                    $contraseña = $_POST["contraseña"];

                    $sentencia = "SELECT * FROM usuarios WHERE nombre = '$nombre'";
                    $resultado = mysqli_query($conexion, $sentencia);

                    if ($resultado && mysqli_num_rows($resultado) > 0) {
                        $row = mysqli_fetch_assoc($resultado);
                        $contraseña_hash = $row['contraseña'];
                        $test = $row['nombre'];

                        if ($test == $administrator && password_verify($contraseña, $contraseña_hash)) {
                            $_SESSION['nombre'] = $nombre;
                            header("Location: administracion.php");
                            exit();
                        } else if (password_verify($contraseña, $contraseña_hash)) {
                            $_SESSION['nombre'] = $nombre;
                            header("Location: misPedidos.php");
                            exit();
                        } else {
                            echo"<p>Contraseña incorrecta, pruebe de nuevo.</p>"
                        . "<a href='../html/login.html' class='btn btn-secondary'>Volver</a>";
                        }
                    } else {
                        echo("<p>Nombre de usuario no encontrado, regístrese o vuelva a intentarlo.</p>"
                        . "<a href ='../html/registro.html' class='btn btn-secondary'>Registrarse</a>"
                        . "<a href ='../html/login.html' class='btn btn-secondary ml-5'>Volver</a>");
                    }
                }
                ?>
            </div>
        </div>
    </body>
</html>

