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

$busqueda_titulo = false;
$busqueda_receta = false;
$busqueda_categoria = false;

$array_recetas = [];

echo "<main>";

Formulario_busqueda();

if(isset($_POST['recetasPagina']))
$recetasPagina = $_POST['recetasPagina'];
else {
	$recetasPagina = 5;
}

if(isset($_POST['orden'])){

  switch ($_POST['orden']) {
        case 'ascendente':
            $query = mysqli_query($db, "SELECT * FROM recetas ORDER BY titulo ASC");
            break;
        case 'descendente':
            $query = mysqli_query($db, "SELECT * FROM recetas ORDER BY titulo DESC");
            break;
    }
}

else {
  $query = mysqli_query($db, "SELECT * FROM recetas");
}

if(!empty($_POST['palabra_clave_busqueda_titulo']))
{
    $palabra = strip_tags($_POST['palabra_clave_busqueda_titulo']);
    $busqueda_titulo = true;

    if(mysqli_num_rows($query)>0)
    {
        while($receta=mysqli_fetch_array($query))
        {
            if(strpos($receta['titulo'], $palabra) !== false)
							array_push($array_recetas, $receta);
        }
    }
}

if(!empty($_POST['palabra_clave_busqueda_categoria']))
{
    $palabra = strip_tags($_POST['palabra_clave_busqueda_categoria']);
    $busqueda_categoria = true;

    if(mysqli_num_rows($query)>0)
    {
        while($receta=mysqli_fetch_array($query))
        {
            if(strpos($receta['categoria'], $palabra) !== false)
							array_push($array_recetas, $receta);
        }
    }
}

else if(!empty($_POST['palabra_clave_busqueda_receta']))
{
    $palabra = strip_tags($_POST['palabra_clave_busqueda_receta']);
    $busqueda_receta = true;

    if(mysqli_num_rows($query)>0)
    {
        while($receta=mysqli_fetch_array($query))
        {
            if(strpos($receta['titulo'], $palabra) == true)
							array_push($array_recetas, $receta['titulo']);
						else if(strpos($receta['autor'], $palabra) == true)
							array_push($array_recetas, $receta);
						else if(strpos($receta['categoria'], $palabra) == true)
							array_push($array_recetas, $receta);
						else if(strpos($receta['descripcion'], $palabra) == true)
							array_push($array_recetas, $receta);
						else if(strpos($receta['ingredientes'], $palabra) == true)
							array_push($array_recetas, $receta);
						else if(strpos($receta['preparacion'], $palabra) == true)
							array_push($array_recetas, $receta);
        }
    }
}


if(mysqli_num_rows($query)>0 && !$busqueda_titulo && !$busqueda_receta && !$busqueda_categoria)
{
    while($receta=mysqli_fetch_array($query)){
				array_push($array_recetas, $receta);
		}
}

/*
<script>

function getRecetas() {
  var obj;
	obj = new XMLHttpRequest();
  obj.open("GET","busqueda.php?page=1");
  obj.onreadystatechange = function() {
    if(obj.readyState===4 && obj.status===200) {
      echo "hola";
      }
    else{
			echo "error";
		}
  }
  obj.send();
Orden de visualización:
Ascendente: Descendente:
De más a menos comentadas: De más a menos puntuación:
Recetas por página:
}

</script>

getRecetas();*/

$totalRecetas = count($array_recetas);

if(isset($_POST['orden2'])){

  switch ($_POST['orden2']) {
        case 'masComentarios':
				for ($i=0; $i<$totalRecetas-1; $i++)
				{
					for ($j=$i+1; $j<$totalRecetas; $j++)
					{
						$comentariosI = obtenerComentarios($array_recetas[$i]['titulo']);
						$comentariosJ = obtenerComentarios($array_recetas[$j]['titulo']);
						if($comentariosJ>$comentariosI)
						{
						 $aux = $array_recetas[$j];
						 $array_recetas[$j] = $array_recetas[$i];
						 $array_recetas[$i] = $aux;
						}
					}
				}
            break;
        case 'masPuntuacion':
				for ($i=0; $i<$totalRecetas-1; $i++)
				{
					for ($j=$i+1; $j<$totalRecetas; $j++)
					{
						$valoracionI = obtenerValoracion($array_recetas[$i]['titulo']);
						$valoracionJ = obtenerValoracion($array_recetas[$j]['titulo']);
						if($valoracionJ>$valoracionI)
						{
						 $aux = $array_recetas[$j];
						 $array_recetas[$j] = $array_recetas[$i];
						 $array_recetas[$i] = $aux;
						}
					}
				}
            break;
    }
}

$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

if ((false !== strpos($url,'page')) || (isset($_POST['busqueda']))) {

echo '<h3>Numero total de recetas: '.$totalRecetas.'</h3>';

if(mysqli_num_rows($query) > 0) {
    $page = false;

    //examino la pagina a mostrar y el inicio del registro a mostrar
    if (isset($_GET["page"])) {
        $page = $_GET["page"];
    }

    if (!$page) {
        $start = 0;
        $page = 1;
    } else {
        $start = ($page - 1) * $recetasPagina;
    }

    //calculo el total de paginas
    $total_pages = ceil(count($array_recetas) / $recetasPagina);

		$array_recetas_actual = [];

		for($i=$start;$i<$recetasPagina*$page&&$i<count($array_recetas);$i++){
			array_push($array_recetas_actual, $array_recetas[$i]);
		}

		ListadoRecetas($array_recetas_actual);

    if ($total_pages > 1) {
        if ($page != 1) {
            echo '<a class="pagination" href="busqueda.php?page='.($page-1).'"><span aria-hidden="true">&laquo;</span></a>';
        }

        for ($i=1;$i<=$total_pages;$i++) {
            if ($page == $i) {
                echo '<a class="pagination" href="#">'.$page.'</a>';
            } else {
                echo '<a class="pagination" href="busqueda.php?page='.$i.'">'.$i.'</a>';
            }
        }

        if ($page != $total_pages) {
            echo '<a class="pagination" href="busqueda.php?page='.($page+1).'"><span aria-hidden="true">&raquo;</span></a>';
        }
				echo '<h3>Mostrando la pagina '.$page.' de '.$total_pages.'</h3>';
    }
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
