<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Listado de usuarios</title>
<link rel="stylesheet" href="css/index.css">
</head>
<?php session_start();
if($_SESSION['usuario'] == "")
{
  header('location: loginV.php');
}
?>
<body>
  <div class="table-title">
      <div class="bienvenida">
        <h2>Bienvenid@: <?php echo $_SESSION['nombre']; ?></h2>
          <div class="container2">
            <button href="logout.php" type="button" id="btnLogout" name="button"><a style="text-decoration: none; color: white" href="logout.php"> Cerrar Sessión</a></button>
          </div>
      </div>
  </div>
    <div class="container3">
        <div id="grid">
          <div class="">
            <button onclick="adduser()" type="button" id="btnAgregar" name="button">Agregar nuevo usuario</button>
          </div>
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Correo Electronico</th>
			                  <th>Usuario</th>
                        <th>Contraseña</th>
                        <th>Estatus</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="tableContent">

                </tbody>
            </table>
        </div>
        <div hidden id="formularioRegistro" class="container">
      <form >
         <div class="form-row">
            <div class="input-data">
               <input disabled  id="iduser" type="text">
               <div class="underline"></div>
            </div>
          </div>
         <div class="form-row">
            <div class="input-data">
               <input id="nombre" type="text" required>
               <div class="underline"></div>
               <label for="">Nombre</label>
            </div>
            <div class="input-data">
               <input id="apellidos" type="text" required>
               <div class="underline"></div>
               <label for="">Apellidos</label>
            </div>
            <div class="input-data">
               <input id="correo" type="email" required>
               <div class="underline"></div>
               <label for="">Correo</label>
            </div>
         </div>
         <div class="form-row">
            <div class="input-data">
               <input id="usuario" type="text" required>
               <div class="underline"></div>
               <label for="">Usuario</label>
            </div>
            <div class="input-data">
               <input id="contra" type="password" required>
               <div class="underline"></div>
               <label for="">Contraseña</label>
            </div>
               <select id="estatus" name="">
                 <option value="0">Seleccione un estatus</option>
                 <option value="1">Activo</option>
                 <option value="2">Inactivo</option>
               </select>

         </div>
      </form>
      <button onclick="registrar()" type="button" id="btnAgregar2" name="button">Guardar</button>
      <button hidden onclick="actualizarRegistro()" id="btnEdit2" type="button" name="button">Actualizar</button>
      <button onclick="showGrid()" type="button" id="btnCan" name="button">Cancelar</button>


    </div>
</body>
<script src="JS/index.js"></script>
</html>
