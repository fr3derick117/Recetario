<?php
// Obtener el valor de recetaId enviado por AJAX
$recetaId = $_POST['recetaId'];

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

$idUsuario = $_SESSION['id_usuario'];

// Preparar y ejecutar la consulta de inserción en la tabla carrito_receta
$stmt = $conn->prepare("INSERT INTO recetas_carrito (id_usuario, id_receta) VALUES (?, ?)");
$stmt->bind_param("ii", $idUsuario, $idReceta);
if ($stmt->execute()) {
    echo "Receta agregada al carrito con éxito";
} else {
    echo "Error al agregar la receta al carrito: " . $stmt->error;
}

// Cerrar la conexión y liberar recursos
$stmt->close();
$conn->close();

?>
