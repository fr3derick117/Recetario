<?php
session_start();

//Cerrar sesion
if ($_SESSION['login'] == '' || $_SESSION['login'] == null || $_SESSION['login'] == '0') {
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

//id de receta
$sql = "SELECT MAX(idreceta) as last_id FROM receta";
$result = mysqli_query($conexion, $sql);
// Comprobar si se encontró algún resultado
if ($result->num_rows > 0) {
    // Obtener el resultado como un arreglo asociativo
    $row = $result->fetch_assoc();
    // Obtener el último ID
    $last_id = $row["last_id"] + 1;
    // Imprimir el último ID
}

//Crear Receta
//print_r($_FILES['imagen']);

if (isset($_FILES['imagen'])) {
    $imagen = $_FILES['imagen']['tmp_name'];
    $nombre = $_FILES['imagen']['name'];
    $tipo = $_FILES['imagen']['type'];

    //crear una carpeta con el nombre de la receta
    //mover la imagen a la carpeta creada
    //crear una ruta que guarde la imagen en una carpeta con el nombre de la receta dentro de la carpeta receta
    
    $receta = $_POST['titulo'];
    $ruta = "img/recetas/" . $nombre;
    //echo $ruta;

    if(move_uploaded_file($imagen, $ruta)){
        echo "Se movio la imagen";
    }
    // Aquí debes agregar código para conectarte a la base de datos MySQL
    // y guardar la imagen en una tabla de la base de datos.
    //$AgregarImagen = "INSERT INTO preparaciones (idpreparacion, preparacion, receta_idreceta, nombre_imagen)
    //    VALUES (NULL, NULL, '$last_id', '$nombre')";


    // Ejecutar la consulta
    //$ConsultaImagen = mysqli_query($conexion, $AgregarImagen);

}


if (isset($_POST['agregar_receta'])) {
    $ConsultaAgregarReceta = "INSERT INTO receta 
        (idreceta, nombre_receta, porciones, tiempo_preparacion, tiempo_comida, tipo_comida, tipo_preferencia, dificultad, descripcion, foto_principal, usuario_idusuario, calificacion ) 
        VALUES 
        ('" . $last_id . "', 
        '" . $_POST['titulo'] . "', 
        '" . $_POST['porciones'] . "', 
        '" . $_POST['tiempo_preparacion'] . "', 
        '" . $_POST['tiempo_comida'] . "', 
        '" . $_POST['tipo_comida'] . "', 
        '" . $_POST['tipo_preferencia'] . "', 
        '" . $_POST['dificultad'] . "', 
        '" . $_POST['descripcion'] . "', 
        '".$nombre."', 
        '" . $_SESSION['id_usuario'] . "',
        NULL);";
    $ResultadoAgregarReceta = mysqli_query($conexion, $ConsultaAgregarReceta);
    
    //crear una consulta con php a la tabla ingredientes_de_receta en la base de datos de ingsoft para insertar un nuevo registro
    //$ConsultaAgregarIngredientesReceta = "INSERT INTO ingredientes_de_receta 
    //    (receta_idreceta, ingredientes_idingrediente, cantidad, medida) 
    //    VALUES
    //    ('".$last_id."', 
    //    '".$_POST['ingredientes']."',
    //    '".$_POST['cantidad']."',
    //    '".$_POST['medida']."');";

    //$ResultadoAgregarIngredientes = mysqli_query($conexion, $ConsultaAgregarIngredientesReceta);

    /*$SeleccionarUltimaReceta = "SELECT MAX(idreceta) FROM receta;";
    echo($SeleccionarUltimaReceta);
    $ConsultaAgregarIngredientesReceta = "INSERT INTO ingredientes_de_receta
    (receta_idreceta, ingredientes_idingrediente, cantidad, medida) 
    VALUES 
    ('".$SeleccionarUltimaReceta."', 
    '".$_POST['ingredientes']."',
    '".$_POST['cantidad']."',
    '".$_POST['medida']."');";
    $ResultadoAgregarIngredientes = mysqli_query($conexion, $ConsultaAgregarIngredientesReceta);*/
}

//print_r($ConsultaAgregarReceta);
//print_r($ResultadoAgregarReceta);
$last_id = $last_id - 1;


/*if(isset($_POST['mas'])){
$SeleccionarUltimaReceta = "SELECT MAX(idreceta) FROM receta;"+1;
echo($SeleccionarUltimaReceta);
$ConsultaAgregarIngredientesReceta = "INSERT INTO ingredientes_de_receta
(receta_idreceta, ingredientes_idingrediente, cantidad, medida) 
VALUES 
('".$SeleccionarUltimaReceta."', 
'".$_POST['ingredientes']."',
'".$_POST['cantidad']."',
'".$_POST['medida']."');";
$ResultadoAgregarIngredientes = mysqli_query($conexion, $ConsultaAgregarIngredientesReceta);
}*/

//echo "Parametros por POST: ";

//una consulta para ver todos los registros de la tabla ingredientes
//$ConsultaIngredientes = "SELECT * FROM ingredientes;";
//$ResultadoIngredientes = mysqli_query($conexion, $ConsultaIngredientes);

//$ConsultaMedidas = "SELECT * FROM medidas;";
//$ResultadoMedidas = mysqli_query($conexion, $ConsultaMedidas);
//imprimir la consulta de ingredientes
//print_r($ResultadoIngredientes);

//print_r($_POST);

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
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
                    <li><a href="#">Spanish</a></li>
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
                            <a href="./index.html"><img src="img/logo_blog_de_comdia.png" alt="" width="100px" height="100px"></a>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <nav class="header__menu">
                            <ul>
                                <div class="blog__sidebar__search">
                                    <form action="#">
                                        <input type="text" placeholder="Search...">
                                        <button type="submit"></button>
                                    </form>
                                </div>
                            </ul>
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
                                                            echo "<li><a class='text-center' href='perfil_lista_compra.html'>Lista de Compras</a></li>";
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
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>SUBE TU RECETA</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Contact Form Begin -->
    <div class="contact-form spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title product__discount__title">
                        <form method="post" action="subir_recetas.php" enctype="multipart/form-data">
                            <h2>Título: </h2><br><br>
                            <div class="row">
                                <input id="titulo" name="titulo" type="text" placeholder="Título">
                            </div>

                            <button type="button">
                                <img src="img/subetufoto.png" width="1150px" id="imagen" onclick="document.getElementById('fileInput').click();">
                                <input type="file" name="imagen" id="fileInput" style="display: none;" onchange="cargarImagen(this);">
                            </button>

                            <script>
                                /*const inputTitulo = document.getElementById('titulo');
                                const valorTitulo = inputTitulo.value;

                                async function createFolder() {
                                    try {
                                      const handle = await window.showDirectoryPicker();
                                      await handle.getDirectoryHandle(valorTitulo, { create: true });
                                      console.log('Carpeta creada exitosamente');
                                    } catch (error) {
                                      console.error('Error al crear la carpeta:', error);
                                    }
                                  }*/

                                function cargarImagen(input) {
                                    // Obtener la imagen seleccionada
                                    var imagen = input.files[0];

                                    // Crear un objeto de tipo FileReader para leer la imagen
                                    var reader = new FileReader();

                                    // Cuando se haya cargado la imagen, crear una imagen con el tamaño deseado
                                    reader.onload = function(e) {
                                        var img = new Image();
                                        img.onload = function() {
                                            // Crear un canvas con las dimensiones deseadas
                                            var canvas = document.createElement('canvas');
                                            var ctx = canvas.getContext('2d');
                                            canvas.width = 1150;
                                            canvas.height = 646.88;

                                            // Copiar la imagen original en el canvas con las dimensiones deseadas
                                            var ratio = Math.min(canvas.width / img.width, canvas.height / img.height);
                                            var width = img.width * ratio;
                                            var height = img.height * ratio;
                                            var x = (canvas.width - width) / 2;
                                            var y = (canvas.height - height) / 2;
                                            ctx.drawImage(img, x, y, width, height);

                                            // Obtener la URL del canvas y asignarla a la imagen
                                            var dataURL = canvas.toDataURL();
                                            document.getElementById('imagen').src = dataURL;
                                        };
                                        img.src = e.target.result;
                                    };

                                    // Leer la imagen seleccionada como una URL de datos
                                    reader.readAsDataURL(imagen);
                                    createFolder();
                                }
                                
                                
                            </script>
                            <!--<input type="submit" value="Guardar">-->
                            <br><br>

                            <div class="col-lg-12">
                                <nav class="header__menu">
                                    <ul>
                                        <li>
                                            <select id="tipo_comida" name="tipo_comida" onchange="mostrarOpcionSeleccionadaTipoComida()">
                                                <option value="" disabled selected><strong>Tipo de Comida:</strong></option>
                                                <option value="Entrada">Entrada</option>
                                                <option value="Sopa">Sopa</option>
                                                <option value="Plato Principa">Plato Principal</option>
                                                <option value="Ensalada">Ensalada</option>
                                                <option value="Bebida">Bebida</option>
                                                <option value="Sopa">Sopa</option>
                                                <option value="Pasta">Pasta</option>
                                                <option value="Postre">Postre</option>
                                            </select>
                                            <p id="opcion-seleccionada"></p>
                                        </li>
                                        <li>
                                            <select id="tiempo_comida" name="tiempo_comida" onchange="mostrarOpcionSeleccionadaTiempoComida()">
                                                <option value="" disabled selected><strong>Tiempo de Comida:</strong></option>
                                                <option value="Desayuno">Desayuno</option>
                                                <option value="Almuerzo">Almuerzo</option>
                                                <option value="Aperativo">Aperativo</option>
                                                <option value="Comida">Comida</option>
                                                <option value="Cena">Cena</option>
                                            </select>
                                            <p id="opcion-seleccionada"></p>
                                        </li>
                                        <li>
                                            <select id="tipo_preferencia" name="tipo_preferencia" onchange="mostrarOpcionSeleccionadaTipoPreferencia()">
                                                <option value="" disabled selected><strong>Preferencias</strong></option>
                                                <option value="Mariscos">Mariscos</option>
                                                <option value="Lácteos">Lácteos</option>
                                                <option value="Omnívoro">Omnívoro</option>
                                                <option value="Vegetariano">Vegetariano</option>
                                                <option value="Nueces y Dátlies">Nueces y Dátlies</option>
                                                <option value="Saludables">Saludables</option>
                                                <option value="Vegano">Vegano</option>
                                            </select>
                                            <p id="opcion-seleccionada"></p>
                                        </li>
                                        <li>
                                            <select id="dificultad" name="dificultad" onchange="mostrarOpcionSeleccionadaDificultad()">
                                                <option value="" disabled selected><strong>Dificultad:</strong></option>
                                                <option value="Alta">Alta</option>
                                                <option value="Media">Media</option>
                                                <option value="Baja">Baja</option>
                                            </select>
                                            <p id="opcion-seleccionada"></p>
                                        </li>
                                        <li>
                                            <div class="row">
                                                <input id="tiempo_preparacion" name="tiempo_preparacion" type="text" placeholder="Tiempo de Preparacion" style="border-radius: 10px; border: 2px solid #d9d9d9; padding: 5px; color: #333333;">
                                            </div>
                                        </li>
                                        <li>
                                            <div class="row">
                                                <input id="porciones" name="porciones" type="text" placeholder="Porciones" style="border-radius: 5px; border: 1px solid #d9d9d9; padding: 5px; color: #333333;">
                                            </div>
                                        </li>
                                        <li></li>
                                        <li>
                                            <div class="row">
                                              <input id="descripcion" name="descripcion" type="text" placeholder="Descripción" style="border-radius: 5px; border: 1px solid #d9d9d9; padding: 5px; color: #333333; width: 1140px;">
                                            </div>
                                        </li>
                                    </ul>
                                </nav><br>
                            </div>
                            <input type="submit" id="agregar_receta" name="agregar_receta" value="Agregar Descrpición de Receta" onclick="createFolder()">
                        </form>

                        <div class="section-title product__discount__title">
                            <h2>Ingredientes: </h2><br><br><br>

                            <?php

                            $ConsultaIngredientes = "SELECT * FROM ingredientes;";
                            $ResultadoIngredientes = mysqli_query($conexion, $ConsultaIngredientes);

                            if (isset($_POST['ingredientes'])) {
                                $ConsultaNombreIngrediente = "SELECT * FROM ingredientes WHERE imagen = '" . $_POST['ingredientes'] . "' ";
                                //print_r($ConsultaNombreIngrediente);
                                $ResultadoNombreIngrediente = mysqli_query($conexion, $ConsultaNombreIngrediente);
                                //print_r($ResultadoNombreIngrediente);
                                if ($ingrediente_especifico = mysqli_fetch_array($ResultadoNombreIngrediente)) {
                                    $nombre_ingrediente_especifico = $ingrediente_especifico['nombre_ingrediente'];
                                    //print_r($nombre_ingrediente_especifico);
                                }
                            }

                            $ConsultaMedidas = "SELECT * FROM medidas;";
                            $ResultadoMedidas = mysqli_query($conexion, $ConsultaMedidas);

                            if (isset($_POST['agregar_ingrediente'])) {
                                $ConsultaAgregarIngredientes = "INSERT INTO ingredientes_de_receta 
                                    (receta_idreceta, ingrediente, cantidad, medidas_idmedida) 
                                    VALUES
                                    ('" . $last_id . "', 
                                    '" . $nombre_ingrediente_especifico . "',
                                    '" . $_POST['cantidad'] . "',
                                    '" . $_POST['medida'] . "');";
                                $ResultadoAgregarIngredientes = mysqli_query($conexion, $ConsultaAgregarIngredientes);
                                //print_r($ConsultaAgregarIngredientes);
                                //print_r($ResultadoAgregarIngredientes);
                            }


                            // Verificar si se ha enviado el formulario
                            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                                // Obtener los datos del formulario
                                $ingrediente = isset($_POST['ingrediente']) ? $_POST['ingrediente'] : '';
                                $cantidad = isset($_POST['cantidad']) ? $_POST['cantidad'] : '';
                                $medida = isset($_POST['medida']) ? $_POST['medida'] : '';

                                // Procesar la imagen subida
                                $foto = isset($_FILES['foto']) ? $_FILES['foto'] : null;
                                $nombreArchivo = '';
                                $rutaArchivo = '';

                                if ($foto !== null && $foto['error'] === UPLOAD_ERR_OK) {
                                    $nombreArchivo = $ingrediente . '.' . pathinfo($foto['name'], PATHINFO_EXTENSION);
                                    $rutaArchivo = 'imagenes/' . $nombreArchivo;

                                    // Mover la imagen a la carpeta de imágenes
                                    move_uploaded_file($foto['tmp_name'], $rutaArchivo);

                                    // Insertar los datos en la base de datos
                                    $query = "INSERT INTO ingredientes (foto, ingrediente, cantidad, medida) VALUES ('$rutaArchivo', '$ingrediente', '$cantidad', '$medida')";

                                    if ($conexion->query($query) === true) {
                                        echo '<p>Receta subida correctamente.</p>';
                                        // Actualizar la página para reflejar los cambios
                                        echo '<script>window.location.href = "subir_recetas.php";</script>';
                                    } else {
                                        echo '<p>Error al subir la receta: ' . $conexion->error . '</p>';
                                    }
                                }
                            }
                            ?>


                            <form method="POST" id=enctype="multipart/form-data">
                                <style>
                                    .form-row {
                                        display: flex;
                                        align-items: center;
                                        justify-content: flex-start;
                                    }

                                    .form-row>* {
                                        margin-right: 10px;
                                    }

                                    #cantidad {
                                        width: 50px;
                                    }

                                    #medida {
                                        width: 150px;
                                    }
                                </style>

                                <div class="form-row">
                                    <select id="ingredientes" name="ingredientes" onchange="cambiarImagen()">
                                        <option value="" disabled selected>Selecciona un ingrediente</option>
                                        <?php
                                        //con la consulta $ResultadoIngredientes se agrega en la fila un select con value del parametro idingrediente y en la opcion el parametro nombre_ingrediente
                                        while ($fila = mysqli_fetch_array($ResultadoIngredientes)) {
                                            echo "<option value='" . $fila['imagen'] . "'>" . $fila['nombre_ingrediente'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                    <img id="imagen-ingrediente" src="img/Ingredientes/default.png" width="80" height="80">
                                    <label for="cantidad">Cantidad:</label>
                                    <input id="cantidad" name="cantidad" type="text" placeholder="Cantidad" style="width: 200px;">
                                    <label for="medida">Medida:</label>
                                    <select id="medida" name="medida" placeholder="Selecciona una medida">
                                        <option value="" disabled selected>Selecciona una medida</option>
                                        <?php
                                        //con la consulta $ResultadoIngredientes se agrega en la fila un select con value del parametro idingrediente y en la opcion el parametro nombre_ingrediente
                                        while ($fila = mysqli_fetch_array($ResultadoMedidas)) {
                                            echo "<option value='" . $fila['idmedidas'] . "'>" . $fila['nombre_medida'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <script>
                                    function cambiarImagen() {
                                        var nombreIngrediente = document.getElementById("ingredientes").value;
                                        document.getElementById("imagen-ingrediente").src = "img/Ingredientes/" + nombreIngrediente;
                                    }
                                </script>

                                <input type="submit" id="agregar_ingrediente" name="agregar_ingrediente" value="Agregar Ingrediente">
                            </form>

                            <table>
                                <tr>
                                    <th>Ingrediente</th>
                                    <th>Cantidad</th>
                                    <th>Medida</th>
                                </tr>
                                <?php
                                $ConsultaIngredientesReceta = "SELECT * FROM ingredientes_de_receta WHERE receta_idreceta = '" . $last_id . "' ";
                                $ResultadoIngredientesReceta = mysqli_query($conexion, $ConsultaIngredientesReceta);

                                while ($filaIngredientesReceta = mysqli_fetch_array($ResultadoIngredientesReceta)) {
                                    $ConsultaMedidasRecetas = "SELECT * FROM medidas WHERE idmedidas = '" . $filaIngredientesReceta['medidas_idmedida'] . "' ";
                                    //print_r($ConsultaMedidasRecetas);
                                    $ResultadoMedidasRecetas = mysqli_query($conexion, $ConsultaMedidasRecetas);
                                    //print_r($ResultadoMedidasRecetas);
                                    if ($filaMedidasReceta = mysqli_fetch_array($ResultadoMedidasRecetas)) {
                                        $nombre_medidas = $filaMedidasReceta['nombre_medida'];
                                    }
                                    echo "<tr>";
                                    echo "<td>" . $filaIngredientesReceta['ingrediente'] . "</td>";
                                    echo "<td>" . $filaIngredientesReceta['cantidad'] . "</td>";
                                    echo "<td>" . $nombre_medidas . "</td>";
                                    echo "</tr>";
                                }
                                ?>
                            </table>
                            
                            </div>
                            
                            <div class="section-title product__discount__title">
                                <style>
                                    .eliminar-fila,
                                    .agregar-fila {
                                        padding: 8px;
                                        width: 150px;
                                        height: 50px;
                                        font-size: 16px;
                                    }
                                </style>
                                <h2>Pasos de Preparación: </h2><br><br><br>
                                
                                <?php
                                // Verificar si se ha enviado el formulario
                                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                                    // Obtener los datos del formulario
                                    $ingrediente = isset($_POST['ingrediente']) ? $_POST['ingrediente'] : '';

                                    // Procesar la imagen subida
                                    $foto = isset($_FILES['foto']) ? $_FILES['foto'] : null;
                                    $nombreArchivo = '';
                                    $rutaArchivo = '';

                                    if ($foto !== null && $foto['error'] === UPLOAD_ERR_OK) {
                                      $nombreArchivo = $ingrediente . '.' . pathinfo($foto['name'], PATHINFO_EXTENSION);
                                      $rutaArchivo = 'img/recetas/' . $nombreArchivo;
                                    
                                      // Mover la imagen a la carpeta de imágenes
                                      move_uploaded_file($foto['tmp_name'], $rutaArchivo);
                                    
                                      // Insertar los datos en la base de datos
                                      $query = "INSERT INTO ins (id, id_receta, foto, ingrediente) VALUES (NULL, '$last_id','$rutaArchivo', '$ingrediente')";
                                    
                                      if ($conexion->query($query) === true) {
                                        echo '<p>Receta subida correctamente.</p>';
                                        // Actualizar la página para reflejar los cambios
                                        echo '<script>window.location.href = "subir_recetas.php";</script>';
                                        exit; // Agregar exit para evitar la ejecución adicional del código
                                      } else {
                                        echo '<p>Error al subir la receta: ' . $conexion->error . '</p>';
                                      }
                                    }
                                }                             
                                ?>

                            
                                <style>
                                    .center-form {
                                        display: flex;
                                        flex-direction: column;
                                        align-items: center;
                                        justify-content: center;
                                        height: 50vh;
                                    }
                                </style>

                                <div class="center-form">
                                    <form method="POST" enctype="multipart/form-data">
                                        <label for="ingrediente">Instrucción:</label>
                                        <input type="text" name="ingrediente" required style="width: 200px;"><br>
                                
                                        <label for="foto">Foto:</label>
                                        <input type="file" name="foto" accept="image/*" required style="width: 200px;"><br>
                                
                                        <input type="submit" id="agregar_instruccion" name="agregar_instruccion" value="Subir Instrucción o Paso" style="width: 200px;">
                                    </form>
                                </div>
                                
                                
                                <?php
                                // Obtener todas las recetas de la base de datos
                                $queryRecetas = "SELECT * FROM ins";
                                $resultadoRecetas = $conexion->query($queryRecetas);
                                if ($resultadoRecetas->num_rows > 0) {
                                    echo '<h2></h2>';
                                    echo '<table>';
                                    echo '<tr><th>Instruccion</th><th>Foto</th><th>Eliminar</th></tr>'; // Corregir el nombre de la columna
                                    while ($filaReceta = $resultadoRecetas->fetch_assoc()) {
                                        echo '<tr>';
                                        echo '<td>' . $filaReceta['ingrediente'] . '</td>';
                                        echo '<td><img src="' . $filaReceta['foto'] . '" alt="Imagen" style="width: 100px;"></td>';
                                        echo '<td>';
                                        echo '<form method="POST" style="display: inline-block;">';
                                        echo '<input type="hidden" name="id_receta" value="' . $filaReceta['id'] . '">';
                                        echo '<input type="submit" name="eliminar" value="Eliminar">';
                                        echo '</form>';
                                        echo '</td>';
                                        echo '</tr>';
                                    }
                                    echo '</table>';
                                }
                            
                                // Verificar si se ha enviado el formulario de eliminación
                                if (isset($_POST['id_receta'])) {
                                    // Obtener el ID de la receta a eliminar
                                    $idReceta = $_POST['id_receta'];
                                    // Eliminar la receta de la base de datos
                                    $queryEliminar = "DELETE FROM ins WHERE id='$idReceta'";
                                    if ($conexion->query($queryEliminar) === true) {
                                        echo '<p>Receta eliminada correctamente.</p>';
                                        // Actualizar la página para reflejar los cambios
                                        echo '<script>window.location.href = "subir_recetas.php";</script>';
                                        exit; // Agregar exit para evitar la ejecución adicional del código
                                    } else {
                                        echo '<p>Error al eliminar la receta: ' . $conexion->error . '</p>';
                                    }
                                }
                            
                                $conexion->close();
                                ?>
                            </div>
                            <button type="button" id="confirmar" name="confirmar" class="site-btn" onclick="window.location.href='perfil_misrecetas.php'">Confirmar Receta</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- Contact Form End -->

<!-- Footer Section Begin -->

<!-- Footer Section End -->

<!--
<script>
    // obtener elementos HTML
const tablaDatos = document.getElementById('tablaDatos');
const ingredientes = document.getElementById('ingredientes');
const btnAgregarFila = document.querySelector('.btn-success');
const btnEliminarFila = document.querySelector('.btn-danger');

// función para agregar una nueva fila
function agregarFila() {
  // clonar la fila original
  const filaOriginal = tablaDatos.querySelector('tbody tr');
  const nuevaFila = filaOriginal.cloneNode(true);

  // resetear valores en la fila clonada
  const selectIngrediente = nuevaFila.querySelector('#ingredientes');
  selectIngrediente.selectedIndex = 0;
  const inputCantidad = nuevaFila.querySelector('.pro-qty input');
  inputCantidad.value = '1';

  // agregar eventos a los botones de la fila clonada
  const btnAgregar = nuevaFila.querySelector('.btn-success');
  btnAgregar.addEventListener('click', agregarFila);
  const btnEliminar = nuevaFila.querySelector('.btn-danger');
  btnEliminar.addEventListener('click', eliminarFila);

  // agregar la fila clonada a la tabla
  const tbody = tablaDatos.querySelector('tbody');
  tbody.appendChild(nuevaFila);
}

// función para eliminar la fila actual
function eliminarFila() {
  const filaActual = this.closest('tr');
  if (filaActual) {
    filaActual.remove();
  }
}

// agregar eventos a los botones de la fila original
btnAgregarFila.addEventListener('click', agregarFila);
btnEliminarFila.addEventListener('click', eliminarFila);

</script>    -->

<script>
    // Obtener la tabla y el botón para agregar una fila
    const tabla = document.getElementById('tablaDatos');
    const btnAgregar = tabla.querySelector('button.btn-success');


    // Función para agregar una nueva fila
    function agregarFila(event) {
        // Obtener la fila en la que se encuentra el botón
        const filaActual = event.target.closest('tr');

        // Clonar la fila y limpiar los campos
        const nuevaFila = filaActual.cloneNode(true);
        const inputs = nuevaFila.querySelectorAll('input');
        inputs.forEach(input => input.value = '');

        // Agregar el evento onclick al botón "+" de la nueva fila
        const btnAgregarNuevaFila = nuevaFila.querySelector('button.btn-success');
        btnAgregarNuevaFila.onclick = agregarFila;

        // Agregar el evento onclick al botón "-" de la nueva fila
        const btnEliminar = nuevaFila.querySelector('button.btn-danger');
        btnEliminar.onclick = eliminarFila;

        // Insertar la nueva fila después de la fila actual
        tabla.querySelector('tbody').insertBefore(nuevaFila, filaActual.nextSibling);
    }

    // Función para eliminar una fila
    function eliminarFila(event) {
        // Obtener la fila en la que se encuentra el botón
        const filaActual = event.target.closest('tr');

        // Eliminar la fila de la tabla
        tabla.querySelector('tbody').removeChild(filaActual);
    }

    // Agregar el evento onclick al botón "+"
    btnAgregar.onclick = agregarFila;

    var numeroDeFilas = tabla.rows.length;
    for (let index = 0; index < numeroDeFilas; index++) {
        const element = array[index];
    }
</script>
<script>
    /*function mostrarOpcionSeleccionada() {
            var seleccion = document.getElementById("opciones").value;

        }*/

    function mostrarOpcionSeleccionada() {
        var seleccion = document.getElementById("opciones").value;
    }


    function mostrarOpcionSeleccionadaTipoComida() {
        var seleccion = document.getElementById("tipo_comida").value;
    }

    function mostrarOpcionSeleccionadaTipoPreferencia() {
        var seleccion = document.getElementById("tipo_preferencia").value;
    }

    function mostrarOpcionSeleccionadaTiempoComida() {
        var seleccion = document.getElementById("tiempo_comida").value;
    }

    function mostrarOpcionSeleccionadaDificultad() {
        var seleccion = document.getElementById("tiempo_comida").value;
    }
</script>

</script>
<script>
    function buscarTabla() {
        var input, filtro, tabla, tr, td, i, j, encontrado;
        input = document.getElementById("buscarInput");
        filtro = input.value.toUpperCase();
        tabla = document.getElementById("tablaDatos");
        tr = tabla.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            if (i === 0) { // omitir la primera fila de la tabla (cabeceras)
                continue;
            }
            encontrado = false;
            td = tr[i].getElementsByTagName("td");
            for (j = 0; j < td.length; j++) {
                if (td[j].innerHTML.toUpperCase().indexOf(filtro) > -1) {
                    encontrado = true;
                }
            }
            if (encontrado) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
</script>


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