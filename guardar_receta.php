<?php
// Conexión a la base de datos
$servername = "nombre_del_servidor";
$username = "nombre_de_usuario";
$password = "contraseña";
$dbname = "nombre_de_la_base_de_datos";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

// Obtener el contador de instrucciones
$contador = $_POST['contador'];

// Insertar cada instrucción en la base de datos
for ($i = 1; $i <= $contador; $i++) {
    $instruccion = $_POST["instruccion_" . $i];
    
    // Guardar la imagen en el servidor (carpeta "pasos")
    $imagen = $_FILES["imagen_" . $i]["name"];
    $rutaImagen = "pasos/" . $imagen;
    move_uploaded_file($_FILES["imagen_" . $i]["tmp_name"], $rutaImagen);
    
    // Insertar la instrucción en la base de datos
    $sql = "INSERT INTO Instrucciones (receta_id, instruccion, imagen) VALUES (1, '$instruccion', '$rutaImagen')";
    if ($conn->query($sql) === FALSE) {
        echo "Error al guardar la instrucción: " . $conn->error;
    }
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
