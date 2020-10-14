<?php

	if(isset($_SESSION['login'])) {
		if($_SESSION['login'] == true){
			if($_SESSION['tipo'] == "Colaborador")
	  		include_once "navegacionUsuario.html";
			else {
				include_once "navegacionAdmin.html";
			}
		}
	}
	else{
	  include_once "navegacionInvitado.html";
	}

?>
