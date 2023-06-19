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

$nombre = '';

//consulta para ver todos los registros de la tabla usuarios
$ConsultaUsuario = "SELECT * FROM usuario WHERE idusuario = '".$_SESSION['id_usuario']."' ";
//print_r($ConsultaUsuario);
$ResultadoUsuario = mysqli_query($conexion, $ConsultaUsuario);

$ConsultaUsuarios = "SELECT * FROM usuario";
$ResultadoUsuarios = mysqli_query($conexion, $ConsultaUsuarios);

//consulta para ver todos los registros de los grupos 
$ConsultaGrupos = "SELECT grupos.*, usuarios_grupos.*
FROM grupos 
    LEFT JOIN usuarios_grupos ON usuarios_grupos.id_grupo = grupos.idgrupo
WHERE usuarios_grupos.id_usuario = '".$_SESSION['id_usuario']."' ";
$ResultadoGrupos = mysqli_query($conexion, $ConsultaGrupos);



if (isset($_FILES['imagen-upload'])) {
    $imagen = $_FILES['imagen-upload']['tmp_name'];
    $nombre = $_FILES['imagen-upload']['name'];
    $tipo = $_FILES['imagen-upload']['type'];
    $ruta = "img/grupos/" . $nombre;
    if (move_uploaded_file($imagen, $ruta)) {
        //echo "El archivo se subió correctamente";
    } else {
        //echo "Ocurrió un error al subir el archivo";
    }
    //echo $ruta;
}

$MaxID = "SELECT MAX(idgrupo) as last_id FROM grupos";
$ConsultaMaxID = mysqli_query($conexion, $MaxID);
if ($ConsultaMaxID -> num_rows > 0) {
    $row = $ConsultaMaxID -> fetch_assoc();
    // Obtener el último ID
    $last_id = $row["last_id"] + 1;
} 

if (isset($_POST['agregar_grupo'])) {
    $ConsultaAgregarGrupo = "INSERT INTO grupos
        (idgrupo, nombre, descripcion, imagen_grupo, receta_preferida, receta_mas_preparada, receta_menos_preparada)
        VALUES 
        ($last_id, 
        '" . $_POST['nom_grupo'] . "', 
        '" . $_POST['descrip_grupo'] . "', 
        '" . $nombre . "',
        NULL, 
        NULL, 
        NULL);";
    $ResultadoAgregarGrupo = mysqli_query($conexion, $ConsultaAgregarGrupo);

    $ConsultaAgregarIntegranteCreador = "INSERT INTO usuarios_grupos (id_usuario, id_grupo) 
        VALUES
        ('".$_SESSION['id_usuario']."', 
        '".$last_id."');";
    $ResultadoAgregarIntegrantes = mysqli_query($conexion, $ConsultaAgregarIntegranteCreador);

}

//print_r($_POST);
//print_r($_FILES);
//print_r($ConsultaAgregarGrupo);
//print_r($ResultadoAgregarGrupo);
//print_r($ConsultaAgregarIntegranteCreador);
//print_r($ResultadoAgregarIntegrantes);

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
                        <a href="Home_Page.php"><img src="img/logo_blog_de_comdia.png" alt="" width="100px" height="100px" ></a>
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
                                    <li><a href="perfil_grupos.php" class="active">Grupos</a></li>
                                    <li><a href="perfil_favoritos.php">Favoritos</a></li>
                                    <li><a href="perfil_misrecetas.php">Mis Recetas</a></li>
                                    <li><a href="perfil_lista_compra.php">Lista de Compra</a></li>
                                </ul>
                            </nav>
                        </center>
                    </div>
                    <div class="col-lg-12">
                        <button type="submit" class="site.btn" onclick="window.modal.showModal();">CREAR GRUPO</button>

                        <dialog id="modal" class="col-lg-4 text-center">
                            <div class="section-title product__discount__title text-center"><br>
                                <h2>Nuevo grupo</h2><br><br><br>
                                <form id="formAuthentication" action="perfil_grupos.php" method="POST" enctype="multipart/form-data">
                                    <div class="col-lg-12 col-1">
                                        <a class="text_cool">Selecciona la foto del grupo</a><br>
                                        <label for="imagen">
                                            <img src="img/grupo_perfil.png" width="100px" id="imagen">
                                        </label>
                                        <input type="file" name="imagen-upload" id="imagen-upload" accept="image/*">
                                        <script>
                                            // Obtén referencia al elemento de carga de archivo
                                            var fileUpload = document.getElementById('imagen-upload');
                                            // Escucha el evento de cambio de archivo
                                            fileUpload.addEventListener('change', function (e) {
                                                var reader = new FileReader();
                                                reader.onload = function (event) {
                                                    // Actualiza la imagen de perfil con la imagen cargada
                                                    document.getElementById('imagen').src = event.target.result;
                                                }
                                                // Lee el archivo como una URL de datos
                                                reader.readAsDataURL(e.target.files[0]);
                                            });
                                        </script> 
                                        <a class="text_cool">Escribe el nombre del grupo</a>
                                        <input id="nom_grupo" name="nom_grupo" type="text" placeholder="Nombre del grupo" style="border-style: outset;" class="col-lg-9">
                                    </div>
                                    <div class="col-lg-12"><br>
                                        <a class="text_cool">Escribe la descripción del grupo</a>
                                        <input id="descrip_grupo" name="descrip_grupo" type="text" placeholder="Descripción del grupo" style="border-style: outset;" class="col-lg-12">
                                    </div>
                                
                                    <!--<div class="col-lg-12 shoping__discount">
                                        <a class="text_cool">Agregar integrantes </a>
                                        <br>
                                            <input type="search" id="busqueda_usuarios" name="busqueda_usuarios" placeholder="Nombre de usuario" list="usuarios">
                                            <input type="button" onclick="agregar_usuarios();" value="Agregar Usuarios">
                                            <input type="button" onclick="imprimir_lista();" value="Imprimir Lista">                                            
                                            <br>

                                        <br>
                                        <a class="text_cool">Lista de usuarios</a>
                                        <ul id="lista_usuarios">
                                        </ul>

                                            
                                    </div>-->
                                
                                    <div class="text-center">
                                        <br><br><br>
                                        <button class="primary-btn" type="submit" width="90px" id="agregar_grupo" name="agregar_grupo">Agregar Grupo</button>
                                        <button type="button" onclick="window.modal.close();" class="button_close" data-dismiss="modal">Cerrar</button>
                                    </div>
                                </form>
                                <!--<datalist id="usuarios">
                                    <?php
                                    while($usuario = mysqli_fetch_array($ResultadoUsuarios))
                                        echo "<option value='".$usuario['nombre_usuario']."'>"; 
                                    ?>
                                </datalist>-->
                            </div>
                        </dialog>

                        
                    </div><br>
                    <div class="container">
                        <div class="row">
                            <?php
                            while($grupos = mysqli_fetch_array($ResultadoGrupos)){
                                echo "<div class='col-lg-4 col-md-4 col-sm-6'>";
                                    echo "<div class='blog__item'>";
                                        echo "<div class='blog__item__pic'>";
                                            echo "<img src='img/grupos/".$grupos['imagen_grupo']."'>";
                                        echo "</div>";
                                        echo "<div class='blog__item__text'>";
                                            echo "<h5><a href='vista_grupo.php?grupo=".$grupos['idgrupo']."'> ".$grupos['nombre']."</a></h5>";
                                            echo "<p>".$grupos['descripcion']."</p>";
                                        echo "</div>";
                                    echo "</div>";
                                echo "</div>";
                            }
                            ?>
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

    <script src="propios/agregar_grupos.js"></script>

    <!--
    <script>
        function agregarUsuarios() {
          // Obtén el valor del campo de búsqueda de usuarios
          var usuarioSeleccionado = document.getElementById('busqueda_usuarios').value;
        
          // Realiza una petición AJAX para insertar el usuario en la tabla 'usuarios_grupos'
          var xhr = new XMLHttpRequest();
          xhr.open('POST', 'insertar_usuario_grupo.php', true);
          xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
          xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
              // Aquí puedes realizar alguna acción si la petición se ha realizado con éxito
              console.log(xhr.responseText);
            }
          };
          xhr.send('usuarioSeleccionado=' + usuarioSeleccionado);
        }
    </script>
-->


</body>

</html>