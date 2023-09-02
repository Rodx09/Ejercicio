<?php
	class Database{
		private $con;
		private $dbhost="localhost";
		private $dbuser="root";
		private $dbpass="";
		private $dbname="ejerciciov";
		function __construct(){
			$this->connect_db();
		}
		public function connect_db(){
			$this->con = mysqli_connect($this->dbhost, $this->dbuser, $this->dbpass, $this->dbname);
			if(mysqli_connect_error()){
				die("Conexión a la base de datos falló " . mysqli_connect_error() . mysqli_connect_errno());
			}
		}
    public function limpiar($var){
      $return = mysqli_real_escape_string($this->con, $var);
      return $return;
    }
		//login
		public function login($usuario, $contra){
				$sql = "SELECT * FROM usuarios where usuario='$usuario'";
				$res = mysqli_query($this->con, $sql);
				$return = mysqli_fetch_object($res );
				if(mysqli_num_rows($res) > 0)
				{
				$user = $return->usuario;
				$pass = $return->contra;
				$estatus = $return->estatus;
				$nombre = $return->nombre." ".$return->apellidos;
				if($estatus == 2){
					echo "El usuario se encuentra inactivo, favor de revisar con el administrador";
				}else if($usuario == $user && $contra == $pass)
				{
					$_SESSION['valid'] = true;
					$_SESSION['timeout'] = time();
					$_SESSION['nombre'] = $nombre;
					$_SESSION['usuario'] = $usuario;
					header('location: index.php');
				}else {
					echo "Contraseña incorrecta";

				}
			}else {
				echo "Usuario no existe";
			}
			}
		//Agregar registro
    public function guardar($nombre,$apellidos,$usuario,$contra,$correo, $estatus){
	$sql = "INSERT INTO usuarios (idusuario, nombre, apellidos, correo, usuario, contra, estatus) VALUES ('','$nombre', '$apellidos', '$correo', '$usuario', '$contra', $estatus)";

	$res = mysqli_query($this->con, $sql);
	if($res){
	  return true;
	}else{
	return false;
 }
}
//Cargar registros
public function read(){
	$sql = "SELECT * FROM usuarios";
	$res = mysqli_query($this->con, $sql);
	$json = mysqli_fetch_all ($res, MYSQLI_ASSOC);
	// echo "<pre>";
	// print_r($json );
	// die();
	return $json;
}
//Actualizar registro
public function buscarRegistro($id){
		$sql = "SELECT * FROM usuarios where idusuario='$id'";
		$res = mysqli_query($this->con, $sql);
		$return = mysqli_fetch_object($res );
		return $return ;
	}
	public function actualizarU($id,$nombre,$apellidos,$usuario,$contra,$correo, $estatus){
		$sql = "UPDATE usuarios SET nombre='$nombre', apellidos='$apellidos', correo='$correo', usuario='$usuario', contra='$contra', estatus='$estatus' WHERE idusuario= $id";
		$res = mysqli_query($this->con, $sql);
		if($res){
			return true;
		}else{
			return false;
		}
	}
	//Eliminar registros
public function borrarU($id){
$sql = "DELETE FROM usuarios WHERE idusuario=$id";
$res = mysqli_query($this->con, $sql);
if($res){
return true;
}else{
return false;
}
}
}
?>
