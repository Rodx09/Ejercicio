<?php
include ("../BD/database.php");
$clientes= new Database();

$id = $_GET['iduser'];
$nombre = $_GET['nombre'];
$apellidos = $_GET['apellidos'];
$correo = $_GET['correo'];
$usuario = $_GET['usuario'];
$contra = $_GET['contra'];
$estatus = $_GET['estatus'];

$listado=$clientes->actualizarU($id,$nombre,$apellidos,$usuario,$contra,$correo, $estatus);

echo json_encode($listado);


 ?>
