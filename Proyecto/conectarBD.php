<?php

	DEFINE('DB_HOST','localhost');
	DEFINE('DB_USER','josemi101920');
	DEFINE('DB_PASSWORD','UfKhSlgW');
	DEFINE('DB_DATABASE','josemi101920');


	$db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

	if(!$db)
	{
	    echo "<p>Error al conectarse a la base de datos</p>";
	    echo "<p>Código: ".mysqli_connect_errno()."</p>";
	    echo "<p>Mensaje: ".mysqli_connect_error()."</p>";
	    die("Fin de la ejecución");
	}

	mysqli_set_charset($db, "utf8");

?>
