//alert ("Hola");


function agregar_usuarios(){
    var usuario = document.getElementById("busqueda_usuarios").value;
    var lista = document.getElementById("lista_usuarios");
    var item = document.createElement("li");
    alert("Se agrega usuario...");
    
    $.ajax({
        method:"POST",
        url: "propios/agregar_grupos.php",
        //JSON
        data: {
          usuario: usuario,
          accion : "agregar_usuario"
        },
        success: function( respuesta ) {
          JSONRespuesta = JSON.parse(respuesta);

          if (JSONRespuesta.estado == 1) {
            item.appendChild(document.createTextNode(usuario));
            lista.appendChild(item);
            toastr.success(JSONRespuesta.mensaje);
          }else{
            toastr.error(JSONRespuesta.mensaje);
          }
        },
    });
    alert(JSONRespuesta);
    console.log(respuesta);
    alert("Respuesta del servidor: "+respuesta);
}

function imprimir_lista(){
    var lista = document.getElementById("lista_usuarios");
    var contenido = lista.innerHTML;
    document.write(contenido);
}