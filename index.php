<!DOCTYPE html>
<html>
<head>
  <title>Subir Receta</title>
</head>
<body>
  <h1>Subir Receta</h1>

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
        echo '<script>window.location.href = "index.php";</script>';
      } else {
        echo '<p>Error al subir la receta: ' . $conexion->error . '</p>';
      }
    }
  }
  ?>


  <form method="POST" enctype="multipart/form-data">
    <label for="ingrediente">Ingrediente:</label>
    <input type="text" name="ingrediente" required><br>

    <label for="cantidad">Cantidad:</label>
    <input type="number" name="cantidad" required><br>

    <label for="medida">Medida:</label>
    <input type="text" name="medida" required><br>

    <label for="foto">Foto:</label>
    <input type="file" name="foto" accept="image/*" required><br>

    <input type="submit" value="Subir Receta">
  </form>

  <?php
  // Obtener todas las recetas de la base de datos
  $queryRecetas = "SELECT * FROM ingredientes";
  $resultadoRecetas = $conexion->query($queryRecetas);

  if ($resultadoRecetas->num_rows > 0) {
    echo '<h2>Recetas agregadas:</h2>';
    echo '<table>';
    echo '<tr><th>Foto</th><th>Ingrediente</th><th>Cantidad</th><th>Medida</th><th>Eliminar</th></tr>';

    while ($filaReceta = $resultadoRecetas->fetch_assoc()) {
      echo '<tr>';
      echo '<td><img src="' . $filaReceta['foto'] . '" alt="Imagen" style="width: 100px;"></td>';
      echo '<td>' . $filaReceta['ingrediente'] . '</td>';
      echo '<td>' . $filaReceta['cantidad'] . '</td>';
      echo '<td>' . $filaReceta['medida'] . '</td>';
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
    $queryEliminar = "DELETE FROM ingredientes WHERE id='$idReceta'";

    if ($conexion->query($queryEliminar) === true) {
      echo '<p>Receta eliminada correctamente.</p>';
      // Actualizar la página para reflejar los cambios
      echo '<script>window.location.href = "index.php";</script>';
    } else {
      echo '<p>Error al eliminar la receta: ' . $conexion->error . '</p>';
    }
  }

  $conexion->close();
  ?>
</body>
</html>
