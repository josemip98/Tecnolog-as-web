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

include_once "creacionHTML.php";
include_once "conectarBD";

$db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

if(!$db)
{
    echo "<p>Error</p>";
    echo "<p>Código: ".mysqli_connect_errno()."</p>";
    echo "<p>Mensaje: ".mysqli_connect_error()."</p>";
    die("Fin de la ejecución");
}

mysqli_set_charset($db, "utf8");

echo <<< HTML
<main>
<div class="formulario">
    <h2>Bienvenido {$_SESSION["usuario"]}, ¿qué necesitas?</h2>
    <form action="gestion.php" method='POST'>
        <input type="hidden" name="accion" value="crear"/>
        <input type="submit" name="crear" value="Añadir receta"/>
    </form>
    <form action="index.php" method='POST'>
        <input type="submit" name="logout" value="Logout"/>
    </form>
  </div>
HTML;

echo "</main>";
echo "<aside>";

mysqli_close($db);

include_once "aside.php";
include_once "footer.html";
include_once "end.html";

?>
