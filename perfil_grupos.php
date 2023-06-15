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
$ConsultaGrupos = "SELECT grupos.*, usuarios_grupos.*, grupos_recetas.*
FROM grupos 
	LEFT JOIN usuarios_grupos ON usuarios_grupos.id_grupo = grupos.idgrupo 
	LEFT JOIN grupos_recetas ON grupos_recetas.id_grupo = grupos.idgrupo";
//echo $ConsultaReceta;
$ResultadoGrupos = mysqli_query($conexion, $ConsultaGrupos);

if (isset($_FILES['imagen'])) {
    $imagen = $_FILES['imagen']['tmp_name'];
    $nombre = $_FILES['imagen']['name'];
    $tipo = $_FILES['imagen']['type'];

    //crear una carpeta con el nombre de la receta
    //mover la imagen a la carpeta creada
    //crear una ruta que guarde la imagen en una carpeta con el nombre de la receta dentro de la carpeta receta
    $receta = $_POST['titulo'];
    mkdir("recetas/" . $receta);
    $ruta = "recetas/" . $receta . "/" . $nombre;
    //echo $ruta;
    
    //if(move_uploaded_file($imagen, $ruta)){
    //    echo "Se movio la imagen";}
    // Aquí debes agregar código para conectarte a la base de datos MySQL
    // y guardar la imagen en una tabla de la base de datos.
    $AgregarImagen = "INSERT INTO preparaciones (idpreparacion, preparacion, receta_idreceta, nombre_imagen)
        VALUES (NULL, NULL, '$last_id', '$nombre')";
    

// Ejecutar la consulta
    $ConsultaImagen = mysqli_query($conexion, $AgregarImagen);

}


if (isset($_POST['subir'])) {
    $ConsultaAgregarGrupo = "INSERT INTO grupos
        (idgrupo, nombre, descripcion, receta_preferida, receta_mas_preparada, receta_menos_preparada)
        VALUES 
        (NULL, 
        '" . $_POST['nombre'] . "', 
        '" . $_POST['descripcion'] . "', 
        NULL, 
        NULL, 
        NULL);";

    $ResultadoAgregarGrupo = mysqli_query($conexion, $ConsultaAgregarGrupo);

    //crear una consulta con php a la tabla ingredientes_de_receta en la base de datos de ingsoft para insertar un nuevo registro
    $ConsultaAgregarIntegrantes = "INSERT INTO usuarios_grupos 
        (id_usuario, id_grupo) 
        VALUES
        ('".$last_id."', 
        '".$_SESSION['id_usuario']."');";

    $ResultadoAgregarIntegrantes = mysqli_query($conexion, $ConsultaAgregarIntegrantes);

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
                                        <li><img src="img/foto_perfil.png" width="70px" height="70px"></img>
                                            <ul class="header__menu__dropdown" width="60px" height="60px">
                                                <li><a class="text-center" href="perfil_misrecetas.html">Perfil</a></li>
                                                <li><a class="text-center" href="perfil_misrecetas.html ">Mis Recetas</a></li>
                                                <li><a class="text-center" href="Home_Page.html">Home Page</a></li>
                                                <li><a class="text-center" href="perfil_lista_compra.html">Lista de Compras</a></li>
                                                <li><a class="text-center" href="perfil_grupos.html">Grupos</a></li>
                                                <li><a class="text-center">Planeador de Menú</a></li>
                                                <li><a class="text-center" href="subir_recetas.html">Subir Receta</a></li>
                                                <li><a class="text-center" href="login.html">Cerrar Sesión</a></li>
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
                    
                    <div class="blog__details__content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="blog__details__author">
                                    <div class="blog__details__author__pic">
                                        <img src="img/blog/details/details-author.jpg" alt="">
                                    </div>
                                    <div class="blog__details__author__text">
                                        <h6>Michael Scofield</h6>
                                        <span>Admin</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            
                    <div class="col-lg-12">
                        <center> 
                            <nav class="header__menu">
                                <ul>
                                    <li><a href="perfil_grupos.html">Grupos</a></li>
                                    <li><a href="perfil_favoritos.html">Favoritos</a></li>
                                    <li><a href="perfil_misrecetas.html" class="active">Mis Recetas</a></li>
                                    <li><a href="perfil_lista_compra.html" >Lista de Compra</a></li>
                                </ul>
                            </nav>
                        </center>
                    </div>
                    <div class="col-lg-12">
                        <button type="submit" class="site.btn" onclick="window.modal.showModal();">CREAR GRUPO</button>

                        <dialog id="modal" class="col-lg-4 text-center">
                            <div class="section-title product__discount__title text-center"><br>
                                <h2>Nuevo grupo</h2><br><br><br>
                                <div class="col-lg-12 col-1">
                                        <img src="img/grupo_perfil.png" width="100px" id="imagen"
                                        onclick="document.getElementById('fileInput').click();">
                                        <input type="file" name="imagen" id="fileInput" style="display: none;"
                                        onchange="document.getElementById('imagen').src = window.URL.createObjectURL(this.files[0]);">
                                        <input id="nom_grupo" name="nom_grupo" type="text" placeholder="Nombre del grupo" style="border-style: outset;" class="col-lg-9">
                                </div>
                                <div class="col-lg-12"><br>
                                    <a class="text_cool">Escribe la descripción del grupo</a>
                                    <input id="nom_grupo" name="descrip_grupo" type="text" placeholder="Descripción del grupo" style="border-style: outset;" class="col-lg-12">
                                </div>
                                <div class="col-lg-12 shoping__discount">
                                    <a class="text_cool">Agregar integrantes </a>
                                    <form action="#">
                                        <input type="text" placeholder="Nombre de usuario">
                                        <button type="submit" class="site-btn">Agregar</button>
                                    </form>
                                </div>
                                <div class="text-center">
                                    <br><br><br>
                                    <button onclick="window.modal.click();">Crear</button>
                                    <button onclick="window.modal.close();" class="button_close">Cerrar</button>
                                </div>
                            </div>
                        </dialog>

                        
                    </div><br>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-6">
                                <div class="blog__item">
                                    <div class="blog__item__pic">
                                        <img src="img/blog/blog-1.jpg" alt="">
                                    </div>
                                    <div class="blog__item__text">
                                        
                                        <h5><a href="vista_grupo.html"> Grupo 1</a></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6">
                                <div class="blog__item">
                                    <div class="blog__item__pic">
                                        <img src="img/blog/blog-2.jpg" alt="">
                                    </div>
                                    <div class="blog__item__text">
                                        
                                        <h5><a href="#">Grupo 2</a></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6">
                                <div class="blog__item">
                                    <div class="blog__item__pic">
                                        <img src="img/blog/blog-3.jpg" alt="">
                                    </div>
                                    <div class="blog__item__text">
                                        
                                        <h5><a href="#">Grupo 3</a></h5>
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