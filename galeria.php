<!DOCTYPE html>
<html>
<head>
  <title>Galería de Imágenes</title>
  <style>
  .gallery {
    display: flex;
    flex-wrap: wrap;
  }

  .image {
    margin: 10px;
  }
  </style>
</head>
<body>
  <h1>Galería de Imágenes</h1>

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

  // Obtener los registros de la base de datos que contienen las imágenes
  $query = "SELECT * FROM ingredientes";
  $resultado = $conexion->query($query);

  if ($resultado->num_rows > 0) {
    // Mostrar las imágenes en una galería
    echo '<div class="gallery">';

    while ($fila = $resultado->fetch_assoc()) {
      $rutaImagen = $fila['foto'];

      // Mostrar la imagen
      echo '<div class="image">';
      echo '<img src="' . $rutaImagen . '" alt="Imagen">';
      echo '</div>';
    }

    echo '</div>';
  } else {
    echo '<p>No hay imágenes registradas.</p>';
  }

  $conexion->close();
  ?>

</body>
</html>

