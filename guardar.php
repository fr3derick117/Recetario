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

// Procesar el formulario de agregar ingrediente
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $foto = $_FILES['foto']['name'];
  $ruta_temporal = $_FILES['foto']['tmp_name'];
  $ingrediente = $_POST['ingrediente'];
  $cantidad = $_POST['cantidad'];
  $medida = $_POST['medida'];

  // Mover la foto a una ubicación permanente en el servidor
  $ruta_destino = 'fotos/' . $foto;
  move_uploaded_file($ruta_temporal, $ruta_destino);

  // Insertar el nuevo ingrediente en la base de datos
  $query = "INSERT INTO ingredientes (foto, ingrediente, cantidad, medida) VALUES ('$ruta_destino', '$ingrediente', $cantidad, '$medida')";
  if ($conexion->query($query) === TRUE) {
    echo '<p>Ingrediente agregado exitosamente.</p>';
  } else {
    echo '<p>Error al agregar el ingrediente: ' . $conexion->error . '</p>';
  }
}

$conexion->close();
header('Location: index.php'); // Redirigir a index.php después de guardar
exit;
?>
