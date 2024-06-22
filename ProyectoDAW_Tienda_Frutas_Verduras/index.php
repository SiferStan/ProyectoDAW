<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>EcoDelicias Frutas y Verduras </title>       
        <link
            rel="stylesheet"
            href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css"
            integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I"
            crossorigin="anonymous"
            />
        <link rel="stylesheet" href="estilos/cabeceraEcoDelicias.css"/>       
    </head>
    <body>
        <header>
            <div class="container">
                <div class="row align-items-center">                    
                    <div class="col-md-6 d-flex align-items-center">
                        <img src="imágenes/Logo_EcoDelicias.jpg" alt="EcoDelicias" class="rounded-circle mr-3" id="logo-titulo"/>
                        <span class="logo">EcoDelicias</span>
                    </div>
                    <div class="col-md-6">
                        <ul class="menu d-flex justify-content-end">
                            <li><a href="index.php">Inicio</a></li>
                            <li><a href="html/login.html">Login</a></li>
                            <li><a href="html/tienda.html">Tienda</a></li>
                            <li><a href="html/quienes_somos.html">¿Quiénes somos?</a></li>
                        </ul>
                    </div>                    
                </div>
            </div>
        </header>
        <div class="container mb-5 mt-5">
            <div class="row container">
                <h1 class="display-2 text-center">Bienvenidos a <span style="color: #ff9933">EcoDelicias</span></h1>
                <h1 class="display-2 mb-5 text-center">Frutas y Verduras</h1>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <p>En esta tienda online vais a tener la oportunidad de 
                        comprar el producto más fresco y ecológico de frutas y verduras. Somos un 
                        compercio local que quiere llevar el producto desde el agricultor hasta el 
                        consumidor, reduciéndo al máximo los intermediarios. Si tienes más información, 
                        visita el apartado de quiénes somos más arriba.</p>
                    <p>Nuestros precios en la página de venta de frutas y verduras ecológicas están 
                        cuidadosamente ajustados para ser lo más competitivos posible en el mercado. 
                        Nos esforzamos por ofrecer productos a precios justos que reflejen el valor de 
                        la agricultura ecológica y respeten los principios del comercio justo. Creemos 
                        firmemente en apoyar a nuestros agricultores, asegurando que reciban una 
                        compensación justa por su trabajo mientras mantenemos una oferta atractiva y accesible 
                        para nuestros clientes..</p>
                </div>
                <div class="col-md-6 pasarela-container">
                    <img src="imágenes/aguacates.jpg" alt="aguacates" class="img-fluid img-thumbnail mySlides" style="display: block;"/>
                    <img src="imágenes/tomates.jpg" alt="tomates" class="img-fluid img-thumbnail mySlides" style="display: none;"/>
                    <img src="imágenes/manzana.jpg" alt="manzanas" class="img-fluid img-thumbnail mySlides" style="display: none;"/>
                    <img src="imágenes/platano.jpg" alt="platanos" class="img-fluid img-thumbnail mySlides" style="display: none;"/>
                    <img src="imágenes/peras.jpg" alt="peras" class="img-fluid img-thumbnail mySlides" style="display: none;"/>
                    <img src="imágenes/naranjas.jpg" alt="naranjas" class="img-fluid img-thumbnail mySlides" style="display: none;"/>
                    <img src="imágenes/sandía.jpg" alt="sandía" class="img-fluid img-thumbnail mySlides" style="display: none;"/>
                    <img src="imágenes/melocotones.jpg" alt="melocotones" class="img-fluid img-thumbnail mySlides" style="display: none;"/>
                    <img src="imágenes/patatas.jpg" alt="patatas" class="img-fluid img-thumbnail mySlides" style="display: none;"/>
                    <img src="imágenes/zanahorias.jpg" alt="zanahorias" class="img-fluid img-thumbnail mySlides" style="display: none;"/>
                </div>
                <script src="js/Pasarela_imagenes.js"></script>
            </div>
        </div>
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <p>Síguenos en:<p>
                            <a href="https://twitter.com" target="_blank"><img src="imágenes/twitter.png" class="contacto" alt="Twitter"></a>
                            <a href="https://instagram.com" target="_blank"><img src="imágenes/facebook.png" class="contacto" alt="Instagram"></a>
                    </div>
                    <div class="col-md-6">
                        <h1>Contacto</h1>
                        <form action="php/contacto.php" method="post">
                            <div class="form-group mb-3">
                                <input type="email" class="form-control" id="email" placeholder="Tucorreo@ejemplo.com" name="correocontacto" required>
                            </div>
                            <div class="form-group mb-3">
                                <textarea class="form-control" id="mensaje" rows="3" placeholder="Mensaje máximo 300 carácteres:" name="mensaje" required></textarea>
                            </div>
                            <div class="form-group mt-3">
                                <input type="text" name="captcha" placeholder="Ingrese el valor:" id="captchaText" class="form-control">
                                <img src="php/captcha.php">
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Enviar</button>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-center contact-info">
                        <p id="footer">&copy; 2024 EcoDelicias. Todos los derechos reservados.</p>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>
