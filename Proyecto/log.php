<?php
include_once "init.html";
include_once "header.html";
include_once "login.php";

if (!isset($_SESSION)){
			session_start();
		}

include_once "creacionHTML.php";
include_once "conectarBD.php";

$db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

if(!$db)
{
		echo "<p>Error al conectarse a la base de datos</p>";
		echo "<p>Código: ".mysqli_connect_errno()."</p>";
		echo "<p>Mensaje: ".mysqli_connect_error()."</p>";
		die("Fin de la ejecución");
}

mysqli_set_charset($db, "utf8");

include_once "navegacion.php";

echo "<main>";

echo <<< HTML
<div class="contenedor">
		<div class="celdaTitulo">
				<div class="titPlato"><h2>Log del sistema</h2></div>
		</div>
	</div>
HTML;

	class Log{

		function __construct($id, $fecha, $usuario, $descripcion){
			$this->id = $id;
			$this->fecha = $fecha;
      $this->usuario = $usuario;
			$this->descripcion = $descripcion;
		}

		function getId(){
			return $this->id;
		}

		function getFecha(){
			return $this->fecha;
		}

    function getUsuario(){
			return $this->usuario;
		}

		function getDescripcion(){
			return $this->descripcion;
		}

	}

		function getLog($db){
			$log = null;

			$query = mysqli_query($db, "SELECT * FROM log ORDER by fecha DESC");

			while($output = mysqli_fetch_row($query)){
				$log[] = new Log($output[0],$output[1],$output[2],$output[3]);
			}

			return $log;
		}

		$log = getLog($db);

  	foreach ($log as $i) {

		echo'
			<div class="formulario">
				<p>Fecha: '.$i->getFecha().'</p>
        <p>Usuario: '.$i->getUsuario().'</p>
				<p>Descripción: '.$i->getDescripcion().'</p>
			</div>
		';
	}
	echo "</main>";

	include_once "login.php";

	include_once "aside.php";

	include_once "footer.html";
	include_once "end.html";

?>
