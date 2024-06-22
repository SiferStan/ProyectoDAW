<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Bienvenido/a</title>
        <link
            rel="stylesheet"
            href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css"
            integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I"
            crossorigin="anonymous"
            />
    </head>
    <body>
        <div class="container mt-5">            
            <?php
            session_start();
            if (isset($_SESSION['nombre'])) {
                echo "<h1>Bienvenido/a, " . $_SESSION['nombre'] . "!</h1>"
                . "<h2>Este es el área de pedidos.</p>"
                . "<a href='cerrar_sesion.php' class='btn btn-danger'>Cerrar sesión</a>";
            } else {
                header("Location: ../index.php");
                exit();
            }
            ?> 
        </div>
        <div class="container">
            <section id="pedidos" class="mt-5">
                <h2>Gestión de Pedidos</h2>
                <div id="orderList"></div>
            </section>
            <section id="contacto" class="mt-5">
                <h2>Contactos realizados</h2>
                <?php
                $usuario = "root";
                $password = "123456";
                $servidor = "localhost";
                $basededatos = "proyectodaw";

                $conexion = mysqli_connect($servidor, $usuario, $password) or die("Error al conectarse al servidor de la base de datos");
                $bd = mysqli_select_db($conexion, $basededatos) or die("Error al conectarse a la base de datos");

                $user = $_SESSION['nombre'];

                $consultaNombre = "SELECT * FROM usuarios WHERE nombre='$user'";
                $resultadoNombre = mysqli_query($conexion, $consultaNombre );

                $rowNombre = mysqli_fetch_assoc($resultadoNombre);
                $mailUsuario = $rowNombre['mail'];

                $consultaMail = "SELECT * FROM contacto WHERE mail='$mailUsuario'";
                $resultadoMail = mysqli_query($conexion, $consultaMail);                
            
                
                if ($resultadoMail && mysqli_num_rows($resultadoMail)>0) {
                     echo "<table class='table'>"
                    . "<tr>"
                    . "<th>Correo</th>"
                    . "<th>Mensaje</th>"
                    . "</tr>";
                    while ($fila = mysqli_fetch_assoc($resultadoMail)) {
                        echo "<tr>";
                        echo "<td>" . $fila['mail'] . "</td>";
                        echo "<td>" . $fila['mensaje'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo 'No hay ningún contacto realizado';
                }
                ?>
            </section>
        </div>

    </body>
</html>
