<?php
// Conexión a la base de datos
session_start();

//Cerrar sesion
if($_SESSION['login']=='' || $_SESSION['login']==null || $_SESSION['login']=='0' ){
    header('Location: login.php');
}
if (isset($_GET['logout'])) {
  // Destruye la sesión actual
  session_unset();
  session_destroy();
  // Redirecciona al usuario a la página de inicio de sesión
  header("Location: login.php");
}

//Establecer la conexion a la base de datos
$conexion = mysqli_connect('localhost', 'root', '', 'ingsoft');

//Verificar que se pudo conectar a la base de datos
if (!$conexion) {
    die("Error al conectarse a la base de datos: " . mysqli_connect_error());
}

$ConsultaUsuario = "SELECT * FROM usuario WHERE idusuario = '".$_SESSION['id_usuario']."' ";
$ResultadoUsuario = mysqli_query($conexion, $ConsultaUsuario);

// Consultar los ingredientes de la receta
$ConsultaIngredientes = "SELECT recetas_carrito.*, ingredientes_de_receta.*, ingredientes.* ,medidas.*
FROM recetas_carrito, ingredientes_de_receta, ingredientes, medidas
WHERE recetas_carrito.id_usuario = '".$_SESSION['id_usuario']."' 
AND ingredientes_de_receta.receta_idreceta = recetas_carrito.id_receta 
AND ingredientes_de_receta.medidas_idmedida = medidas.idmedidas 
AND ingredientes.nombre_ingrediente = ingredientes_de_receta.ingrediente;";
$ResultadoIngredientes =  mysqli_query($conexion, $ConsultaIngredientes);

?>


<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ogani | Template</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">

    <style>
        button{
            padding:0;
            border:0;
            margin:0;
            width: 1150px;
        }
    </style>
</head>



<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="#"><img src="img/logo.png" alt=""></a>
        </div>
        <div class="humberger__menu__cart">
            <ul>
                <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
                <li><a href="#"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
            </ul>
            <div class="header__cart__price">item: <span>$150.00</span></div>
        </div>
        <div class="humberger__menu__widget">
            <div class="header__top__right__language">
                <img src="img/language.png" alt="">
                <div>English</div>
                <span class="arrow_carrot-down"></span>
                <ul>
                    <li><a href="#">Spanis</a></li>
                    <li><a href="#">English</a></li>
                </ul>
            </div>
            <div class="header__top__right__auth">
                <a href="#"><i class="fa fa-user"></i> Login</a>
            </div>
        </div>
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li class="active"><a href="./index.html">Home</a></li>
                <li><a href="./shop-grid.html">Shop</a></li>
                <li><a href="#">Pages</a>
                    <ul class="header__menu__dropdown">
                        <li><a href="./shop-details.html">Shop Details</a></li>
                        <li><a href="./shoping-cart.html">Shoping Cart</a></li>
                        <li><a href="./checkout.html">Check Out</a></li>
                        <li><a href="./blog-details.html">Blog Details</a></li>
                    </ul>
                </li>
                <li><a href="./blog.html">Blog</a></li>
                <li><a href="./contact.html">Contact</a></li>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="header__top__right__social">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>
            <a href="#"><i class="fa fa-pinterest-p"></i></a>
        </div>
        <div class="humberger__menu__contact">
            <ul>
                <li><i class="fa fa-envelope"></i> hello@colorlib.com</li>
                <li>Free Shipping for all Order of $99</li>
            </ul>
        </div>
    </div>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                      
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="Home_Page.html"><img src="img/logo_blog_de_comdia.png" alt="" width="100px" height="100px" ></a>
                    </div>
                </div>
                <div class="col-lg-7"><br>
                    <nav class="header__menu">
                            <div class="blog__sidebar__search">
                                <form action="#">
                                    <input type="text" placeholder="Search...">
                                </form>
                            </div>     
                    </nav>
                </div>
                <div class="col-lg-2">
                    <div class="header__cart">
                        <ul>
                            <li>
                                <nav class="header__menu">
                                    <ul>
                                        <?php  
                                            if($usuario = mysqli_fetch_array($ResultadoUsuario)){
                                                echo "<li><img src='img/usuarios/".$usuario['imagen']."' width='70px' height='70px'></img>";
                                                    echo "<ul class='header__menu__dropdown' width='60px' height='60px'>";
                                                        echo "<li><a class='text-center' >".$usuario['nombre_usuario']."</a></li>";
                                                        echo "<li><a class='text-center' href='perfil_misrecetas.php'>Perfil</a></li>";
                                                        echo "<li><a class='text-center' href='perfil_misrecetas.php'>Mis Recetas</a></li>";
                                                        echo "<li><a class='text-center' href='Home_Page.php'>Home Page</a></li>";
                                                        echo "<li><a class='text-center' href='perfil_lista_compra.php'>Lista de Compras</a></li>";
                                                        echo "<li><a class='text-center' href='perfil_grupos.php'>Grupos</a></li>";
                                                        echo "<li><a class='text-center' href='subir_recetas.php'>Subir Receta</a></li>";
                                                        echo "<li><a class='text-center' href='login.php'>Cerrar Sesión</a></li>";
                                                    echo"</ul>";
                                                echo"</li>";
                                            }
                                        ?>
                                    </ul>
                                </nav>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->
   
    <!-- Hero Section Begin -->
  
    <!-- Hero Section End -->

    <!-- Breadcrumb Section Begin -->
    
    <!-- Breadcrumb Section End -->
    
    <!-- Contact Form Begin -->
    <br>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">  
                    
                    <div class="blog__details__content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="blog__details__author">
                                    <div class="blog__details__author__pic">
                                        <?php  
                                            echo "<img src='img/usuarios/".$usuario['imagen']."' alt=''>";
                                        ?>
                                    </div>
                                    <div class="blog__details__author__text">
                                        <h6><?php echo $usuario['nombre_usuario'] ?></h6>
                                        <span>Usuario</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            
                    <div class="col-lg-12">
                        <center> 
                            <nav class="header__menu">
                                <ul>
                                    <li><a href="perfil_grupos.php">Grupos</a></li>
                                    <li><a href="perfil_favoritos.php">Favoritos</a></li>
                                    <li><a href="perfil_misrecetas.php" class="active">Mis Recetas</a></li>
                                    <li><a href="perfil_lista_compra.php">Lista de Compra</a></li>
                                </ul>
                            </nav>
                        </center>
                    </div><br>
                    
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="shoping__cart__table">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th class="shoping__product">Ingredientes</th>
                                                    <th>Cantidad</th>
                                                    <th>Medida</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                // Generar las filas de la tabla con los ingredientes
                                                    while($ingredientes = mysqli_fetch_array($ResultadoIngredientes)){
                                                        echo "<tr>";
                                                            echo "<td class='shoping__cart__item'>";
                                                                echo "<img src='img/Ingredientes/" . $ingredientes['imagen'] . "' style='width: 100px; height: auto;>";
                                                            echo "</td>";
                                                            echo "<td class='shoping__cart__item'>";
                                                                echo "<h5>". $ingredientes['ingrediente'] ."</h5>";
                                                            echo "</td>";
                                                            echo "<td class='shoping__cart__quantity'>";
                                                                echo "<div class='quantity'>";
                                                                    echo "<div class='pro-qty'>";
                                                                        echo "<input type='text' value=".$ingredientes['cantidad'].">";
                                                                    echo "</div>";
                                                                echo "</div>";
                                                            echo "</td>";
                                                            echo "<td class='shoping__cart__item__close text-center'>";
                                                            echo "<h5>". $ingredientes['nombre_medida'] ."</h5>";
                                                            echo "</td>";
                                                        echo "</tr>";
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="shoping__cart__btns">
                                        <a href="Home_Page.php" class="primary-btn cart-btn">Continuar Comprando</a>
                                        <a href="perfil_misrecetas.php" class="primary-btn cart-btn cart-btn-right">
                                            Finalizar Compra</a>
                                    </div>
                                </div>
                            </div><br>
                        </div>
                    
                </div>
            </div>
        </div>
    <!-- Contact Form End -->
    
    <!-- Footer Section Begin -->
    <footer class="footer spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__about__logo">
                            <a href="./index.html"><img src="img/logo_blog_de_comdia.png" alt="" width="80"></a>
                        </div>
                        
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                    <div class="footer__widget">
                        
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="footer__widget">
                        <div class="footer__widget__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-pinterest"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>



</body>

</html>