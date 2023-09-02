<?php
include ("../BD/database.php");
$clientes= new Database();

$id = $_GET['id'];


$listado=$clientes->buscarRegistro($id);

echo json_encode($listado);


 ?>
