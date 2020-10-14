<?php

$ultima1 = "";
$ultima2 = "";
$ultima3 = "";
$numRecetas = 0;

$db = mysqli_connect("localhost", "josemi101920", "UfKhSlgW", "josemi101920");

if(!$db)
{
    echo "<p>Error</p>";
    echo "<p>Código: ".mysqli_connect_errno()."</p>";
    echo "<p>Mensaje: ".mysqli_connect_error()."</p>";
    die("Fin de la ejecución");
}

mysqli_set_charset($db, "utf8");

$query = mysqli_query($db, "SELECT titulo, COUNT(*) FROM recetas GROUP BY titulo ORDER BY COUNT(*) ASC");


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

<aside>
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

?>
