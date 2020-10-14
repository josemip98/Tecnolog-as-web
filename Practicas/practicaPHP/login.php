<?php
include_once "creacionHTML.php";

session_start();

if(isset($_POST["usuario"]))
{
    if(strip_tags($_POST["usuario"]) == "admin" && strip_tags($_POST["password"]) == "clave")
        $_SESSION["usuario"] = strip_tags($_POST["usuario"]);
}

elseif(isset($_POST["logout"]))
    Desloguearse();

include_once "init.html";
include_once "header.html";

if(isset($_SESSION["usuario"]))
{

  include_once "navegacionUsuario.php";

    echo <<< HTML
    <main class="formulario">
        <h2>Bienvenido {$_SESSION["usuario"]}, ¿qué necesitas?</h2>
        <form action="gestion.php" method='POST'>
            <input type="hidden" name="accion" value="crear"/>
            <input type="submit" name="crear" value="Añadir receta"/>
        </form>
        <form action="gestion.php" method='POST'>
            <input type="hidden" name="accion" value="modificar"/>
            <input type="submit" name="modificar" value="Modificar receta"/>
        </form>
        <form action="gestion.php" method='POST'>
            <input type="hidden" name="accion" value="borrar"/>
            <input type="submit" name="borrar" value="Eliminar receta"/>
        </form>
        <form action="index.php" method='POST'>
            <input type="submit" name="logout" value="Logout"/>
        </form>
      </div>
HTML;
}

else{
    include_once "navegacionInvitado.php";
    Identificarse();
  }

if(isset($_SESSION["identificacion"])){
  Loguearse();
}
else if(isset($_SESSION["registro"])){
  Registro();
}

echo "</main>";

function Identificarse()
{
    echo <<< HTML

    <main class="login">
      <div class="titLogin">
        <h2>Login</h2>
      </div>
        <form action="login.php" method='POST' enctype='multipart/form-data'>
            <label>Identificación<input type="text" name="usuario"></label>
            <input type="submit" name="identificacion" value="Identificacion">
            <label>Registrarse<input type="password" name="password"></label>
            <input type="submit" name="registro" value="Registro">
        </form>
      </div>
HTML;
}

function Loguearse()
{
    echo <<< HTML

    <main class="login">
      <div class="titLogin">
        <h2>Login</h2>
      </div>
        <form action="login.php" method='POST' enctype='multipart/form-data'>
            <label>Usuario<input type="text" name="usuario"></label>
            <label>Contraseña<input type="password" name="password"></label>
            <input type="submit" name="login" value="Login">
        </form>
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

function Registro()
{
    echo <<< HTML
        <div class="formulario"><form action="gestion.php" method="POST" enctype="multipart/form-data">
            <h2>Introduce los datos del nuevo usuario</h2>
            <label>Foto<input type="file" name="foto_nueva" accept="img/png, img/jpeg"/></label>
            <label>Nombre<input type="text" name="nom_nuevo"/></label>
            <label>Apellidos<input type="text" name="ape_nuevo"/></label>
            <label>Email<input type="text" name="email_nuevo"/></label>
            <label>Clave<input type="password" name="clave_nuevo"/></label>
            <label>Dirección<input type="text" name="dir_nuevo"/></label>
            <label>Teléfono<input type="text" name="tel_nuevo"/></label>
            <label>Rol</label>
            <select name="rol_nuevo">
               <option value="1">Colaborador</option>
               <option value="2">Administrador</option> 
            </select>
            <label>Estado</label>
            <select name="est_nuevo">
               <option value="1">Activo</option>
               <option value="2">Inactivo</option>
            </select>
            <input type="hidden" name="accion" value="confirmar"/>
            <input type="submit" name='nuevo' value="Añadir"/>
        </form></div>
HTML;
}

include_once "aside.php";
include_once "footer.html";
include_once "end.html"

?>
