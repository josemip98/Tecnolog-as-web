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

$array_usuarios = [];

echo "<main>";

echo <<< HTML
<div class="contenedor">
		<div class="celdaTitulo">
				<div class="titPlato"><h2>Gestión de base de datos</h2></div>
		</div>
				<div class="formulario"><p>Indique la opción a realizar</p>
				<div class="user"><form action="gestionBD.php" method='POST'>
		        <input type="hidden" name="accion" value="backup"/>
						<input type="submit" name='bd' value="Backup"/>
		    </form></div>
		   <div class="user"><form action="gestionBD.php" method='POST'>
		        <input type="hidden" name="accion" value="restore"/>
		        <input type="submit" name='bd' value="Restaurar"/>
		    </form></div>
				</div>
	</div>
HTML;

if(isset($_POST['accion'])){

  switch ($_POST['accion']) {
        case 'backup':
				 include_once "backup.php";
        break;
				case 'restore':
					include_once "restore.php";
				break;
    }
}

echo "</main>";

mysqli_close($db);

include_once "aside.php";
include_once "footer.html";
include_once "end.html";

?>
