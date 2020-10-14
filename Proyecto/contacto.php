<?php
include_once "init.html";
include_once "header.html";
include_once "login.php";

if (!isset($_SESSION)){
			session_start();
		}

if(isset($_POST["usuario"]))
{
    if(strip_tags($_POST["usuario"]) == "admin" && strip_tags($_POST["password"]) == "clave")
        $_SESSION["usuario"] = strip_tags($_POST["usuario"]);
}

elseif(isset($_POST["logout"]))
    Desloguearse();

include_once "creacionHTML.php";
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

include_once "navegacion.php";

if(isset($_POST['accion'])){

  switch ($_POST['accion']) {
        case 'confirma':
            ConfirmaComentario();
            break;
        case 'si':
            echo "El comentario ha sido enviado con éxito";
            break;
    }
}
else {
  FormContacto();
}

echo "</main>";

mysqli_close($db);

include_once "aside.php";
include_once "footer.html";
include_once "end.html";

?>
