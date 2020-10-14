<?php
require_once "init.html";
include_once "header.html";
include_once "navegacion.php";
include_once "conectarBD.php";
require('db_backup.php');

$db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

if (!isset($_POST['restore'])){
    echo <<< HTML

    <div class="celdaTitulo">
				<div class="titPlato"><h2>Restaurar base de datos</h2></div>
		</div>
    <div class="row">
        <form class="form-horizontal" action="restore.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="restore" value="yes">
            <div class="user">
                <label for="sql">Archivo SQL</label>
                <input type="file" id="sql" name="sql" required>
            </div>
            <div class="user">
                    <button type="submit">Subir</button>
            </div>
        </form>
    </div>
HTML;
}
else {
    $fileType = pathinfo($_FILES["sql"]["name"],PATHINFO_EXTENSION);
    $allowed = array('application/sql', 'text/sql', 'text/x-sql', 'text/plain');
    $uploadOk = true;

    if(isset($_POST["submit"])) {
        $check = filesize($_FILES["sql"]["tmp_name"]);
        if($check === false) {
            $uploadOk = false;
        }
    }

    if ($_FILES["sql"]["size"] > 500000) {
        $uploadOk = false;
    }

    if($fileType != "sql" && in_array($_FILES['sql']['type'], $allowed)) {
        $uploadOk = false;
    }

    if ($uploadOk) {
        $content = file_get_contents($_FILES["sql"]["tmp_name"]);

        $db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

        $result = mysqli_multi_query($db, $content);

        mysqli_close($db);

        if ($result !== false){
          echo <<< HTML

          <div class="celdaTitulo">
      				<div class="titPlato"><h2>Restaurar backup BBDD</h2></div>
      		</div>
          <div class="formulario"><p>Se ha restaurado la BBDD correctamente.</p></div>
HTML;
        }
        else{
            echo <<< HTML

            <div class="celdaTitulo">
        				<div class="titPlato"><h2>Restaurar backup BBDD</h2></div>
        		</div>
            <div class="formulario"><p>Error: no se ha podido restaurar la BBDD correctamente.</p></div>
HTML;
        }

        unlink($_FILES["sql"]["tmp_name"]);
    }
    else{
      echo <<< HTML

      <div class="celdaTitulo">
          <div class="titPlato"><h2>Restaurar backup BBDD</h2></div>
      </div>
      <div class="formulario"><p>Error: no se ha podido subir el fichero seleccionado.</p></div>
HTML;
    }
}
?>
