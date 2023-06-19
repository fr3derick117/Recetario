<?php
session_start();
if($_SESSION['login']=='' || $_SESSION['login']==null || $_SESSION['login']=='0' ){
    header('Location: login.php');
}

if (isset($_GET['logout'])) {
  session_unset();
  session_destroy();
  header("Location: login.php");
}

$conexion = mysqli_connect('localhost', 'root', '', 'ingsoft');
if (!$conexion) {
    die("Error al conectarse a la base de datos: " . mysqli_connect_error());
}

$ConsultaUsuario = "SELECT * FROM usuario WHERE idusuario = '".$_SESSION['id_usuario']."' ";
$ResultadoUsuario = mysqli_query($conexion, $ConsultaUsuario);

$ConsultaReceta = "SELECT * FROM receta WHERE idreceta = '".$_GET['receta']."' ";
$ResultadoReceta = mysqli_query($conexion, $ConsultaReceta);

$ConsultaIngrediente = "SELECT `ingredientes_de_receta`.*, `medidas`.*
FROM `ingredientes_de_receta`, `medidas`
WHERE ingredientes_de_receta.receta_idreceta = '".$_GET['receta']."'  AND `ingredientes_de_receta`.`medidas_idmedida` = medidas.idmedidas;";
$ResultadoIngredientes = mysqli_query($conexion, $ConsultaIngrediente);

$ConsultaInstrucciones = "SELECT * FROM ins WHERE id_receta = '".$_GET['receta']."' ";
$ResultadoInstrucciones = mysqli_query($conexion, $ConsultaInstrucciones);

if(isset($_POST['agregar_carrito'])){
    $ConsultaAgregarCarrito = "INSERT INTO recetas_carrito (id_usuario, id_receta)
        VALUES ('".$_SESSION['id_usuario']."', '".$_GET['receta']."')";
    $ResultadoAgregarCarrito = mysqli_query($conexion, $ConsultaAgregarCarrito);
}

if(isset($_POST['agregar_favoritos'])){
    $ConsultaAgregarFavoritos = "INSERT INTO usuarios_recetas_favoritas (id_usuario, id_receta)
        VALUES ('".$_SESSION['id_usuario']."', '".$_GET['receta']."')";
    $ResultadoAgregarFavoritos = mysqli_query($conexion, $ConsultaAgregarFavoritos);
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
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <style>
        #form {
        width: 250px;
        margin: 0 auto;
        height: 50px;
        }

        #form p {
        text-align: center;
        }

        #form label {
        font-size: 30px;
        }

        input[type="radio"] {
        display: none;
        }

        label {
        color: grey;
        }

        .clasificacion {
        direction: rtl;
        unicode-bidi: bidi-override;
        font-size: 25px;
        }

        label:hover,
        label:hover ~ label {
        color: orange;
        }

        input[type="radio"]:checked ~ label {
        color: orange;
        }

        .button-favoritos{
            color: rgb(194, 23, 23);
            font-size: 30px;
        }

        .button-compra{
            color: rgb(101, 163, 88);
            font-size: 30px;
        }
        
    </style>
</head>
<body>
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
    <br>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">  
                    <div class="section-title product__discount__title">
                        <?php
                            if($receta = mysqli_fetch_array($ResultadoReceta)){
                                echo "<h2>".$receta['nombre_receta']."</h2>";
                            }
                        ?>
                        </div>
                    <div>
                        <?php
                            echo "<img class='col-lg-12 col-md-6 col-sm-6' src='img/recetas/".$receta['foto_principal']."' width='100px' height='540px'></img>";
                        ?>
                    </div><br><br>
                        <table>
                            <tr  class="product__details__text">
                                <th align="center" width="190px"><img src="img/reloj.png" width="17px" height="17px">   Tiempo de preparación </th>
                                <th align="center" width="100px"><img src="img/porciones.png" width="20px" height="17px">   Porciones </th>
                                <th align="center" width="110px"><img src="img/dificultad.png" width="20px" height="17px">Dificultad </th>
                                <th align="center" width="110px">★ Ranking </th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <td>
                                    <form method="post" action="compartir.php">
                                        <input type="hidden" name="id_grupo" value="ID_DEL_GRUPO_A_AGREGAR">
                                        <input type="hidden" name="id_receta" value="ID_DE_LA_RECETA_ACTUAL">
                                        <button type="submit" class="btn btn-success style" style="width: 100px;">Compartir</button>
                                    </form>
                                </td>
                                <!-- Backend de favoritos -->
                                <td>
                                    <form method="post" action="">
                                        <button type="submit" id="agregar_carrito" name="agregar_carrito" class="button-compra fa fa-shopping-bag" ></button>
                                    </form>
                                </td>
                                <td>
                                    <form method="post" action="">
                                        <button type="submit" id="agregar_favoritos" name="agregar_favoritos" class="button-favoritos fa fa-heart" ></button>
                                    </form>
                                  <!-- Backend de favoritos -->
                                </td>

                            </tr>
                            <tr>
                                <?php
                                    echo "<td align='center' width='190px'>".$receta['tiempo_preparacion']."</td>";
                                    echo "<td align='center' width='100px'>".$receta['porciones']."</td>";
                                    echo "<td align='center' width='100px'>".$receta['dificultad']."</td>";
                                ?>
                                <td align="center">
                                    <form>
                                        <p class="clasificacion">
                                          <input id="radio1" type="radio" name="estrellas" value="5"><!--
                                          --><label for="radio1">★</label><!--
                                          --><input id="radio2" type="radio" name="estrellas" value="4"><!--
                                          --><label for="radio2">★</label><!--
                                          --><input id="radio3" type="radio" name="estrellas" value="3"><!--
                                          --><label for="radio3">★</label><!--
                                          --><input id="radio4" type="radio" name="estrellas" value="2"><!--
                                          --><label for="radio4">★</label><!--
                                          --><input id="radio5" type="radio" name="estrellas" value="1"><!--
                                          --><label for="radio5">★</label>
                                        </p>
                                    </form>
                                </td>
                                <td align="center" width="110px"></td>   
                                <td align="center" width="110px"></td>   
                                <td align="center" width="110px"></td>   
                                <td align="center" width="110px"></td>  
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
                            <?php
                                while($ingrediente = mysqli_fetch_array($ResultadoIngredientes)){
                                    echo "<tr>";
                                        echo "<td class='checkout__input__checkbox'>";
                                            echo "<label for='1'>";
                                                echo $ingrediente['ingrediente'];
                                                echo "<input type='checkbox' id='1'>";
                                                echo "<span class='checkmark'></span>";
                                            echo "</label>";
                                        echo "</td>";
                                        echo "<td>".$ingrediente['cantidad']." ".$ingrediente['nombre_medida']."</td>";
                                    echo "</tr>";
                                }
                            ?>
                        </table>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="section-title product__discount__title">
                            <h2>Instrucciones</h2>
                        </div>
                        
                            <?php
                                echo "<ol>";
                                while($instruccion = mysqli_fetch_array($ResultadoInstrucciones)){
                                    echo "<li>".$instruccion['ingrediente']."</li>";
                                    echo '<img src="' . $instruccion['foto'] . '" alt="Imagen" style="width: 100px;">';
                                }
                                echo "</ol>";
                            ?> 
                    </div>
                </div>
            </div>
            <div>
                <p>.</p>
            </div>
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