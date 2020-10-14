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
$busqueda_titulo = false;

$array_titulos = [];

Formulario_busqueda();

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

if(!empty($_POST['palabra_clave_busqueda']))
{
    $palabra = strip_tags($_POST['palabra_clave_busqueda']);
    $busqueda_titulo = true;

    if(mysqli_num_rows($query)>0)
    {

        while($receta=mysqli_fetch_array($query))
        {
            if(strpos($receta['titulo'], $palabra) !== false)
                Mostrar($receta);
        }

        echo "</main>";
    }
}


if(mysqli_num_rows($query)>0 && !$busqueda_titulo)
{

    while($receta=mysqli_fetch_array($query))
        Mostrar($receta);
}

echo "</main>";

mysqli_close($db);

include_once "aside.php";
include_once "footer.html";
include_once "end.html";

?>
