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
   
    <!-- Humberger Begin -->
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
                                        <li><img src="img/foto_perfil.png" width="70px" height="70px"></img>
                                            <ul class="header__menu__dropdown" width="60px" height="60px">
                                                <li><a class="text-center" href="perfil_misrecetas.html">Perfil</a></li>
                                                <li><a class="text-center" href="perfil_misrecetas.html">Mis Recetas</a></li>
                                                <li><a class="text-center" href="Home_Page.html">Home Page</a></li>
                                                <li><a class="text-center" href="perfil_lista_compra.html">Lista de Compras</a></li>
                                                <li><a class="text-center" href="perfil_grupos.html">Grupos</a></li>
                                                <li><a class="text-center">Planeador de Menú</a></li>
                                                <li><a class="text-center" href="subir_recetas.php">Subir Receta</a></li>
                                                <li><a class="text-center" href="login.php">Cerrar Sesión</a></li>
                                            </ul>
                                        </li>
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
                    <div class="section-title product__discount__title">
                        <h2> Strawberry Cream Cheesecake</h2>
                    </div>

                    <div>
                        <img class="col-lg-12 col-md-6 col-sm-6" src="img/cheesecake_photo.png" width="100px" height="540px">
                    </div><br><br>

                        <table>
                            <tr  class="product__details__text">
                                <th align="center" width="190px"><img src="img/reloj.png" width="17px" height="17px">Tiempo de preparación </th>
                                <th align="center" width="100px"><img src="img/porciones.png" width="20px" height="17px">Porciones </th>
                                <th align="center" width="110px"><img src="img/dificultad.png" width="20px" height="17px">Dificultad </th>
                                <td class="product__details__rating"> 
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-half-o"></i>
                                </td>
                            </tr>
                            <tr>
                                <td align="center" width="190px">120 mins</td>
                                <td align="center" width="100px">4 personas</td>
                                <td align="center" width="110px">Baja</td>
                            </tr>
                        </table><br>

                </div>
            </div>
        </div><br>

        

            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-md-6">
                        <div class="section-title product__discount__title">
                            <h2>Ingredientes</h2>
                        </div>
                        <table class="col-lg-6">
                            <tr>
                                <td class="checkout__input__checkbox">
                                    <label for="1">
                                        Galletas 
                                        <input type="checkbox" id="1">
                                        <span class="checkmark"></span>
                                    </label> 
                                </td>
                                <td>400g</td>
                            </tr>
                            <tr>
                                <td class="checkout__input__checkbox">
                                    <label for="2">
                                        Mantequilla
                                        <input type="checkbox" id="2">
                                        <span class="checkmark"></span>
                                    </label> 
                                </td>
                                <td>175g</td>
                            </tr>
                            <tr>
                                <td class="checkout__input__checkbox">
                                    <label for="3">
                                        Queso crema
                                        <input type="checkbox" id="3">
                                        <span class="checkmark"></span>
                                    </label> 
                                </td>
                                <td>500g</td>
                            </tr>
                            <tr>
                                <td class="checkout__input__checkbox">
                                    <label for="4">
                                        Bombones
                                        <input type="checkbox" id="4">
                                        <span class="checkmark"></span>
                                    </label> 
                                </td>
                                <td>250g</td>
                            </tr>
                        </table>
                    </div>

                    <div class="col-lg-6 col-md-6">
                        <div class="section-title product__discount__title">
                            <h2>Instrucciones</h2>
                        </div>
                        <textarea rows="30" cols="82" disabled>
                            1. Licua las galletas hasta que queden finos pedazos.
                            2. Agrega mantequilla a la mezcla y licua.
                            3. Derrite los bombones por 30 segundos en el microondas.
                            4. Agrega el queso crema a la mezcla y revuelve con los bombones.
                            5. Sirve y disfruta!    
                        </textarea>
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