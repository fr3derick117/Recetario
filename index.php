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
  $base_de_datos = 'ingsoft';

  // Conexión a la base de datos
  $conexion = new mysqli($host, $usuario, $contrasena, $base_de_datos);
  if ($conexion->connect_error) {
    die('Error de conexión: ' . $conexion->connect_error);
  }

  //id de receta
  $sql = "SELECT MAX(idreceta) as last_id FROM receta";
  $result = mysqli_query($conexion, $sql);
  // Comprobar si se encontró algún resultado
  if ($result->num_rows > 0) {
    // Obtener el resultado como un arreglo asociativo
    $row = $result->fetch_assoc();
    // Obtener el último ID
    $last_id = $row["last_id"];
    // Imprimir el último ID
  }

  $ConsultaIngredientes = "SELECT * FROM ingredientes;";
  $ResultadoIngredientes = mysqli_query($conexion, $ConsultaIngredientes);

  $ConsultaMedidas = "SELECT * FROM medidas;";
  $ResultadoMedidas = mysqli_query($conexion, $ConsultaMedidas);

  $ConsultaAgregarIngredientesReceta = "INSERT INTO ingredientes_de_receta 
  (receta_idreceta, ingrediente, cantidad, medidas_idmedida) 
  VALUES
  ('".$last_id."', 
  '".$_POST['ingredientes']."',
  '".$_POST['cantidad']."',
  '".$_POST['medida']."');";

  $ResultadoAgregarIngredientes = mysqli_query($conexion, $ConsultaAgregarIngredientesReceta);

  print_r($_POST);
  print_r($last_id);
  print_r($ResultadoAgregarIngredientes);
  print_r($ConsultaAgregarIngredientesReceta);

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
    <script>
    function cambiarImagen() {
      var nombreIngrediente = document.getElementById("ingredientes").value;
      document.getElementById("imagen-ingrediente").src = "img/Ingredientes/" + nombreIngrediente;
    }
    </script>

    <label for="cantidad">Cantidad:</label>
    <input id="cantidad" name="cantidad" type="text" placeholder="Cantidad" >

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

    <input type="submit" value="Subir Receta">
  </form>


</body>
</html>
