<?php
// Conexión a la base de datos
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

// Consultar los ingredientes de la receta
$ConsultaIngredientes = "SELECT recetas_carrito.*, ingredientes_de_receta.*
    FROM recetas_carrito, ingredientes_de_receta
    WHERE ingredientes_de_receta.receta_idreceta = recetas_carrito.id_receta;";
$ResultadoIngredientes = $conexion->query($ConsultaIngredientes);

// Generar las filas de la tabla con los ingredientes
if ($ResultadoIngredientes->num_rows > 0) {
    while ($row = $ResultadoIngredientes->fetch_assoc()) {
        echo "<tr>";
        echo "<td class='shoping__product'>" . $row['ingrediente'] . "</td>";
        echo "<td class='shoping__cart__quantity'>";
        echo "<div class='quantity'>";
        echo "<div class='pro-qty'>";
        echo "<input type='text' value='1'>";
        echo "</div>";
        echo "</div>";
        echo "</td>";
        echo "<td class='shoping__cart__item__close text-center'>";
        echo "<span class='icon_close'></span>";
        echo "</td>";
        echo "</tr>";
    }
}

// Cerrar la conexión
$conn->close();
?>
