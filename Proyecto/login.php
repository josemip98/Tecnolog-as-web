<?php

include_once "conectarBD.php";

function Identificarse()
{
    echo <<< HTML
      <div class="login">
        <div class="titLogin">
          <h2>Login</h2>
        </div>
        <div class="user"><form action="index.php" method='POST'>
            <input type="hidden" name="ident" value="identificarse"/>
            <input type="submit" name="identificacion" value="Identificarse"/><br>
        </form>
        </div>
        <div class="pass"><form action="index.php" method='POST'>
            <input type="hidden" name="menu" value="registrarse"/>
            <input type="submit" name="identificacion" value="Registrarse"/><br>
        </form>
        </div>
      </div>
HTML;
}

function Loguearse()
{
    echo <<< HTML
      <div class="login">
        <div class="titLogin">
          <h2>Login</h2>
        </div>
          <form action="index.php" method='POST' enctype='multipart/form-data'>
              <div class="user"><label>Email<br><input type="text" name="email"></label></div>
              <div class="pass"><label>Contraseña<br><input type="password" name="password"></label></div>
              <div class="pass"><input type="submit" name="login" value="Login"></div>
          </form>
      </div>
HTML;
}

function Registrarse()
{
    echo <<< HTML
        <div class="contenedor">
          <div class="celdaTitulo">
      				<div class="titPlato"><h2>Registro nuevo usuario</h2></div>
      		</div>
      				<div class="formulario"><p>Introduce los datos del nuevo usuario</p>
              <form action="gestion.php" method="POST" method="get" onsubmit="return validarComponente()">
              <label>Nombre<input id="nom_nuevo" type="text" name="nom_nuevo"/></label>
              <label>Apellidos<input id="ape_nuevo" type="text" name="ape_nuevo"/></label>
              <label>Email<input id="ema_nuevo" type="text" name="ema_nuevo"/></label>
              <label>Clave<input id="pas_nuevo1" type="password" name="pas_nuevo1"/></label>
              <label><input id="pas_nuevo2" type="password" name="pas_nuevo2"/></label>
              <label>Dirección<input id="dir_nuevo" type="text" name="dir_nuevo"/></label>
              <label>Teléfono<input id="tel_nuevo" type="text" name="tel_nuevo"/></label>
              <label>Tipo</label>
              <select id="tip_nuevo" name="tip_nuevo">
                 <option value="Colaborador">Colaborador</option>
              </select>
              <label>Estado</label>
              <select id="est_nuevo" name="est_nuevo">
                 <option value="false">Sin verificar</option>
              </select>
              <input type="hidden" name="usuario" value="confirmarUsuario"/>
              <input type="submit" name='nuevo' value="Crear usuario"/>
              </form>
            </div>
      </div>

HTML;
}

function Desloguearse()
{
    if(session_status() == PHP_SESSION_NONE)
        session_start();

    session_unset();

    $data = session_get_cookie_params();

    setcookie(session_name(), $_COOKIE[session_name()], time()-2592000, $data['path'],
             $data['domain'], $data['secure'], $data['httponly']);

    session_destroy();
}

function registrarEnLog($db, $accion){

		if(isset($_SESSION['email'])){
			$usuario = $_SESSION['email'];
		}else{
			$usuario = "Invitado";
		}

		mysqli_query($db, "INSERT INTO log VALUES (DEFAULT, NOW(), '$usuario', '$accion')") or die('Error log' .mysqli_error($db));;

	}

?>
