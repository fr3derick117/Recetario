<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "tu_usuario";
$password = "tu_contraseña";
$dbname = "tu_base_de_datos";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el ID de la receta
$receta_id = $_GET['id'];

// Consultar los ingredientes de la receta
$sql = "SELECT ingrediente FROM ingredientes_de_receta WHERE receta_idreceta = $receta_id";
$result = $conn->query($sql);

// Generar las filas de la tabla con los ingredientes
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
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
