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
$preferencias = array();
$alergia = array();

// Obtener los datos del formulario
if(isset($_POST['nombre_usuario']) && isset($_POST['correo_electronico']) && isset($_POST['contrasena'])){
    $nombre_usuario = $_POST['nombre_usuario'];
    $correo_electronico = $_POST['correo_electronico'];
    $contrasena = $_POST['contrasena'];
    
    if(isset($_POST['lacteos'])){
        $alergias[] = $_POST['lacteos'];
    }
    if(isset($_POST['huevo'])){
        $alergias[] = $_POST['huevo'];
    }
    if(isset($_POST['mariscos'])){
        $alergias[] = $_POST['mariscos'];
    }
    if(isset($_POST['mani'])){
        $alergias[] = $_POST['mani'];
    }
    if(isset($_POST['frutos_secos'])){
        $alergias[] = $_POST['frutos_secos'];
    }
    if(isset($_POST['trigo'])){
        $alergias[] = $_POST['trigo'];
    }
    if(isset($_POST['gluten'])){
        $alergias[] = $_POST['gluten'];
    }
    if(isset($_POST['chocolate'])){
        $alergias[] = $_POST['chocolate'];
    }
    if(isset($_POST['maiz'])){
        $alergias[] = $_POST['maiz'];
    }
    if(isset($_POST['fresas'])){
        $alergias[] = $_POST['fresas'];
    }

    if(isset($_POST['vegetariano'])){
        $preferencias[] = $_POST['vegetariano'];
    }
    if(isset($_POST['vegano'])){
        $preferencias[] = $_POST['vegano'];
    }
    if(isset($_POST['keto'])){
        $preferencias[] = $_POST['keto'];
    }
    if(isset($_POST['sin-alcohol'])){
        $preferencias[] = $_POST['sin-alcohol'];
    }
    if(isset($_POST['diabetico'])){
        $preferencias[] = $_POST['diabetico'];
    }
    if(isset($_POST['carnivoro'])){
        $preferencias[] = $_POST['carnivoro'];
    }
    if(isset($_POST['fitness'])){
        $preferencias[] = $_POST['fitness'];
    }

}

$MaxID = "SELECT MAX(idusuario) as last_id FROM usuario";
$ConsultaMaxID = mysqli_query($conexion, $MaxID);
// Comprobar si se encontró algún resultado
if ($ConsultaMaxID -> num_rows > 0) {
    // Obtener el resultado como un arreglo asociativo
    $row = $ConsultaMaxID -> fetch_assoc();
    // Obtener el último ID
    $last_id = $row["last_id"] + 1;
    // Imprimir el último ID
} 

if (isset($_FILES['profile-pic-upload'])) {
    $archivo = $_FILES['profile-pic-upload'];
    $imagen = $_FILES['profile-pic-upload']['tmp_name'];
    $nombre_imagen = $_FILES['profile-pic-upload']['name'];
    $tipo = $_FILES['profile-pic-upload']['type'];
    $ruta = "img/usuarios/" . $nombre_imagen;

    if (move_uploaded_file($imagen, $ruta)) {
        echo "El archivo se subió correctamente";
    } else {
        echo "Ocurrió un error al subir el archivo";
    }
}

//print_r($_POST);
//print_r($_FILES);
//print_r($imagen);
//print_r($alergias);
//print_r($preferencias);

// Insertar los datos en la base de datos
//Una consulta para crear un registro de usuario
if (isset($_POST['registrar']) && ($_POST['nombre_usuario']!=NULL) && ($_POST['correo_electronico']!=NULL) && ($_POST['contrasena']!=NULL) ) {
    $ConsultaAgregar = "INSERT INTO usuario (idusuario, nombre_usuario, correo_electronico, contrasena, imagen, receta_favorita, receta_mas_preparada, receta_menos_preparada) 
        VALUES ($last_id, '".$nombre_usuario."', '".$correo_electronico."', '".$contrasena."', '".$nombre_imagen."', NULL, NULL, NULL);";
    $RegistroAgregar = mysqli_query($conexion, $ConsultaAgregar);

    foreach($alergias as $alergia){
        $ConsultaAlergia = "INSERT INTO usuarios_alergias (id_usuario, alergia) 
        VALUES ($last_id, '".$alergia."');";
        $RegistroAlergia = mysqli_query($conexion, $ConsultaAlergia);
    }

    foreach($preferencias as $preferencia){
        $ConsultaPreferencia = "INSERT INTO usuarios_preferencias (id_usuario, preferencia) 
        VALUES ($last_id, '".$preferencia."');";
        $RegistroPreferencia = mysqli_query($conexion, $ConsultaPreferencia);
    }

    // Indicar que el registro fue exitoso
    $_SESSION['registro_exitoso'] = true;
    header("Location: registrar_usuario.php");
    exit();
}

//print_r($ConsultaAgregar);
//print_r($ConsultaAlergia);
//print_r($ConsultaPreferencia);

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
                       <ul>
                         <div class="checkout__form">
                            <form id="formAuthentication" action="registrar_usuario.php" method="POST" enctype="multipart/form-data">
                                <label for="profile-pic-upload">
                                    <div class="circle">
                                        <img id="profile-pic" src="img/perfil_grupo.png" alt="Profile Picture">
                                    </div>
                                </label>
                                <input type="file" name="profile-pic-upload" id="profile-pic-upload" accept="image/*">
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
                                                     </br>
                                                     <div class="checkbox">
                                                         <input type="checkbox" id="lacteos" name="lacteos" value="lacteos">
                                                         <label for="lacteos">Lácteos</label>
                                                     </div>
                                                     <div class="checkbox">
                                                         <input type="checkbox" id="huevo" name="huevo" value="huevo">
                                                         <label for="huevo">Huevo</label>
                                                     </div>
                                                     <div class="checkbox">
                                                         <input type="checkbox" id="mariscos" name="mariscos" value="mariscos">
                                                         <label for="mariscos">Mariscos</label>
                                                     </div>
                                                     <div class="checkbox">
                                                         <input type="checkbox" id="mani" name="mani" value="mani">
                                                         <label for="mani">Maní</label>
                                                     </div>
                                                     <div class="checkbox">
                                                         <input type="checkbox" id="frutos_secos" name="frutos_secos" value="frutos_secos">
                                                         <label for="frutos_secos">Frutos secos</label>
                                                     </div>
                                                     <div class="checkbox">
                                                         <input type="checkbox" id="trigo" name="trigo" value="trigo">
                                                         <label for="trigo">Trigo</label>
                                                     </div>
                                                     <div class="checkbox">
                                                         <input type="checkbox" id="gluten" name="gluten" value="gluten">
                                                         <label for="gluten">Gluten</label>
                                                     </div>
                                                     <div class="checkbox">
                                                         <input type="checkbox" id="chocolate" name="chocolate" value="chocolate">
                                                         <label for="chocolate">Chocolate</label>
                                                     </div>
                                                     <div class="checkbox">
                                                         <input type="checkbox" id="maiz" name="maiz" value="maiz">
                                                         <label for="maiz">Maíz</label>
                                                     </div>
                                                     <div class="checkbox">
                                                         <input type="checkbox" id="fresas" name="fresas" value="fresas">
                                                         <label for="fresas">Fresas</label>
                                                     </div>
                                                 </div>
                                                 <div class="column">
                                                     <h3>Preferencias:</h3>
                                                 </br>
                                                     <div class="Preferencias">
                                                         <input type="checkbox" id="vegetariano" name="vegetariano" value="vegetariano">
                                                         <label for="vegetariano">Vegetariano</label>
                                                     </div>
                                                     <div class="checkbox">
                                                         <input type="checkbox" id="vegano" name="vegano" value="vegano">
                                                         <label for="vegano">Vegano</label>
                                                     </div>
                                                     <div class="checkbox">
                                                         <input type="checkbox" id="keto" name="keto" value="keto">
                                                         <label for="keto">Keto</label>
                                                     </div>
                                                     <div class="checkbox">
                                                         <input type="checkbox" id="sin-alcohol" name="sin-alcohol" value="sin-alcohol">
                                                         <label for="sin-alcohol">Sin alcohol</label>
                                                     </div>
                                                     <div class="checkbox">
                                                         <input type="checkbox" id="diabetico" name="diabetico" value="diabetico">
                                                         <label for="diabetico">Diabético</label>
                                                     </div>
                                                     <div class="checkbox">
                                                         <input type="checkbox" id="carnivoro" name="carnivoro" value="carnivoro">
                                                         <label for="carnivoro">Carnívoro</label>
                                                     </div>
                                                     <div class="checkbox">
                                                         <input type="checkbox" id="fitness" name="fitness" value="fitness">
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