<!DOCTYPE html>
<html>
<head>
  <title>Recetas</title>
</head>
<body>
  <h1>Recetas</h1>

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

  // Obtener todas las recetas de la base de datos
  $queryRecetas = "SELECT * FROM ingredientes";
  $resultadoRecetas = $conexion->query($queryRecetas);

  if ($resultadoRecetas->num_rows > 0) {
    while ($filaReceta = $resultadoRecetas->fetch_assoc()) {
      echo '<div>';
      echo '<img src="' . $filaReceta['foto'] . '" alt="Imagen" style="width: 100px;">';
      echo '<h2>' . $filaReceta['ingrediente'] . '</h2>';
      echo '<p>Cantidad: ' . $filaReceta['cantidad'] . '</p>';
      echo '<p>Medida: ' . $filaReceta['medida'] . '</p>';
      echo '</div>';
    }
  } else {
    echo '<p>No hay recetas disponibles.</p>';
  }

  $conexion->close();
  ?>
</body>
</html>
