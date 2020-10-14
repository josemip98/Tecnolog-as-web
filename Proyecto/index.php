<?php
include_once "init.html";
include_once "header.html";
include_once "creacionHTML.php";
include_once "login.php";

if (!isset($_SESSION)){
			session_start();
		}

include_once "conectarBD.php";
$db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

if(!$db)
{
    echo "<p>Error</p>";
    echo "<p>Código: ".mysqli_connect_errno()."</p>";
    echo "<p>Mensaje: ".mysqli_connect_error()."</p>";
    die("Fin de la ejecución");
}

mysqli_set_charset($db, "utf8");

if(isset($_POST['login'])){
	$_SESSION['login']=false;

  $query = mysqli_query($db, "SELECT nombre, email, password, tipo, foto FROM usuarios");


  while($salida = mysqli_fetch_row($query)){

    if($salida[1] == $_POST['email'] && $salida[2] == md5($_POST['password']) ) {
      $_SESSION['login']=true;
      $_SESSION['email'] = $_POST['email'];
      $_SESSION['tipo'] = $salida[3];
      $_SESSION['nombre'] = $salida[0];
			$_SESSION['foto'] = $salida[4];
      $_SESSION["usuario"] = strip_tags($_POST["email"]);
      registrarEnLog($db, "Sesion iniciada");
    }
  }
	if($_SESSION['login']==false)
		registrarEnLog($db, "Error inicio sesion");
}

else if(isset($_POST["logout"])){
		registrarEnLog($db, "Sesion cerrada");
    Desloguearse();
  }

if(isset($_SESSION['tipo'])){
	if($_SESSION['tipo'] == "Colaborador")
		include_once "navegacionUsuario.html";
	else {
		include_once "navegacionAdmin.html";
	}
}
else{
	include_once "navegacionInvitado.html";
}

if(isset($_COOKIE["receta"])){
	$titulo = $_COOKIE["receta"];
	$query = mysqli_query($db, "SELECT * FROM recetas WHERE titulo='$titulo'");
	$receta=mysqli_fetch_array($query);
}
else{
	$query = mysqli_query($db, "SELECT * FROM recetas ORDER BY RAND() LIMIT 1");
	$receta=mysqli_fetch_array($query);
	$titulo = $receta["titulo"];
	setcookie("receta", "$titulo", time()+60, "", "", false, false);
}

echo "<main>";

if(isset($_POST['menu']))
    {
        switch ($_POST['menu']) {
						case 'registrarse':
		            Registrarse();
		            break;
        }
    }
		else{
			Mostrar($receta);
			MostrarComentarios($receta);
		}

echo "</main>";

include_once "login.php";

include_once "aside.php";

include_once "footer.html";
include_once "end.html";

?>
