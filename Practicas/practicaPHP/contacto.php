<?php
include_once "init.html";
include_once "header.html";

session_start();

if(isset($_POST["usuario"]))
{
    if(strip_tags($_POST["usuario"]) == "admin" && strip_tags($_POST["password"]) == "clave")
        $_SESSION["usuario"] = strip_tags($_POST["usuario"]);
}

elseif(isset($_POST["logout"]))
    Desloguearse();

if(isset($_SESSION["usuario"]))
  include_once "navegacionUsuario.php";

else
  include_once "navegacionInvitado.php";

include_once "creacionHTML.php";

$db = mysqli_connect("localhost", "josemi101920", "UfKhSlgW", "josemi101920");

if(!$db)
{
    echo "<p>Error</p>";
    echo "<p>Código: ".mysqli_connect_errno()."</p>";
    echo "<p>Mensaje: ".mysqli_connect_error()."</p>";
    die("Fin de la ejecución");
}

mysqli_set_charset($db, "utf8");

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
