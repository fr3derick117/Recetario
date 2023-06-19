<?php
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

//consulta para ver todos los registros de la tabla receta
$ConsultaUsuario = "SELECT * FROM usuario WHERE idusuario = '".$_SESSION['id_usuario']."' ";
//print_r($ConsultaUsuario);
$ResultadoUsuario = mysqli_query($conexion, $ConsultaUsuario);
//print_r($ResultadoUsuario);
//print_r($_SESSION);

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
                                                        echo "<li><a class='text-center'>Planeador de Menú</a></li>";
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
                    <div class="hero__item set-bg" data-setbg="img/hero/Cheesecake.png" style="background-image: url(img/hero/Cheesecake.png);">
                        <div class="hero__text">
                            <span>Dessert</span>
                            <h2>Mighty Super <br>Cheesecake</h2>
                            <p>Look no further for a creamy and<br> ultra smooth classic cheesecake<br> recipe! no one can deny it's simple<br> decadence</p>
                            <a href="vista_receta.html" class="primary-btn">Ver Receta</a>
                        </div>
                    </div><br><br><br>
                    <div class="section-title product__discount__title">
                        <h2>Categorías Populares </h2><br><br>
                        <section class="categories">
                            <div class="container">
                                <div class="row">
                                    <div class="categories__slider owl-carousel">
                                        <div class="col-lg-3">
                                            <div class="categories__item set-bg" data-setbg="img/categories/cat-1.jpg">
                                                <h5><a href="#">Pasta</a></h5>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="categories__item set-bg" data-setbg="img/categories/cat-2.jpg">
                                                <h5><a href="#">Pizza</a></h5>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="categories__item set-bg" data-setbg="img/categories/cat-3.jpg">
                                                <h5><a href="#">Vegano</a></h5>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="categories__item set-bg" data-setbg="img/categories/cat-4.jpg">
                                                <h5><a href="#">Postres</a></h5>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="categories__item set-bg" data-setbg="img/categories/cat-5.jpg">
                                                <h5><a href="#">Smoothies</a></h5>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="categories__item set-bg" data-setbg="img/categories/cat-5.jpg">
                                                <h5><a href="#">Desayuno</a></h5>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="categories__item set-bg" data-setbg="img/categories/cat-5.jpg">
                                                <h5><a href="#">Comida</a></h5>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="categories__item set-bg" data-setbg="img/categories/cat-5.jpg">
                                                <h5><a href="#">Cena</a></h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="section-title product__discount__title">
                        <h2>Recetas Populares </h2><br><br><br>
                    <div class="tab-pane" id="tabs-2" role="tabpanel">
                        <div class="product__details__tab__desc">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-6">
                                        <div class="blog__item">
                                            <div class="blog__item__pic">
                                                <img src="img/blog/blog-1.jpg" alt="">
                                            </div>
                                            <div class="blog__item__text">
                                                <ul>
                                                    <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                                                </ul>
                                                <h5><a href="#"> Receta 1</a></h5>
                                                <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6">
                                        <div class="blog__item">
                                            <div class="blog__item__pic">
                                                <img src="img/blog/blog-2.jpg" alt="">
                                            </div>
                                            <div class="blog__item__text">
                                                <ul>
                                                    <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                                                </ul>
                                                <h5><a href="#">Receta 2</a></h5>
                                                <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6">
                                        <div class="blog__item">
                                            <div class="blog__item__pic">
                                                <img src="img/blog/blog-3.jpg" alt="">
                                            </div>
                                            <div class="blog__item__text">
                                                <ul>
                                                    <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                                                </ul>
                                                <h5><a href="#">Receta 3</a></h5>
                                                <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><br><br>
                    <div class="tab-pane" id="tabs-2" role="tabpanel">
                        <div class="product__details__tab__desc">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-6">
                                        <div class="blog__item">
                                            <div class="blog__item__pic">
                                                <img src="img/blog/blog-1.jpg" alt="">
                                            </div>
                                            <div class="blog__item__text">
                                                <ul>
                                                    <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                                                </ul>
                                                <h5><a href="#"> Receta 4</a></h5>
                                                <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6">
                                        <div class="blog__item">
                                            <div class="blog__item__pic">
                                                <img src="img/blog/blog-2.jpg" alt="">
                                            </div>
                                            <div class="blog__item__text">
                                                <ul>
                                                    <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                                                </ul>
                                                <h5><a href="#">Receta 5</a></h5>
                                                <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6">
                                        <div class="blog__item">
                                            <div class="blog__item__pic">
                                                <img src="img/blog/blog-3.jpg" alt="">
                                            </div>
                                            <div class="blog__item__text">
                                                <ul>
                                                    <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                                                </ul>
                                                <h5><a href="#">Receta 6</a></h5>
                                                <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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