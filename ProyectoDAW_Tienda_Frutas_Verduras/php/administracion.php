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
                . "<h2>Esta es tu área de administración.</p>"
                . "<a href='cerrar_sesion.php' class='btn btn-danger'>Cerrar sesión</a>";
            } else {
                header("Location: ../index.php");
                exit();
            }
            ?> 
        </div>
        <div class="container">
            <section id="productos">
                <h2>Gestión de Productos</h2>
                <form>
                    <input type="hidden" id="productId" value="">
                    <div class="mb-3">
                        <label for="productName">Nombre del Producto</label>
                        <input type="text" class="form-control" id="productName" required>
                    </div>
                    <div class="mb-3">
                        <label for="productImage">Imagen del Producto</label>
                        <input type="text" class="form-control" id="productImage" required>
                    </div>
                    <div class="mb-3">
                        <label for="productPrice">Precio del Producto</label>
                        <input type="number" class="form-control" id="productPrice" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar Producto</button>
                </form>
                <div id="productList" class="mt-3"></div>
            </section>
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

                $consulta = "SELECT * FROM contacto";
                $resultado = mysqli_query($conexion, $consulta);

                if ($resultado && mysqli_num_rows($resultado) > 0) {
                    echo "<table class='table'>"
                    . "<tr>"
                    . "<th>Correo</th>"
                    . "<th>Mensaje</th>"
                    . "</tr>";
                    while ($fila = mysqli_fetch_assoc($resultado)) {
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
