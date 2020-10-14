<?php

include_once "conectarBD.php";
include_once "db_backup.php";

if (isset($_POST['download'])) {
	$db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
	if ($db) {
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename="backup.sql"');
		echo DB_backup($db);
		mysqli_close($db);
	}
} else {
	echo <<< HTML
	<div class="contenedor">
			<div class="celdaTitulo">
					<div class="titPlato"><h2>Copia de seguridad - Backup</h2></div>
			</div>
			<div class="formulario">
			<form action="backup.php" method='POST'>
					<input type="hidden" name="download" value="download"/>
					<br><input class="user" type="submit" name="Backup" value="Realizar copia de seguridad"/>
			</form>
			<br>
		</div>
HTML;
}

?>
