<?php
include ("../BD/database.php");
$clientes= new Database();

$nombre = $_GET['nombre'];
$apellidos = $_GET['apellidos'];
$correo = $_GET['correo'];
$usuario = $_GET['usuario'];
$contra = $_GET['contra'];
$estatus = $_GET['estatus'];

$listado=$clientes->guardar($nombre,$apellidos,$usuario,$contra,$correo, $estatus);

echo json_encode($listado);


 ?>
