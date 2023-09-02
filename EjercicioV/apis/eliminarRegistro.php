<?php
include ("../BD/database.php");
$clientes= new Database();

$id = $_GET['id'];

$listado=$clientes->borrarU($id);
echo json_encode($listado);
 ?>
