<?php
    session_start();
    $nombre_usuario = '';
    $contrasena = '';
    //echo "Parametros por POST: ";
    //print_r($_POST);

    if(isset($_POST['nombre_usuario']) && isset($_POST['contrasena'])){
        $nombre_usuario = $_POST['nombre_usuario'];
        $contrasena = $_POST['contrasena'];
    }
    //echo $nombre_usuario; // muestra el valor actualizado
    //print_r($nombre_usuario);
    //echo $_POST['nombre_usuario'];

    //Establecer la conexion a la base de datos
    $conexion=mysqli_connect('localhost','root','','ingsoft');

    //Verificar que se pudo conectar a la base de datos
    if(!$conexion){
         die("Error al conectarse a la base de datos: ".mysqli_connect_error());
    }

    //consulta para verificar que el usuario y contrasena existen en la base de datos
    
    $ConsultaUsuario ="SELECT * FROM usuario WHERE nombre_usuario = '".$nombre_usuario."' AND contrasena='".$contrasena."' ";
    //echo $ConsultaUsuario;

    $ResultadoUsuario = mysqli_query($conexion, $ConsultaUsuario);
    //echo $ResultadoUsuario;
    //echo mysqli_num_rows($ResultadoUsuario);
    
    if(mysqli_num_rows($ResultadoUsuario)){
        $Registro = mysqli_fetch_assoc($ResultadoUsuario);            
        $_SESSION['nombre_usuario']=$nombre_usuario;
        $_SESSION['contrasena']=$contrasena;
        $_SESSION['idusuario']=$Resgitro['idusuario'];
        $_SESSION['login']=1;
        header('Location: Home_Page.php');
      }else{
        //alert( "Usuario y/o  contrasena Incorrectos");
        $_SESSION['login']=0;
        $_SESSION['nombre_usuario']='';
        $_SESSION['contrasena']='';
        $_SESSION['id_usuario']='';
      }
      

    //Indicar que el registro fue exitoso Falla
    if (isset($_SESSION['registro_exitoso'])) {
        echo "<script>Registro exitoso. Ingrese sus datos para iniciar sesión.</script>";
        unset($_SESSION['registro_exitoso']);
    }

    //crea una alerta que aparezca como modal
    //if (isset($_SESSION['login'])) {
    //    if ($_SESSION['login']==0) {
    //        echo "<script>alert('Usuario y/o contraseña incorrectos.')</script>";
    //        unset($_SESSION['login']);
    //    }
    //}

    //echo "Parametros por POST: ";
    //print_r($_POST);
    print_r($_SESSION);

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



<body background="img/fondo_login.jpg">
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Humberger Begin -->
    
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    
    <!-- Header Section End -->
   
    <!-- Hero Section Begin -->
  
    <!-- Hero Section End -->

    <!-- Breadcrumb Section Begin -->
    
    <!-- Breadcrumb Section End -->
    
    <!-- Contact Form Begin -->
    <br><br><br><br><br>
        <div class="container">
            <div class="row">
                <div class="col-lg-12"><center>  
                    <div class="col-lg-6 text-center">
                        <div class="checkout__order">
                            <h4>Iniciar Sesión</h4>
                                <ul>
                                    <div class="checkout__form">
                                        <form id="formAuthentication" action="login.php" method="POST">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-6">
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-6">
                                                            <div class="checkout__input">
                                                                <h5>Usuario:</h5>
                                                                <input type="text" id="nombre_usuario" name="nombre_usuario">
                                                            </div>
                                                            <div class="checkout__input">
                                                                <h5>Contraseña:</h5>
                                                                <input type="text" id="contrasena" name="contrasena">
                                                            </div>
                                                            <div class="checkout__input__checkbox">
                                                                <label for="paypal">
                                                                    Recordarme en este dispositivo
                                                                    <input type="checkbox" id="paypal">
                                                                    <span class="checkmark"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button class="primary-btn" type="submit" width="90px">Iniciar Sesión</button>
                                        </form>
                                    </div>
                                </ul>
                                
                            <!--<a href="Home_Page.html" type="submit" class="primary-btn" width="90px">Iniciar Sesión</a>-->
                            <br><br><p>¿No tienes cuenta? <span><a href="registrar_usuario.php" type="submit" class="text-danger">Crear cuenta</a></span></p>
                        </div>
                    </div>
                    
                </div></center>
            </div>
        </div>
    <!-- Contact Form End -->
    
    <!-- Footer Section Begin -->
        
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
