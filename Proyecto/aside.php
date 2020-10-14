<?php
include_once "init.html";
include_once "header.html";
include_once "creacionHTML.php";
include_once "login.php";

$ultima1 = "";
$ultima2 = "";
$ultima3 = "";
$numRecetas = 0;

echo <<< HTML
<aside>
HTML;

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

  if(isset($_SESSION['usuario']))
{
		$email_mod = $_SESSION['email'];
    $foto = base64_encode($_SESSION['foto']);

    echo <<< HTML
    <div class="formulario">
        <h2>{$_SESSION["nombre"]}</h2>
				<p>{$_SESSION["tipo"]}</p>
        <img src='data:img/jpg;base64,$foto' width="150" height="150"/>
				<div class="user"><form action="gestion.php" method='POST'>
						<input type="hidden" name="email_modificar" value="{$email_mod}"/>
            <input type="hidden" name="usuario" value="modificarUsuario"/>
            <input type="submit" name="editarUsuario" value="Editar perfil"/>
        </form></div>
        <div class="user"><form action="index.php" method='POST'>
          <input type="hidden" name="logout" value="Logout"/>
          <input type="submit" name="Cerrar" value="Cerrar sesión"/>
        </form></div>
      </div>
HTML;
}

else if(isset($_POST['ident']))
  {
      switch ($_POST['ident']) {
          case 'identificarse':
              Loguearse();
              break;
      }
  }
else{
      Identificarse();
  }

$query = mysqli_query($db, "SELECT titulo FROM recetas ORDER BY id DESC");


if(!empty($query) && mysqli_num_rows($query)>0)
{
    $data = "";

    while($ultima3 == "")
    {
        $data = mysqli_fetch_array($query);

        if($ultima1 == "")
            $ultima1 = $data['titulo'];

        elseif($ultima2 == "" && $data['titulo'] != $ultima1){
          if(mysqli_num_rows($query)>1){
            $ultima2 = $data['titulo'];
          }
          else {
            $ultima2 = "-";
          }
        }

        elseif($ultima3 == "" && $data['titulo'] != $ultima1 && $data['titulo'] != $ultima2)
        if(mysqli_num_rows($query)>2){
            $ultima3 = $data['titulo'];
        }
        else{
          $ultima3 = "-";
        }
    }
}


if($query)
{

  $numRecetas=mysqli_num_rows($query);

}

mysqli_close($db);

echo <<< HTML

  <div class="valoradas">
    <div class="titValoradas">
      <h2>Últimas recetas añadidas</h2>
    </div>
    <ol>
      <li>$ultima1</li>
      <li>$ultima2</li>
      <li>$ultima3</li>
    </ol>
  </div>

  <div class="numrecetas">
    <div class="titRecetas">
      <h2>Número recetas</h2>
    </div>
    <p>El sitio contiene $numRecetas recetas diferentes</p>
  </div>
</aside>

HTML;

include_once "footer.html";
include_once "end.html";

?>
