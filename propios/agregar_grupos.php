<?php

//Establecer la conexion a la base de datos
$conexion = mysqli_connect('localhost', 'root', '', 'ingsoft');

//Verificar que se pudo conectar a la base de datos
if (!$conexion) {
    die("Error al conectarse a la base de datos: " . mysqli_connect_error());
}

$Respuesta = array();
$accion = $_POST['accion'];
$last_id = 0;
print_r($accion);

$MaxID = "SELECT MAX(idgrupo) as last_id FROM grupos";
$ConsultaMaxID = mysqli_query($conexion, $MaxID);
if ($ConsultaMaxID -> num_rows > 0) {
    $row = $ConsultaMaxID -> fetch_assoc();
    // Obtener el último ID
    $last_id = $row["last_id"] + 1;
} 

switch ($accion) {
    case 'agregar_usuario':
        agregarUsuarios($conexion);
        break;
 
    default:
        # code...
        break;
}


function agregarUsuarios($conexion){
    $usuario=$_POST['usuario'];
    //Consulta para crear una Categoria o rubro (MYSQL)
    //Generar consulta para agregar
    $ConsultaUsuarios = "SELECT * FROM usuario WHERE nombre_usuario = '".$_SESSION['usuario']."'";
    $ResultadoUsuarios = mysqli_query($conexion, $ConsultaUsuarios);
    $row = mysqli_fetch_assoc($ResultadoUsuarios);
    $id_usuario = $row['id_usuario'];

    $ConsultaAgregarIntegrante = "INSERT INTO usuarios_grupos (id_usuario, id_grupo) 
        VALUES
        ('".$id_usuario."', 
        '".$last_id."');";

    $ResultadoAgregarIntegrante = mysqli_query($conexion, $ConsultaAgregarIntegrante);
    if (mysqli_query($conexion, $ResultadoAgregarIntegrante)) {
        $Respuesta['estado']=1; 
        $Respuesta['mensaje']="Se agregó el usuario correctamente"; 
        $Respuesta['id'] = mysqli_insert_id($conexion); 
    }else {
        $Respuesta['estado']=0; 
        $Respuesta['mensaje']="No se pudo agregar el usuario"; 
        $Respuesta['id'] = 0; 
    }
    print_r($Respuesta);
    echo json_encode($Respuesta);
    mysqli_close($conexion);
}

?>