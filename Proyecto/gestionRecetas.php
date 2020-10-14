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

$array_recetas = [];
$aut_nuevo = $_SESSION['nombre'];

echo "<main>";

echo <<< HTML
<div class="contenedor">
		<div class="celdaTitulo">
				<div class="titPlato"><h2>Gestión de recetas</h2></div>
		</div>
				<div class="formulario"><p>Indique la opción a realizar</p>
				<div class="user"><form action="gestion.php" method='POST'>
				  <input type="hidden" name="aut_nuevo" value="{$aut_nuevo}"/>
				  <input type="hidden" name="accion" value="crear"/>
				  <input type="submit" name="crear" value="Añadir nueva"/>
				</form></div>
		    <div class="user"><form action="gestionRecetas.php" method='POST'>
		        <input type="hidden" name="accion" value="listado"/>
		        <input type="submit" name='receta' value="Listado"/>
		    </form></div>
				<div class="user"><form action="gestionRecetas.php" method='POST'>
		        <input type="hidden" name="accion" value="recetasPropias"/>
		        <input type="submit" name='receta' value="Listado recetas propias"/>
		    </form></div>
			</div>
	</div>
HTML;

if(isset($_POST['accion'])){

  switch ($_POST['accion']) {
        case 'listado':
				$query = mysqli_query($db, "SELECT * FROM recetas");

				if(mysqli_num_rows($query)>0)
				{
				    while($receta=mysqli_fetch_array($query)){
								array_push($array_recetas, $receta);
						}
						ListadoRecetas($array_recetas);
				}
            break;
				case 'recetasPropias':
				$query = mysqli_query($db, "SELECT * FROM recetas WHERE autor='$aut_nuevo'");

				if(mysqli_num_rows($query)>0)
				{
					while($receta=mysqli_fetch_array($query)){
					array_push($array_recetas, $receta);
				}
				ListadoRecetasPropias($array_recetas);
				}
				break;
    }
}

if(isset($_POST['accion'])){
	$titulo = strip_tags($_POST['receta']);
	$query = mysqli_query($db, "SELECT * FROM recetas");
	if(mysqli_num_rows($query)>0)
	{

			while($receta=mysqli_fetch_array($query))
			{
				$titulo1 = $receta['titulo'];
					if($titulo1 == $titulo){
						$recetaFinal = $receta;
					}
			}
	}

	if($_POST['accion'] == "visualizar"){
		Mostrar($recetaFinal);
		MostrarComentarios($recetaFinal);
	}
	else if($_POST['accion'] == 'modificar'){
		EditarReceta($recetaFinal);
	}
	else if($_POST['accion'] == 'borrar'){
		EliminarReceta($recetaFinal);
	}
}

echo "</main>";

mysqli_close($db);

include_once "aside.php";
include_once "footer.html";
include_once "end.html";

?>
