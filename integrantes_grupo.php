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

//consulta para ver todos los registros de la tabla usuarios
$ConsultaUsuario = "SELECT * FROM usuario WHERE idusuario = '".$_SESSION['id_usuario']."' ";
//print_r($ConsultaUsuario);
$ResultadoUsuario = mysqli_query($conexion, $ConsultaUsuario);
//print_r($ResultadoUsuario);
//print_r($_SESSION);

$idgrupo = $_GET["grupo"];

//echo "<br> Datos de la sesion: ";
//print_r($_SESSION);

$ConsultaGrupo = "SELECT * FROM grupos WHERE idgrupo = '".$idgrupo."' ";
$ResultadoGrupo = mysqli_query($conexion, $ConsultaGrupo);
//print_r($ResultadoGrupo);
//print_r($ConsultaGrupo);

$ConsultaUsuarios = "SELECT * FROM usuario";
$ResultadoUsuarios = mysqli_query($conexion, $ConsultaUsuarios);

$ConsultaUsuariosGrupo = "SELECT usuarios_grupos.*, usuario.*
    FROM usuarios_grupos 
	    LEFT JOIN usuario ON usuarios_grupos.id_usuario = usuario.idusuario
    WHERE usuarios_grupos.id_grupo = '".$idgrupo."' ";
$ResultadoUsuariosGrupo = mysqli_query($conexion, $ConsultaUsuariosGrupo);
//print_r($ConsultaUsuariosGrupo);
//print_r($ResultadoUsuariosGrupo);

//print_r($_POST);

if (isset($_POST['agregar_usuario'])) {
    $ConsultaUsuarioEspecifico = "SELECT idusuario FROM usuario WHERE nombre_usuario = '".$_POST['busqueda_usuarios']."' ";
    $ResultadoUsuarioEspecifico = mysqli_query($conexion, $ConsultaUsuarioEspecifico);
    if($usuario_especifico = mysqli_fetch_array($ResultadoUsuarioEspecifico)){
        $id_usuario_especifico = $usuario_especifico['idusuario'];
    }
    $ConsultaAgregarUsuario = "INSERT INTO usuarios_grupos (id_usuario, id_grupo) 
    VALUES 
    ( '".$id_usuario_especifico."', 
    '".$idgrupo."')";
    $ResultadoAgregarUsuario = mysqli_query($conexion, $ConsultaAgregarUsuario);
    //echo("Funciona");
}
//print_r($ResultadoAgregarUsuario);
//print_r($ConsultaAgregarUsuario);


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
            display: inline-block;
            font-size: 17px;
            padding: 10px 28px 10px;
            color: #ffffff;
            text-transform: uppercase;
            font-weight: 700;
            background: #7fad39;
            letter-spacing: 2px;
        }

        button.button_close{
            display: inline-block;
            font-size: 17px;
            padding: 10px 28px 10px;
            color: #ffffff;
            text-transform: uppercase;
            font-weight: 700;
            background: #6f6f6f;
            letter-spacing: 2px;
        }

        .text_cool{
            font-size: 17px;
            color: #030303;
            text-transform: uppercase;
            font-weight: 700;
            letter-spacing: 2px;
        }
        
        .imagen_perfil{
            background-color: #ffffff;
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
                                    <?php
                                        if($grupo = mysqli_fetch_array($ResultadoGrupo)){
                                            echo "<div class='blog__details__author__pic'>";
                                                echo "<img src='img/grupos/".$grupo['imagen_grupo']."' alt=''>";
                                            echo "</div>";
                                            echo "<div class='blog__details__author__text'>";
                                                    echo "<h2>".$grupo['nombre']."</h2>";
                                            echo "</div>";
                                        }
                                    ?>
                                </div>
                            </div>
                            
                        </div>
                    </div>
            
                    <div class="col-lg-12">
                        <center> 
                            <nav class="header__menu">
                                <ul>
                                    <?php
                                        echo "<li><a href='vista_grupo.php?grupo=".$idgrupo."'>Recetas</a></li>";
                                        echo "<li><a href='integrantes_grupo.php?grupo=".$idgrupo."'>Integrantes</a></li>";
                                    ?>
                                </ul>
                            </nav>
                        </center>
                    </div>

                    <div class="col-lg-12">
                        <button type="submit" class="site.btn" onclick="window.modal.showModal();">Agregar Integrante</button>

                        <dialog id="modal" class="col-lg-4 text-center">
                            <div class="section-title product__discount__title text-center"><br>
                                <h2>Nuevo grupo</h2><br><br><br>
                                <?php 
                                    echo "<form id='formAuthentication' action='integrantes_grupo.php?grupo=".$idgrupo."' method='POST'>";
                                ?>
                                    <div class="col-lg-12 shoping__discount">
                                        <a class="text_cool">Agregar integrantes </a>
                                        <br>
                                            <input type="search" id="busqueda_usuarios" name="busqueda_usuarios" placeholder="Nombre de usuario" list="usuarios">
                                            <input type="button" onclick="agregar_usuarios();" value="Agregar Usuarios">
                                            <!--<input type="button" onclick="imprimir_lista();" value="Imprimir Lista">-->                         
                                            <br>
                                        <br>
                                        <a class="text_cool">Lista de usuarios</a>
                                        <ul id="lista_usuarios">
                                        </ul>
                                    </div>
                                    <script type="text/javascript">
                                        function agregar_usuarios(){
                                            var usuario = document.getElementById("busqueda_usuarios").value;
                                            var lista = document.getElementById("lista_usuarios");
                                            var item = document.createElement("li");
                                            item.innerHTML = usuario;
                                            lista.appendChild(item);
                                        }
                                        /*function imprimir_lista(){
                                            var lista = document.getElementById("lista_usuarios");
                                            var items = lista.getElementsByTagName("li");
                                            for (var i = 0; i < items.length; ++i) {
                                                alert(items[i].innerHTML);
                                            }
                                        }*/
                                    </script>
                                    <div class="text-center">
                                        <br><br><br>
                                        <button class="primary-btn" type="submit" width="90px" id="agregar_usuario" name="agregar_usuario">Confirmar</button>
                                        <button type="button" onclick="window.modal.close();" class="button_close" data-dismiss="modal">Cerrar</button>
                                    </div>
                                </form>
                                <datalist id="usuarios">
                                    <?php
                                    while($usuario = mysqli_fetch_array($ResultadoUsuarios))
                                        echo "<option value='".$usuario['nombre_usuario']."'>"; 
                                    ?>
                                </datalist>
                            </div>
                        </dialog>

                        
                    </div><br>

                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <?php
                while($usuarios_grupos = mysqli_fetch_array($ResultadoUsuariosGrupo)){
                    echo "<br>";
                    echo "<div class='col-lg-6  col-md-6'>";
                        echo "<div class='blog__details__content'>";
                            echo "<div class='col-lg-6 col-md-6'>";
                                echo "<div class='blog__details__author'>";
                                    echo "<div class='blog__details__author__pic'>";
                                        echo "<img src='img/usuarios/".$usuarios_grupos['imagen']."' alt=''>";
                                    echo "</div>";
                                    echo "<div class='blog__details__author__text'>";
                                        echo "<h6>".$usuarios_grupos['nombre_usuario']."</h6>";
                                        echo "<span>Usuario del grupo</span>";
                                    echo "</div>";
                                echo "</div>";
                            echo "</div><br>";
                            /*echo "<div>";
                                echo "<table class='shoping__cart__table'>";
                                    echo "<tr>";
                                        echo "<th class='text-center'>Comida Preferida</th>";
                                        echo "<th class='text-center'>Comida Más Preparada</th>";
                                        echo "<th class='text-center'>Comida Menos Preparada</th>";
                                    echo "</tr>";
                                    echo "<tr>";
                                        echo "<td>";
                                            echo "<div class='blog__item'>";
                                                echo "<div class='blog__item__pic'>";
                                                    echo "<img src='img/blog/blog-1.jpg' alt=''>";
                                                echo "</div>";
                                                echo "<div class='blog__item__text'>";
                                                    echo "<h5><a href='#'> Receta 1</a></h5>";
                                                    echo "<p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>";
                                                echo "</div>";
                                            echo "</div>";
                                        echo "</td>";
                                        echo "<td>";
                                            echo "<div class='blog__item'>";
                                                echo "<div class='blog__item__pic'>";
                                                    echo "<img src='img/blog/blog-1.jpg' alt=''>";
                                                echo "</div>";
                                                echo "<div class='blog__item__text'>";
                                                    echo "<h5><a href='#'> Receta 1</a></h5>";
                                                    echo "<p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>";
                                                echo "</div>";
                                            echo "</div>";
                                        echo "</td>";
                                        echo "<td>";
                                            echo "<div class='blog__item'>";
                                                echo "<div class='blog__item__pic'>";
                                                    echo "<img src='img/blog/blog-1.jpg' alt=''>";
                                                echo "</div>";
                                                echo "<div class='blog__item__text'>";
                                                    echo "<h5><a href='#'> Receta 1</a></h5>";
                                                    echo "<p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>";
                                                echo "</div>";
                                            echo "</div>";
                                        echo "</td>";
                                    echo "</tr>";
                                echo "</table>";
                            echo "</div>";*/
                        echo "</div>";
                    echo "</div>";
                }
                ?>
                <div>
                    <p>  .  </p>
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