<?php
include_once "init.html";
include_once "header.html";
include_once "login.php";
include_once "enviarEmail.php";

if (!isset($_SESSION)){
			session_start();
		}

include_once "creacionHTML.php";
include_once "conectarBD.php";

$db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

if(!$db)
{
		echo "<p>Error al conectarse a la base de datos</p>";
		echo "<p>Código: ".mysqli_connect_errno()."</p>";
		echo "<p>Mensaje: ".mysqli_connect_error()."</p>";
		die("Fin de la ejecución");
}

mysqli_set_charset($db, "utf8");

include_once "navegacion.php";

    if(isset($_POST['accion']))
    {
        switch ($_POST['accion']) {
            case 'confirmar':
                ConfirmaReceta();
                break;
            case 'crear':
                InsertarReceta();
                break;
						case 'confirmarModificar':
		            ConfirmaModificarReceta();
		            break;
            case 'modificar':
                ModificarReceta($db);
                break;
            case 'enviar':
                if(isset($_POST['tit_mod']))
                    DatosAModificar($db);
                break;
            case 'borrar':
                BorrarReceta();
                break;
            case 'modificarUsuario':
                busquedaUsuario();
                break;
            case 'comentario':
                InsertarComentario();
                break;
						case 'borrarComentario':
								EliminarComentario();
							break;
        }
    }

    if(isset($_POST['usuario']))
    {
        switch ($_POST['usuario']) {
            case 'confirmarUsuario':
                confirmaUsuario();
                break;
            case 'crearUsuario':
                Registrarse();
                break;
						case 'confirmarModificarUsuario':
		            ConfirmaModificarUsuario();
		            break;
            case 'modificarUsuario':
                ModificarUsuario($db);
                break;
            case 'borrarUsuario':
                EliminarUsuario($_POST['email_borrar']);
                break;
        }
    }

    if (isset($_POST['accionUsuario'])) {
        switch ($_POST['accionUsuario']) {
            case 'crearUsuario':
                if(!ErrorInsercionUsuario())
                {

                    $nombre = mysqli_real_escape_string($db, $_POST['nom_nuevo']);
                    $apellidos = mysqli_real_escape_string($db, $_POST['ape_nuevo']);
                    $email = mysqli_real_escape_string($db, $_POST['ema_nuevo']);
                    $password = mysqli_real_escape_string($db, $_POST['pas_nuevo1']);
                    $direccion = mysqli_real_escape_string($db, $_POST['dir_nuevo']);
                    $telefono = mysqli_real_escape_string($db, $_POST['tel_nuevo']);
                    $tipo = mysqli_real_escape_string($db, $_POST['tip_nuevo']);
                    $estado = mysqli_real_escape_string($db, $_POST['est_nuevo']);
										$password = md5($password);

										if(!empty($_FILES['foto_nueva']['tmp_name']) && file_exists($_FILES['foto_nueva']['tmp_name'])) {
											$foto = mysqli_real_escape_string($db, file_get_contents($_FILES['foto_nueva']['tmp_name']));
                    	$query = mysqli_query($db, "INSERT INTO usuarios(nombre,apellidos,email,password,direccion,telefono,tipo,estado,foto) VALUES ('$nombre', '$apellidos','$email','$password','$direccion','$telefono','$tipo','$estado','{$foto}')") or die('Error crear usuario' .mysqli_error($db));
										}
										else{
											$query = mysqli_query($db, "INSERT INTO usuarios(nombre,apellidos,email,password,direccion,telefono,tipo,estado) VALUES ('$nombre', '$apellidos','$email','$password','$direccion','$telefono','$tipo','$estado')") or die('Error crear usuario' .mysqli_error($db));
										}
                    echo'
                      <form action="activacion.php" method="POST">
                          <input type="hidden" name="email" value="$email"/>
                      </form>
                    ';

                    $base_url='https://void.ugr.es/~josemi101920/proyecto/activacion.php';
                    $subject="Email verification";
                    $body='Hi, <br/> <br/> We need to make sure you are human. Please verify your email and get started using your Website account. <br/> <br/> <a href="'.$base_url.'activation/'.$email.'">'.$base_url.'activation/'.$email.'</a>';

                    Send_Mail($email,$subject,$body);
                    echo "<p class=\"formulario\">Registro finalizado con éxito. Se le ha enviado un correo de validación a su email, por favor valide su correo.</p>";
                    registrarEnLog($db, "Usuario creado");
                }

                else {
                    echo "<p class=\"formulario\">Los datos de creacion de usuario no se han introducido</p>";
                }
                break;
            case 'modificarUsuario':
                if(!ErrorModificacionUsuario())
                {

                  $nombre = mysqli_real_escape_string($db, $_POST['nom_mod']);
                  $apellidos = mysqli_real_escape_string($db, $_POST['ape_mod']);
                  $email = mysqli_real_escape_string($db, $_POST['ema_mod']);
                  $password = mysqli_real_escape_string($db, $_POST['pas_mod']);
                  $direccion = mysqli_real_escape_string($db, $_POST['dir_mod']);
                  $telefono = mysqli_real_escape_string($db, $_POST['tel_mod']);
                  $tipo = mysqli_real_escape_string($db, $_POST['tip_mod']);
                  $estado = mysqli_real_escape_string($db, $_POST['est_mod']);
									$password = md5($password);
                  echo'
                    <script type="text/javascript">
                        validarComponente();
                    </script>
                  ';

                  $query = mysqli_query($db, "SELECT email, password FROM usuarios");
									$todoCorrecto = false;

                  while($salida = mysqli_fetch_row($query)){

                    if($salida[0] == $email && $salida[1] == $password){
                      $todoCorrecto = true;
                    }
                  }
                  if($todoCorrecto==true){
										if(!empty($_FILES['foto_modo']['tmp_name']) && file_exists($_FILES['foto_modo']['tmp_name'])) {
											$foto = mysqli_real_escape_string($db, file_get_contents($_FILES['foto_modo']['tmp_name']));
                    	$query = mysqli_query($db, "UPDATE usuarios SET nombre='$nombre', apellidos='$apellidos', direccion='$direccion', telefono='$telefono', tipo='$tipo', estado='$estado', foto='{$foto}' WHERE email='$email'");
										}
										else{
											$query = mysqli_query($db, "UPDATE usuarios SET nombre='$nombre', apellidos='$apellidos', direccion='$direccion', telefono='$telefono', tipo='$tipo', estado='$estado' WHERE email='$email'");
										}

                    echo "<p class=\"formulario\">El usuario se ha modificado correctamente</p>";
                    registrarEnLog($db, "Usuario modificado");
                  }
                  else{
                    echo "<p class=\"formulario\">Contraseña errónea</p>";
                  }
                }

                else {
                    echo "<p class=\"formulario\">Datos introducidos no válidos</p>";
                }
                break;
            case 'borrarUsuario':
                if(!ErrorBorradoUsuario())
                {
                  $email_borrar = mysqli_real_escape_string($db, $_POST['email_borrar']);
                  $query = mysqli_query($db, "DELETE FROM usuarios WHERE email='$email_borrar'") or die('Error borrado usuario' .mysqli_error($db));

                    echo "<p class=\"formulario\">El usuario $email_borrar eliminado correctamente</p>";
                    registrarEnLog($db, "Usuario eliminado");
                }
                else {
                    echo "<p class=\"formulario\">El usuario no se ha eliminado</p>";
                }
                break;
              }
            }

if (isset($_POST['ejec'])) {
    switch ($_POST['ejec']) {
        case 'insert':
            if(!ErrorInsercion())
            {
                $tit = mysqli_real_escape_string($db, $_POST['tit_nuevo']);
                $aut = mysqli_real_escape_string($db, $_POST['aut_nuevo']);
                $cat = mysqli_real_escape_string($db, $_POST['cat_nuevo']);
                $des = mysqli_real_escape_string($db, $_POST['des_nuevo']);
                $ing = mysqli_real_escape_string($db, $_POST['ing_nuevo']);
                $pas = mysqli_real_escape_string($db, $_POST['pas_nuevo']);

								if(!empty($_FILES['img_nueva']['tmp_name']) && file_exists($_FILES['img_nueva']['tmp_name'])) {
									$imagen = mysqli_real_escape_string($db, file_get_contents($_FILES['img_nueva']['tmp_name']));
									$query = mysqli_query($db, "INSERT INTO recetas(titulo,autor,categoria,descripcion,ingredientes,preparacion,imagen) VALUES ('$tit', '$aut','$cat','$des','$ing','$pas','{$imagen}')") or die('Error insertar receta' .mysqli_error($db));
								}
								else{
									$query = mysqli_query($db, "INSERT INTO recetas(titulo,autor,categoria,descripcion,ingredientes,preparacion) VALUES ('$tit', '$aut','$cat','$des','$ing','$pas')") or die('Error insertar receta' .mysqli_error($db));
								}

								echo "<p class=\"formulario\">La receta $tit se ha creado correctamente</p>";
                registrarEnLog($db, "Receta creada");
            }

            else {
                echo "<p class=\"formulario\">Los datos no se han introducido</p>";
            }
            break;
        case 'update':
            if(!ErrorModificacion())
            {
              $tit = mysqli_real_escape_string($db, $_POST['tit_mod']);
              $aut = mysqli_real_escape_string($db, $_POST['aut_mod']);
              $cat = mysqli_real_escape_string($db, $_POST['cat_mod']);
              $des = mysqli_real_escape_string($db, $_POST['des_mod']);
              $ing = mysqli_real_escape_string($db, $_POST['ing_mod']);
              $pas = mysqli_real_escape_string($db, $_POST['pas_mod']);

							if(!empty($_FILES['img_mod']['tmp_name']) && file_exists($_FILES['img_mod']['tmp_name'])) {
								$imagen = mysqli_real_escape_string($db, file_get_contents($_FILES['img_mod']['tmp_name']));
								$query = mysqli_query($db, "UPDATE recetas SET autor='$aut', categoria='$cat', ingredientes='$ing', preparacion='$pas', descripcion='$des', imagen='{$imagen}' WHERE titulo='$tit'") or die('Error modificar' .mysqli_error($db));
							}
							else{
								$query = mysqli_query($db, "UPDATE recetas SET autor='$aut', categoria='$cat', ingredientes='$ing', preparacion='$pas', descripcion='$des' WHERE titulo='$tit'") or die('Error modificar' .mysqli_error($db));
							}

              echo "<p class=\"formulario\">La receta $tit se ha modificado correctamente</p>";
              registrarEnLog($db, "Receta modificada");
            }

            else {
                echo "<p class=\"formulario\">Los datos no se han modificado</p>";
            }
            break;
        case 'delete':
            if(!ErrorBorrado())
            {
                $tit_borrar = mysqli_real_escape_string($db, $_POST['tit_elim']);
                $query = mysqli_query($db, "DELETE FROM recetas WHERE titulo='$tit_borrar'") or die('Error borrado' .mysqli_error($db));

                echo "<p class=\"formulario\">La receta $tit_borrar eliminada correctamente</p>";
                registrarEnLog($db, "Receta eliminada");
            }
            else{
              echo "<p class=\"formulario\">No existe la receta especificada</p>";
            }

            break;
            case 'comentario':
                if(!ErrorInsercionComentario())
                {
                    $usuario = mysqli_real_escape_string($db, $_POST['user_nuevo']);
                    $receta = mysqli_real_escape_string($db, $_POST['recet_nuevo']);
                    $comentario = mysqli_real_escape_string($db, $_POST['coment_nuevo']);

                    $query = mysqli_query($db, "INSERT INTO comentarios(usuario,titulo,comentario,fecha) VALUES ('$usuario','$receta','$comentario',NOW())") or die('Error insertar comentario' .mysqli_error($db));
                    echo "<p class=\"formulario\">El comentario se ha creado correctamente</p>";
                    registrarEnLog($db, "Comentario creado");
                }

                else {
                    echo "<p class=\"formulario\">Los datos no se han introducido</p>";
                }
								if(!ErrorInsercionValoracion())
                {
                  $usuario = mysqli_real_escape_string($db, $_POST['user_nuevo']);
                  $receta = mysqli_real_escape_string($db, $_POST['recet_nuevo']);
                  $valoracion = mysqli_real_escape_string($db, $_POST['valoracion_nueva']);

									$query = mysqli_query($db, "SELECT receta, usuario FROM valoraciones");
									$yaExiste = false;

                  while($salida = mysqli_fetch_row($query)){

                    if($salida[0] == $receta && $salida[1] == $usuario){
                      $yaExiste = true;
                    }
                  }
                  if($yaExiste==false){
                      $query = mysqli_query($db, "INSERT INTO valoraciones(receta,usuario,valoracion) VALUES ('$receta','$usuario','$valoracion')") or die('Error insertar valoracion' .mysqli_error($db));
                    echo "<p class=\"formulario\">La valoración se ha creado correctamente</p>";
                    registrarEnLog($db, "Valoración creada");
                  }
                  else{
                    echo "<p class=\"formulario\">No se ha creado la valoración, este usuario ya ha valorado esta receta</p>";
                  }
                }

                else {
                  echo "<p class=\"formulario\">La valoración no se ha introducido</p>";
                }
                break;
								case 'borrarComentario':
				            if(!ErrorBorradoComentario())
				            {
				                $comentario_borrar = mysqli_real_escape_string($db, $_POST['comentario_elim']);
				                $query = mysqli_query($db, "DELETE FROM comentarios WHERE comentario='$comentario_borrar'") or die('Error borrado comentario' .mysqli_error($db));

				                echo "<p class=\"formulario\">El comentario ha sido eliminado correctamente</p>";
				                registrarEnLog($db, "Comentario eliminado");
				            }
				            else{
				              echo "<p class=\"formulario\">No existe el comentario especificado</p>";
				            }
    }
}

echo "</main>";

function ErrorInsercion()
{
    $error = false;

    if(isset($_POST['ejec']))
    {

        if(!isset($_POST['tit_nuevo']) || !isset($_POST['aut_nuevo']) || !isset($_POST['cat_nuevo']) || !isset($_POST['des_nuevo'])
           || !isset($_POST['ing_nuevo']) || !isset($_POST['pas_nuevo'])){
           echo "<p class=\"formulario\">Los datos introducidos no son válidos</p>";
            $error = true;
          }
    }

    else{
        $error = true;
        echo "<p class=\"formulario\">Los datos introducidos no son válidos</p>";
    }

    return $error;
}

function ErrorInsercionUsuario()
{
    $error = false;

        if(!isset($_POST['nom_nuevo']) || !isset($_POST['ape_nuevo']) || !isset($_POST['ema_nuevo']) || !isset($_POST['pas_nuevo1']) || !isset($_POST['pas_nuevo2']) || !isset($_POST['dir_nuevo']) || !isset($_POST['tel_nuevo']) ){
           echo "<p class=\"formulario\">Los datos introducidos no son válidos</p>";
            $error = true;
          }
        else if($_POST['pas_nuevo1'] != $_POST['pas_nuevo2']){
          echo "<p class=\"formulario\">Las contraseñas no coinciden</p>";
           $error = true;
        }

    return $error;
}

function ErrorModificacion()
{
    $error = false;

    if(isset($_POST['tit_mod']))
    {

        if(empty($_POST['aut_mod']) || empty($_POST['cat_mod']) || empty($_POST['pas_mod'])
           || empty($_POST['ing_mod']) || empty($_POST['des_mod'])){
            $error = true;
            echo "<p class=\"formulario\">Los datos no son válidos</p>";
          }

    }

    else{
        $error = true;
        echo "<p class=\"formulario\">Los datos no son válidos</p>";
    }

    return $error;
}

function ErrorModificacionUsuario()
{
    $error = false;

    if(isset($_POST['ema_mod']))
    {

        if(empty($_POST['nom_mod']) || empty($_POST['ape_mod']) || empty($_POST['pas_mod'])
           || empty($_POST['dir_mod']) || empty($_POST['tel_mod'])){
            $error = true;
            echo "<p class=\"formulario\">Los datos introducidos no son válidos</p>";
          }

    }

    else{
        $error = true;
        echo "<p class=\"formulario\">Los datos no son válidos</p>";
    }

    return $error;
}

function ErrorBorrado()
{
    $error = false;

    if(isset($_POST['tit_elim']))
    {
        if(($_POST['tit_elim'])==""){
            $error = true;
            echo "<p class=\"formulario\">No se ha introducido ningún título</p>";
          }
    }

    else{
        $error = true;
        echo "<p class=\"formulario\">El titulo introducido no es válido</p>";
    }

    return $error;
}

function ErrorBorradoUsuario()
{
    $error = false;

    if(isset($_POST['email_borrar']))
    {
        if(($_POST['email_borrar'])==""){
            $error = true;
            echo "<p class=\"formulario\">No se ha introducido ningún email</p>";
          }
    }

    else{
        $error = true;
        echo "<p class=\"formulario\">El email introducido no es válido</p>";
    }

    return $error;
}

function ErrorBorradoComentario()
{
    $error = false;

    if(isset($_POST['comentario_elim']))
    {
        if(($_POST['comentario_elim'])==""){
            $error = true;
            echo "<p class=\"formulario\">No se ha introducido ningún comentario</p>";
          }
    }

    else{
        $error = true;
        echo "<p class=\"formulario\">El comentario no es válido</p>";
    }

    return $error;
}

function ErrorInsercionComentario()
{
    $error = false;

    if(isset($_POST['coment_nuevo']))
    {
        if(($_POST['coment_nuevo'])==""){
            $error = true;
            echo "<p class=\"formulario\">No se ha introducido ningún comentario</p>";
          }
    }

    else{
        $error = true;
        echo "<p class=\"formulario\">El comentario introducido no es válido</p>";
    }

    return $error;
}

function ErrorInsercionValoracion()
{
    $error = false;

    if(isset($_POST['valoracion_nueva']))
    {
        if(($_POST['valoracion_nueva'])==""){
            $error = true;
            echo "<p class=\"formulario\">No se ha introducido ninguna valoración</p>";
          }
    }

    else{
        $error = true;
        echo "<p class=\"formulario\">La valoración introducida no es válida</p>";
    }

    return $error;
}

include_once "aside.php";
include_once "footer.html";
include_once "end.html";

?>
