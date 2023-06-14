<!DOCTYPE html>
<html>
<head>
  <title>Editar Receta</title>
</head>
<body>
  <h1>Editar Receta</h1>

  <?php
  // Configuración de la conexión a la base de datos
  $host = 'localhost';
  $usuario = 'root';
  $contrasena = '';
  $base_de_datos = 'recetas';

  // Conexión a la base de datos
  $conexion = new mysqli($host, $usuario, $contrasena, $base_de_datos);
  if ($conexion->connect_error) {
    die('Error de conexión: ' . $conexion->connect_error);
  }

  // Obtener el ID de la receta a editar
  $idReceta = $_GET['id'];

  // Verificar si se ha enviado el formulario de edición
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ingrediente = $_POST['ingrediente'];
    $cantidad = $_POST['cantidad'];
    $medida = $_POST['medida'];

    // Actualizar los datos en la base de datos
    $query = "UPDATE ingredientes SET ingrediente='$ingrediente', cantidad='$cantidad', medida='$medida' WHERE id='$idReceta'";

    if ($conexion->query($query) === true) {
      echo '<p>Receta actualizada correctamente.</p>';
    } else {
      echo '<p>Error al actualizar la receta: ' . $conexion->error . '</p>';
    }
  }

  // Obtener los datos de la receta a editar
  $queryReceta = "SELECT * FROM ingredientes WHERE id='$idReceta'";
  $resultadoReceta = $conexion->query($queryReceta);

  if ($resultadoReceta->num_rows === 1) {
    $filaReceta = $resultadoReceta->fetch_assoc();

    // Mostrar el formulario de edición
    echo '<form method="POST">';
    echo '<label for="ingrediente">Ingrediente:</label>';
    echo '<input type="text" name="ingrediente" value="' . $filaReceta['ingrediente'] . '" required><br>';

    echo '<label for="cantidad">Cantidad:</label>';
    echo '<input type="number" name="cantidad" value="' . $filaReceta['cantidad'] . '" required><br>';

    echo '<label for="medida">Medida:</label>';
    echo '<input type="text" name="medida" value="' . $filaReceta['medida'] . '" required><br>';

    echo '<input type="submit" value="Guardar">';
    echo '</form>';
  } else {
    echo '<p>No se encontró la receta.</p>';
  }

  $conexion->close();
  ?>

</body>
</html>
