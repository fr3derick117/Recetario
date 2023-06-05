<?php

//Establecer la conexion a la base de datos
$conexion = mysqli_connect('localhost', 'root', '', 'ingsoft');

//Verificar que se pudo conectar a la base de datos
if (!$conexion) {
    die("Error al conectarse a la base de datos: " . mysqli_connect_error());
}

$nombre_usuario = '';
$correo_electronico ='';
$contrasena = '';

// Obtener los datos del formulario
if(isset($_POST['nombre_usuario']) && isset($_POST['correo_electronico']) && isset($_POST['contrasena'])){
    $nombre_usuario = $_POST['nombre_usuario'];
    $correo_electronico = $_POST['correo_electronico'];
    $contrasena = $_POST['contrasena'];
}

//print_r($_POST);

// Insertar los datos en la base de datos
//Una consulta para crear un registro de usuario
if (isset($_POST['registrar'])) {
    $ConsultaAgregar = "INSERT INTO usuario (idusuario, nombre_usuario, correo_electronico, contrasena, favoritos) 
        VALUES (NULL, '".$nombre_usuario."', '".$correo_electronico."', '".$contrasena."', NULL);";
    $RegistroAgregar = mysqli_query($conexion, $ConsultaAgregar);
    // Indicar que el registro fue exitoso
    $_SESSION['registro_exitoso'] = true;
    header("Location: login.php");
    exit();
}

/*if (!$RegistroAgregar) {
    die("Error al insertar los datos en la base de datos: " . mysqli_error($conexion));
}*/


// Redirigir al usuario a la página de inicio de sesión


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
        button {
            padding: 0;
            border: 0;
            margin: 0;
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
            <div class="col-lg-12">
                <center>
                    <div class="col-lg-6">
                        <div class="checkout__order">
                            <h4>Registrarse</h4>
                           <style>
        .circle {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background-color: #ccc;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            cursor: pointer;
        }
        .circle img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        #profile-pic-upload {
            display: none;
        }
    </style>
</head>
<body>
    <label for="profile-pic-upload">
        <div class="circle">
            <img id="profile-pic" src="default-profile-pic.png" alt="Profile Picture">
        </div>
    </label>

    <input type="file" id="profile-pic-upload" accept="image/*">

    <script>
        // Obtén referencia al elemento de carga de archivo
        var fileUpload = document.getElementById('profile-pic-upload');

        // Escucha el evento de cambio de archivo
        fileUpload.addEventListener('change', function (e) {
            var reader = new FileReader();

            reader.onload = function (event) {
                // Actualiza la imagen de perfil con la imagen cargada
                document.getElementById('profile-pic').src = event.target.result;
            }

            // Lee el archivo como una URL de datos
            reader.readAsDataURL(e.target.files[0]);
        });
    </script> 
                            <ul>
                                <div class="checkout__form">
                                    <form id="formAuthentication" action="registrar_usuario.php" method="POST">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-6">
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-6">
                                                        <div class="checkout__input">
                                                            <h5>Nombre de usuario:</h5>
                                                            <input type="text" id="nombre_usuario" name="nombre_usuario">
                                                        </div>
                                                        <div class="checkout__input">
                                                            <h5>Correo electrónico:</h5>
                                                            <input type="text" id="correo_electronico" name="correo_electronico">
                                                        </div>
                                                        <div class="checkout__input">
                                                            <h5>Contraseña:</h5>
                                                            <input type="text" id="contrasena" name="contrasena">
                                                        </div>
                                                        <style>
        .column {
            float: left;
            width: 50%;
        }
        .checkbox {
            margin-bottom: 10px;
        }
    </style>
    <div class="column">
        <h3>Alergias:</h3>
        <div class="checkbox">
            <input type="checkbox" id="lacteos" name="alergia" value="lacteos">
            <label for="lacteos">Lácteos</label>
        </div>
        <div class="checkbox">
            <input type="checkbox" id="huevo" name="alergia" value="huevo">
            <label for="huevo">Huevo</label>
        </div>
        <div class="checkbox">
            <input type="checkbox" id="mariscos" name="alergia" value="mariscos">
            <label for="mariscos">Mariscos</label>
        </div>
        <div class="checkbox">
            <input type="checkbox" id="mani" name="alergia" value="mani">
            <label for="mani">Maní</label>
        </div>
        <div class="checkbox">
            <input type="checkbox" id="frutos-secos" name="alergia" value="frutos-secos">
            <label for="frutos-secos">Frutos secos</label>
        </div>
    </div>
    <div class="column">
        <h3>Preferencias:</h3>
        <div class="Preferencias">
            <input type="checkbox" id="vegetariano" name="preferencia" value="vegetariano">
            <label for="vegetariano">Vegetariano</label>
        </div>
        <div class="checkbox">
            <input type="checkbox" id="vegano" name="preferencia" value="vegano">
            <label for="vegano">Vegano</label>
        </div>
        <div class="checkbox">
            <input type="checkbox" id="keto" name="preferencia" value="keto">
            <label for="keto">Keto</label>
        </div>
        <div class="checkbox">
            <input type="checkbox" id="sin-alcohol" name="preferencia" value="sin-alcohol">
            <label for="sin-alcohol">Sin alcohol</label>
        </div>
        <div class="checkbox">
            <input type="checkbox" id="diabetico" name="preferencia" value="diabetico">
            <label for="diabetico">Diabético</label>
        </div>
        <div class="checkbox">
            <input type="checkbox" id="carnivoro" name="preferencia" value="carnivoro">
            <label for="carnivoro">Carnívoro</label>
        </div>
        <div class="checkbox">
            <input type="checkbox" id="fitness" name="preferencia" value="fitness">
            <label for="fitness">Fitness</label>
        </div>
    </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="primary-btn" type="submit" width="90px" id="registrar" name="registrar">Registrarse</button>
                                    </form>
                                </div>
                            </ul>
                            <!--<a href="login.html" type="submit" class="primary-btn" width="90px">Registrarse</a>-->
                        </div>
                    </div>

            </div>
            </center>
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