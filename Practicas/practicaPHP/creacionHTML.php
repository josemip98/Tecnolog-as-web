<?php

function Formulario_busqueda(){
    echo <<< HTML
    <main class="contenedor">
        <div class="formulario">
            <h2>Indique el titulo de la receta que desea buscar</h2>
            <form action="" method='POST' enctype='multipart/form-data'>
                <label>Titulo: <input type="text" name="palabra_clave_busqueda"/></label>
                <p>Orden visualización:</p>
                   <label>Ascendente: <input type="radio" name="orden" value="ascendente"/></label>
                   <label>Descendente: <input type="radio" name="orden" value="descendente"></label>
                   <input type="submit" name='clave_busq' value="Aceptar"/>
            </form>
        </div>
HTML;
}

function Mostrar($receta)
{
    $data = base64_encode($receta['imagen']);
    echo <<< HTML
    <div class="contenedor">
      <div class="celdaTitulo">
        <div class="titulo"><h2>{$receta['titulo']}</h2></div>
      </div>
      <div class="celdaTags">
        <div class="categoria"><p>{$receta['categoria']}</p></div>
        <div class="autor"><p>{$receta['autor']}</p></div>
      </div>
      <div class="infoPlato">
        <img class="fotografia" src='data:img/jpg;base64,$data' width="180" height="180"/>
        <div class="descripcion"><p>{$receta['descripcion']}</p></div>
      </div>
      <div class="ingredientes"><p>{$receta['ingredientes']}</p></div>
      <div class="preparacion"><p>{$receta['preparacion']}</p></div>
      <div class="barraPag">
        <form action="gestion.php" method='POST'>
            <input type="hidden" name="accion" value="borrar"/>
            <input class="opciones" type="image" src="img/eliminar.png" width= "30px" height= "30px" name="borrar" value="Eliminar receta"/>
        </form>
        <form action="gestion.php" method='POST'>
            <input type="hidden" name="accion" value="modificar"/>
            <input class="opciones" type="image" src="img/editar.png" width= "30px" height= "30px" name="modificar" value="Modificar receta"/>
        </form>
      </div>
    </div>
HTML;
}

function FormContacto()
{

        echo <<< HTML
        <main>
            <div class="formulario">
              <h2>Información de contacto</h2>
              <label>Nombre<input type="text" name="nombre" value="Jose Miguel"/></label>
              <label>Apellidos<input type="text" name="apellidos" value="Pelegrina Pelegrina"/></label>
              <label>Correo electrónico<input type="text" name="email" value="josemi10@correo.ugr.es"/></label>
            </div>
            <div class="formulario">
                <form action="" method='POST' enctype='multipart/form-data'>
                    <label>Nombre<input type="text" name="nombre"/></label>
                    <label>Email<input type="text" name="email"/></label>
                    <label>Teléfono<input type="text" name="telefono"/></label>
                    <label>Comentario<input type="text" name="comentario"/></label>
                    <input type='hidden' name='accion' value='confirma'/>
                    <input type="submit" name='accept' value="Enviar comentario"/>
                </form>
            </div>
HTML;

}

function ConfirmaComentario()
{
    if(empty($_POST["nombre"]))
    {
        $err['nombre'] = true;
    }

    if(!isset($_POST["email"]) || !EmailValido(strip_tags($_POST["email"])))
    {
        $err['email'] = true;
    }

    if(!isset($_POST["telefono"]) || !TelefonoValido($_POST["telefono"]))
    {
        $err['telefono'] = true;

    }

    if(empty($_POST["comentario"]))
    {
        $err['comentario'] = true;
    }

    if(empty($err))
    {
            $nom = strip_tags($_POST['nombre']);
            $email = strip_tags($_POST['email']);
            $tel = strip_tags($_POST['telefono']);
            $com = strip_tags($_POST['comentario']);

            echo <<< HTML
            <main>
            <div class="formulario">
                <form action="" method='POST' enctype='multipart/form-data'>
                    <p>¿Son correctos los siguientes datos?</p>
                    <label>Nombre<input type="text" name="cliente" value="$nom"/></label>
                    <label>Email<input type="text" name="email" value="$email"/></label>
                    <label>Teléfono<input type="text" name="telefono" value="$tel"/></label>
                    <label>Comentario<input type="text" name="comentario" value="$com"/></label>
                    <input type='hidden' name='accion' value='si'/>
                    <input type="submit" name='accept' value="Si"/>
                </form>
            </div>
HTML;
    }

    else
    {
      echo <<< HTML
      <main>
        <div class="formulario">
          <form action="" method='POST' enctype='multipart/form-data'>
HTML;

        echo "<label>Nombre<input type=\"text\" name=\"nombre\"";
        if(isset($err['nombre']))
            echo "/></label><p class=\"error\">El nombre no puede estar vacío</p>";
        else
            echo " value='".strip_tags($_POST['nombre'])."'/></label>";


        echo "<label>E-mail<input type=\"text\" name=\"email\"";
        if(isset($err['email']))
            echo "/></label><p class=\"error\">El e-mail debe tener la forma usuario@servidor.extension</p>";
        else
            echo " value='".strip_tags($_POST['email'])."'/></label>";


        echo "<label>Nº de teléfono<input type=\"text\" name=\"telefono\"";
        if(isset($err['telefono']))
            echo "/></label><p class=\"error\">Número de teléfono erróneo</p>";
        else
            echo " value='".strip_tags($_POST['telefono'])."'/></label>";


        echo "<label>Comentario<input type=\"text\" name=\"comentario\"";
        if(isset($err['comentario']))
            echo "/></label><p class=\"error\">El comentario no puede estar vacío</p>";
        else
            echo " value='".strip_tags($_POST['comentario'])."'/></label>";

    echo <<< HTML

    <input type='hidden' name='accion' value='confirma'/>
    <input type="submit" name='accept' value="Enviar comentario"/>
  </form>
</div>
HTML;

    }
}

function ConfirmaReceta()
{
    if(empty($_POST["tit_nuevo"]))
    {
        $err['tit_nuevo'] = true;
    }

    if(empty($_POST["aut_nuevo"]))
    {
        $err['aut_nuevo'] = true;
    }

    if(empty($_POST["cat_nuevo"]))
    {
        $err['cat_nuevo'] = true;
    }

    if(empty($_POST["des_nuevo"]))
    {
        $err['des_nuevo'] = true;
    }

    if(empty($_POST["ing_nuevo"]))
    {
        $err['ing_nuevo'] = true;
    }

    if(empty($_POST["pas_nuevo"]))
    {
        $err['pas_nuevo'] = true;
    }


    if((sizeof($_FILES)==0) || !array_key_exists("img_nueva",$_FILES))
      $err['img_nueva'] = true;

    if(empty($err))
    {
      $tit = strip_tags($_POST['tit_nuevo']);
      $aut = strip_tags($_POST['aut_nuevo']);
      $cat = strip_tags($_POST['cat_nuevo']);
      $des = strip_tags($_POST['des_nuevo']);
      $ing = strip_tags($_POST['ing_nuevo']);
      $pas = strip_tags($_POST['pas_nuevo']);
      $imagen = file_get_contents($_FILES['img_nueva']['tmp_name']);

      $data = base64_encode($_FILES['img_nueva']['tmp_name']);

            echo <<< HTML
            <div class="formulario">
                <form action="" method='POST' enctype='multipart/form-data'>
                    <p>¿Son correctos los siguientes datos?</p>
                    <label>Titulo<input type="text" name="tit_nuevo" value="$tit"/></label>
                    <label>Autor<input type="text" name="aut_nuevo" value="$aut"/></label>
                    <label>Categoria<input type="text" name="cat_nuevo" value="$cat"/></label>
                    <label>Descripción<input type="text" name="des_nuevo" value="$des"/></label>
                    <label>Ingredientes<input type="text" name="ing_nuevo" value="$ing"/></label>
                    <label>Preparación<input type="text" name="pas_nuevo" value="$pas"/></label>
                    <label>Imagen<input type="file" src='data:img/jpg;base64,$data' name="img_nueva" value="$data"/></label>
                    <input type='hidden' name='ejec' value='insert'/>
                    <input type="submit" name='accept' value="Crear receta"/>
                </form>
            </div>
HTML;
    }

    else
    {
      echo <<< HTML
        <div class="formulario">
          <form action="" method='POST' enctype='multipart/form-data'>
HTML;

        echo "<label>Titulo<input type=\"text\" name=\"tit_nuevo\"";
        if(isset($err['tit_nuevo']))
            echo "/></label><p class=\"error\">El titulo no puede estar vacío</p>";
        else
            echo " value='".strip_tags($_POST['tit_nuevo'])."'/></label>";


        echo "<label>Autor<input type=\"text\" name=\"aut_nuevo\"";
        if(isset($err['aut_nuevo']))
            echo "/></label><p class=\"error\">El autor no puede estar vacio</p>";
        else
            echo " value='".strip_tags($_POST['aut_nuevo'])."'/></label>";


            echo "<label>Categoria<input type=\"text\" name=\"cat_nuevo\"";
            if(isset($err['cat_nuevo']))
                echo "/></label><p class=\"error\">La categoria no puede estar vacia</p>";
            else
                echo " value='".strip_tags($_POST['cat_nuevo'])."'/></label>";


        echo "<label>Descripción<input type=\"text\" name=\"des_nuevo\"";
        if(isset($err['des_nuevo']))
            echo "/></label><p class=\"error\">La descripción no puede estar vacía</p>";
        else
            echo " value='".strip_tags($_POST['des_nuevo'])."'/></label>";

        echo "<label>Ingredientes<input type=\"text\" name=\"ing_nuevo\"";
        if(isset($err['ing_nuevo']))
            echo "/></label><p class=\"error\">Los ingredientes no pueden estar vacíos</p>";
        else
            echo " value='".strip_tags($_POST['ing_nuevo'])."'/></label>";

        echo "<label>Preparación<input type=\"text\" name=\"pas_nuevo\"";
        if(isset($err['pas_nuevo']))
            echo "/></label><p class=\"error\">La preparacion no puede estar vacía</p>";
        else
            echo " value='".strip_tags($_POST['pas_nuevo'])."'/></label>";

        echo "<label>Imágen<input type=\"file\" name=\"img_nueva\" accept=\"img/png, img/jpeg\"/></label>";
        if(in_array($_FILES['img_nueva']['type'],["image/jpeg","image/gif","image/png"]))
            echo"<img src='".$_FILES['img_nueva']['name']."' width='256'/>";
        else
            echo "</label><p class=\"error\">La imagen no puede estar vacía</p>";

    echo <<< HTML

    <input type='hidden' name='accion' value='confirmar'/>
    <input type="submit" name='accept' value="Crear receta"/>
  </form>
</div>
HTML;

    }
}

function Menu_navegacion_login($opcion){

    switch ($opcion) {
        case "Nueva receta": break;
        case "Modificar receta": break;
        case "Eliminar receta": break;
        case "Login": break;
    }
}

function InsertarReceta()
{
    echo <<< HTML
        <div class="formulario"><form action="gestion.php" method="POST" enctype="multipart/form-data">
            <h2>Introduce los datos de la nueva receta</h2>
            <label>Título<input type="text" name="tit_nuevo"/></label>
            <label>Autor<input type="text" name="aut_nuevo"/></label>
            <label>Categoría<input type="text" name="cat_nuevo"/></label>
            <label>Descripción<input type="text" name="des_nuevo"/></label>
            <label>Ingredientes<input type="text" name="ing_nuevo"/></label>
            <label>Preparación<input type="text" name="pas_nuevo"/></label>
            <label>Imágen<input type="file" name="img_nueva" accept="img/png, img/jpeg"/></label>
            <input type="hidden" name="accion" value="confirmar"/>
            <input type="submit" name='nuevo' value="Añadir"/>
        </form></div>
HTML;
}

function ModificarReceta($db)
{
    echo <<< HTML
        <div class="formulario"><form action="gestion.php" method="POST" enctype="multipart/form-data">
            <h2>Introduce el titulo de la receta a modificar</h2>
            <label>Título<input type="text" name="tit_mod"/></label>
            <input type="hidden" name="accion" value="enviar"/>
            <input type="submit" name='envio_titulo' value="Aceptar"/>
        </form></div>
HTML;
}

function DatosAModificar($db)
{
    $tit_modificar = mysqli_real_escape_string($db, $_POST['tit_mod']);

    if(!empty($tit_modificar))
    {
        echo <<< HTML
            <div><form action="gestion.php" method="POST">
                <label>Titulo<input type="text" name="tit_mod" value={$tit_modificar} readonly/></label>
                <label>Autor<input type="text" name="aut_mod"/></label>
                <label>Categoría<input type="text" name="cat_mod"/></label>
                <label>Descripción<input type="text" name="des_mod"/></label>
                <label>Ingredientes<input type="text" name="ing_mod"/></label>
                <label>Preparación<input type="text" name="pas_mod"/></label>
                <input type="hidden" name="ejec" value="update"/>
                <input type="submit" name='modif' value="Modificar"/>
            </form></div>
HTML;
    }

    else {
        echo "<p class=\"error\">No existe la receta especificada</p>";
    }
}

function BorrarReceta()
{
    echo <<< HTML
        <div class="formulario"><form action="gestion.php" method="POST">
            <h2>Introduce el titulo de la receta a borrar</h2>
            <label>Titulo<input type="text" name="tit_elim"/></label>
            <input type="hidden" name="ejec" value="delete"/>
            <input type="submit" name='elim' value="Eliminar"/>
        </form></div>
HTML;
}

function EmailValido($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function TelefonoValido($telefono)
{
  return preg_match('/^[0-9]{9,9}$/', $telefono) || $telefono=="";
}

?>
