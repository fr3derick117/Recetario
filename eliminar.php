<?php
// Configuración de la conexión a la base de datos
$host = 'tu_host';
$usuario = 'tu_usuario';
$contrasena = 'tu_contrasena';
$base_de_datos = 'tu_base_de_datos';

// Conexión a la base de datos
$conexion = new mysqli($host, $usuario, $contrasena, $base_de_datos);
if ($conexion->connect_error) {
  die('Error de conexión: ' . $conexion->connect_error);
}

// Obtener el ID del ingrediente a eliminar
$id = $_GET['id'];

// Eliminar el ingrediente de la base de datos
$query = "DELETE FROM ingredientes WHERE id = $id";
if ($conexion->query($query) === TRUE) {
  echo '<p>Ingrediente eliminado exitosamente.</p>';
} else {
  echo '<p>Error al eliminar el ingrediente: ' . $conexion->error . '</p>';
}

$conexion->close();
header('Location: index.php'); // Redirigir a index.php después de eliminar
exit;
?>
