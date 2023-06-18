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
        button{
            padding:0;
            border:0;
            margin:0;
            width: 1150px;
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
                                        <li><img src="img/foto_perfil.png" width="70px" height="70px"></img>
                                            <ul class="header__menu__dropdown" width="60px" height="60px">
                                                <li><a class="text-center" href="perfil_misrecetas.php">Perfil</a></li>
                                                <li><a class="text-center" href="perfil_misrecetas.php">Mis Recetas</a></li>
                                                <li><a class="text-center" href="Home_Page.php">Home Page</a></li>
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
                                <th align="center" width="190px"><img src="img/reloj.png" width="17px" height="17px">   Tiempo de preparación </th>
                                <th align="center" width="100px"><img src="img/porciones.png" width="20px" height="17px">   Porciones </th>
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
  <button class="btn btn-heart-small" data-receta="ID_RECETA_AQUI">
    <i class="fa fa-heart"></i>
  </button>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    $('.btn-heart-small').click(function() {
      var recetaID = $(this).data('receta');
      var userID = // Obtener el ID de usuario del usuario actual

      $.ajax({
        url: 'ruta_del_backend',
        method: 'POST',
        data: { recetaID: recetaID, userID: userID },
        success: function(response) {
          // Manejar la respuesta del backend si es necesario
        },
        error: function(xhr, status, error) {
          // Manejar errores si es necesario
        }
      });
    });
  });
</script>
<?php
// Obtener los datos de la solicitud AJAX
$recetaID = $_POST['recetaID'];
$userID = $_POST['userID'];

// Realizar las operaciones de validación y sanitización de datos si es necesario

// Realizar la inserción en la tabla usuarios_recetas_favoritas
$conexion = new mysqli('localhost', 'usuario', 'contraseña', 'basededatos');
$query = "INSERT INTO usuarios_recetas_favoritas (id_usuario, id_receta) VALUES ('$userID', '$recetaID')";

if ($conexion->query($query) === TRUE) {
  // La inserción fue exitosa
  echo json_encode(['status' => 'success']);
} else {
  // Ocurrió un error durante la inserción
  echo json_encode(['status' => 'error', 'message' => $conexion->error]);
}

$conexion->close();
?>

  <!-- Backend de favoritos -->
</td>

                            </tr>
                            <tr>
                                <td align="center" width="190px">120 mins</td>
                                <td ></td>
                                <td></td>
                                <td>  </td>
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