
function buscarTabla() {
  var input, filtro, tabla, tr, td, i, j, encontrado;
  input = document.getElementById("buscarInput");
  filtro = input.value.toUpperCase();
  tabla = document.getElementById("tablaDatos");
  tr = tabla.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    encontrado = false;
    td = tr[i].getElementsByTagName("td");
    for (j = 0; j < td.length; j++) {
      if (td[j].innerHTML.toUpperCase().indexOf(filtro) > -1) {
        encontrado = true;
      }
    }
    if (encontrado) {
      tr[i].style.display = "";
    } else {
      tr[i].style.display = "none";
    }
  }
}
