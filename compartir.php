<?php
// Obtener los valores enviados desde el formulario
$id_grupo = $_POST['id_grupo'];
$id_receta = $_POST['id_receta'];

// Aquí puedes realizar las operaciones necesarias para agregar los valores a la tabla "grupos_recetas"
// Por ejemplo, puedes ejecutar una consulta SQL para insertar los valores en la tabla
// Asegúrate de tener una conexión válida a tu base de datos

// Ejemplo de consulta SQL (debes adaptarlo según tu estructura de tabla)
$sql = "INSERT INTO grupos_recetas (id_grupo, id_recetas) VALUES ($id_grupo, $id_receta)";

// Ejecutar la consulta (aquí asumimos que ya tienes una conexión establecida)
$resultado = mysqli_query($conexion, $sql);

// Verificar si la consulta se ejecutó correctamente
if ($resultado) {
  echo "Receta compartida exitosamente";
} else {
  echo "Error al compartir la receta: " . mysqli_error($conexion);
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>
