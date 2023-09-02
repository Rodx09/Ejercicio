<?php
include ("../BD/database.php");
$clientes= new Database();

$listado=$clientes->read();

echo json_encode($listado);


 ?>
