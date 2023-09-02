window.onload = function() {
  datos();
};
function datos()
{
  var td = "";
  fetch('http://localhost/EjercicioV/apis/cargarRegistros.php')
  .then(response => {
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      return response.json();
    })
    .then(data => {
      // console.log(data);
      for(var k in data) {
         id = data[k]['idusuario'];
         nombre = data[k]['nombre'];
         apellidos = data[k]['apellidos'];
         correo = data[k]['correo'];
         usuario = data[k]['usuario'];
         contra = btoa(data[k]['contra']);
         estatus= data[k]['estatus'];
         if(estatus == 1)
         {
           estatus="Activo";
         }else {
           estatus = "Inactivo";
         }
         td += "<tr><td>"+id+"</td>"+"<td>"+nombre+" "+apellidos+"</td>" + "<td>"+correo+"</td>" + "<td>"+usuario+"</td>"+"<td>"+contra+"</td>"+"<td>"+estatus+"</td>"+
         "<td><button onclick='editar("+id+")' type='button' id='btnEdit'>Editar</button><button onclick='eliminar("+id+")' type='button' id='btnDel'>Eliminar</button></td></tr>";
      }
      document.getElementById("tableContent").innerHTML = "";
      document.getElementById("tableContent").innerHTML = td;
    })
    .catch(error => {
      console.error('Error fetching data:', error);
    });

}
function editar(id)
{
  fetch('http://localhost/EjercicioV/apis/buscarRegistro.php?id='+id)
  .then(response => {
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      return response.json();
    })
    .then(data => {
       console.log(data);
       iduser = data['idusuario'];
       nombre = data['nombre'];
       apellidos = data['apellidos'];
       correo = data['correo'];
       usuario = data['usuario'];
       contra = data['contra'];
       estatus= data['estatus'];

       document.getElementById('iduser').value = iduser;
       document.getElementById('nombre').value = nombre;
       document.getElementById("apellidos").value = apellidos;
       document.getElementById("correo").value = correo;
       document.getElementById("usuario").value = usuario;
       document.getElementById("contra").value = contra;
       document.getElementById("estatus").value = estatus;

       adduser();
       showbtnEdit();


    })
    .catch(error => {
      console.error('Error fetching data:', error);
    });
}
function eliminar(id)
{
if (confirm("Esta seguro de eliminar el registro #"+id+"?") == true) {
  fetch('http://localhost/EjercicioV/apis/eliminarRegistro.php?id='+id)
  .then(response => {
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      return response.json();
    })
    .then(data => {
       console.log(data);
       if(data == true)
       {
         alert("Registro eliminado correctamente");
         datos();
       }else {
         alert("Hubo un problema al eliminar el registro");
       }

    })
    .catch(error => {
      console.error('Error fetching data:', error);
    });
} else {

}

}
function actualizarRegistro()
{
  iduser = document.getElementById('iduser').value
  nombre = document.getElementById('nombre').value
  apellidos = document.getElementById("apellidos").value;
  correo = document.getElementById("correo").value;
  usuario = document.getElementById("usuario").value;
  contra = document.getElementById("contra").value;
  estatus = document.getElementById("estatus").value;

  if(nombre == "")
  {
    alert("Campo nombre vacio, favor de colocar su nombre");
  }else if(correo == "") {
    alert("Campo correo vacio, favor de colocar su correo electronico");
  }else if(usuario == ""){
    alert("Campo usuario vacio, favor de colocar su nombre de usuario");
  }else if(contra == ""){
    alert("Campo contraseña vacio, favor de colocar su contraseña");
  }else if(estatus == 0){
    alert("Favor de seleccionar el estatus del usuario");
  }else {
  fetch("http://localhost/EjercicioV/apis/actualizarRegistro.php?iduser="+iduser+"&&nombre="+nombre+"&&apellidos="+apellidos+"&&correo="+correo+"&&usuario="+usuario+"&&contra="+contra+"&&estatus="+estatus)
  .then(response => {
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      return response.json();
    })
    .then(data => {
      if(data == true)
      {
        alert("Registro actualizado correctamente");
        limpiar();
        datos();
        showGrid();
        showbtnGuardar();
      }else {
        alert("Hubo un detalle al actualizar los registros");
      }
    })
    .catch(error => {
      console.error('Error fetching data:', error);
    });
  }
}
function registrar()
{
  nombre = document.getElementById('nombre').value
  apellidos = document.getElementById("apellidos").value;
  correo = document.getElementById("correo").value;
  usuario = document.getElementById("usuario").value;
  contra = document.getElementById("contra").value;
  estatus = document.getElementById("estatus").value;

  if(nombre == "")
  {
    alert("Campo nombre vacio, favor de colocar su nombre");
  }else if(correo == "") {
    alert("Campo correo vacio, favor de colocar su correo electronico");
  }else if(usuario == ""){
    alert("Campo usuario vacio, favor de colocar su nombre de usuario");
  }else if(contra == ""){
    alert("Campo contraseña vacio, favor de colocar su contraseña");
  }else if(estatus == 0){
    alert("Favor de seleccionar el estatus del usuario");
  }else {
  fetch('http://localhost/EjercicioV/apis/registrarUsuarios.php?nombre='+nombre+"&&apellidos="+apellidos+"&&correo="+correo+"&&usuario="+usuario+"&&contra="+contra+"&&estatus="+estatus)
  .then(response => {
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      return response.json();
    })
    .then(data => {
       console.log(data);
       if(data == true)
       {
         alert("Usuario registrado con exito");
         limpiar();
         datos();
         showGrid();
       }else {
         alert("Hubo un problema al registrar el usuario");
       }
    })
    .catch(error => {
      console.error('Error fetching data:', error);
    });
}
}
function limpiar()
{
document.getElementById('nombre').value = "";
document.getElementById("apellidos").value = "";
document.getElementById("correo").value = "";
document.getElementById("usuario").value = "";
document.getElementById("contra").value = "";
document.getElementById("estatus").value = "";
}
function adduser()
{
var p = document.getElementById('grid');
p.setAttribute("hidden", true);
var p = document.getElementById('formularioRegistro');
p.removeAttribute("hidden");
}
function showGrid()
{
var x = document.getElementById('grid');
x.removeAttribute("hidden");
var p = document.getElementById('formularioRegistro');
p.setAttribute("hidden", true);
showbtnGuardar();
}
function showbtnEdit()
{
var x = document.getElementById('btnEdit2');
x.removeAttribute("hidden");
var p = document.getElementById('btnAgregar2');
p.setAttribute("hidden", true);
}
function showbtnGuardar()
{
var x = document.getElementById('btnAgregar2');
x.removeAttribute("hidden");
var p = document.getElementById('btnEdit2');
p.setAttribute("hidden", true);
}
