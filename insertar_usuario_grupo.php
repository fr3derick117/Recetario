<?php
//Establecer la conexion a la base de datos
$conexion = mysqli_connect('localhost', 'root', '', 'ingsoft');

//Verificar que se pudo conectar a la base de datos
if (!$conexion) {
    die("Error al conectarse a la base de datos: " . mysqli_connect_error());
}

// Obtiene el valor enviado por la petición AJAX
$usuarioSeleccionado = $_POST['usuarioSeleccionado'];

// Realiza la consulta de inserción en la tabla 'usuarios_grupos'
$sql = "INSERT INTO usuarios_grupos (id_usuario, id_grupo) VALUES ('$usuarioSeleccionado', 'id_del_grupo_aquí')";

if ($conexion->query($sql) === TRUE) {
  echo 'Usuario agregado al grupo exitosamente';
} else {
  echo 'Error al agregar el usuario al grupo: ' . $conexion->error;
}

$conexion->close();
?>
