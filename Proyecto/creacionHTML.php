<?php

include_once "init.html";
include_once "header.html";
include_once "conectarBD.php";

function Formulario_busqueda(){
    echo <<< HTML
    <div class="contenedor">
        <div class="celdaTitulo">
              <div class="titPlato"><h2>Indique la(s) palabra(s) que desea buscar:</h2></div>
          </div>
            <div class="formulario"><form action="" method='POST' enctype='multipart/form-data'>
                <label>Buscar en título: <input type="text" name="palabra_clave_busqueda_titulo"/></label><br>
                <label>Buscar en receta: <input type="text" name="palabra_clave_busqueda_receta"/></label><br>
                <label>Buscar en categoría:
                  <label><input type="checkbox" class="radio" value="Carne" name="palabra_clave_busqueda_categoria"/>Carne</label>
                  <label><input type="checkbox" class="radio" value="Pescado" name="palabra_clave_busqueda_categoria"/>Pescado</label>
                  <label><input type="checkbox" class="radio" value="Arroz" name="palabra_clave_busqueda_categoria"/>Arroz</label>
                  <label><input type="checkbox" class="radio" value="Sopa" name="palabra_clave_busqueda_categoria"/>Sopa</label>
                  <label><input type="checkbox" class="radio" value="Fácil" name="palabra_clave_busqueda_categoria"/>Fácil</label>
                  <label><input type="checkbox" class="radio" value="Difícil" name="palabra_clave_busqueda_categoria"/>Difícil</label>
                  <label><input type="checkbox" class="radio" value="Ligero" name="palabra_clave_busqueda_categoria"/>Ligero</label>
                  <label><input type="checkbox" class="radio" value="Pesado" name="palabra_clave_busqueda_categoria"/>Pesado</label>
                </label>
                <div class="celdaTitulo">
                      <div class="titPlato"><h2>Orden de visualización:</h2></div>
                  </div>
                   <label>Ascendente: <input type="radio" name="orden" value="ascendente"/></label>
                   <label>Descendente: <input type="radio" name="orden" value="descendente"></label><br>
                   <label>De más a menos comentadas: <input type="radio" name="orden2" value="masComentarios"></label>
                   <label>De más a menos puntuación: <input type="radio" name="orden2" value="masPuntuacion"></label><br>
                   <div class="celdaTitulo">
                         <div class="titPlato"><h2>Recetas por página:</h2></div>
                     </div>
                      <select name="recetasPagina">
                       <option value="5">5</option>
                       <option value="10">10</option>
                       <option value="15">15</option>
                    </select><br>
                  <input type="hidden" name="busqueda" value="busqueda"/>
                   <input type="submit" name='clave_busq' value="Aplicar criterios de ordenación y búsqueda"/>
                 </form>
            </div>
      </div>
HTML;
}

function obtenerValoracion($titulo){
  $db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
  mysqli_set_charset($db, "utf8");
  $valoracionFinal = 0;

  $query = mysqli_query($db, "SELECT receta, AVG(valoracion) FROM valoraciones Group BY receta");
  if(mysqli_num_rows($query)>0)
  {
    while($valoracion=mysqli_fetch_array($query))
    {
        if(strpos($valoracion['receta'], $titulo) !== false)
          $valoracionFinal = $valoracion['AVG(valoracion)'];
    }
  }
  return $valoracionFinal;
}

function obtenerComentarios($titulo){
  $db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
  mysqli_set_charset($db, "utf8");

  $comentariosFinal = 0;
  $query = mysqli_query($db, "SELECT titulo, count(*) contador FROM comentarios Group BY titulo");
  if(mysqli_num_rows($query)>0)
  {
    while($comentario=mysqli_fetch_array($query))
    {
        if(strpos($comentario['titulo'], $titulo) !== false)
          $comentariosFinal = $comentario['contador'];
    }
  }
  return $comentariosFinal;
}

function Mostrar($receta)
{

  if(isset($_SESSION['login']) ){
    if($_SESSION['login'] == true){
      $usuario = $_SESSION['nombre'];
    }
    else{
      $usuario = "Invitado";
    }
  }
  else{
    $usuario = "Invitado";
  }

  $valoracion = obtenerValoracion($receta['titulo']);
  $valoracion = round($valoracion, 4);

    $data = base64_encode($receta['imagen']);
    echo <<< HTML
    <div class="contenedor">
      <div class="celdaTitulo">
        <div class="titPlato"><h2>{$receta['titulo']}</h2></div>
        <div class="stars">
HTML;
            echo "Valoración media: $valoracion";
            echo <<< HTML
        </div>
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
    </div>
    <br>
    <form action="gestion.php" method='POST'>
        <input type="hidden" name="usuarioComentario" value="$usuario"/>
        <input type="hidden" name="recetaComentario" value="{$receta['titulo']}"/>
        <input type="hidden" name="accion" value="comentario"/>
        <input type="submit" name="crearComentario" value="Crear comentario"/>
    </form>
HTML;
}

function MostrarComentarios($receta)
{
  $db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
  mysqli_set_charset($db, "utf8");
  $titulo = $receta['titulo'];
  $query = mysqli_query($db, "SELECT * FROM comentarios WHERE titulo='$titulo'");
  if(mysqli_num_rows($query)>0)
  {

    while($comentario=mysqli_fetch_array($query))
    {
      echo <<< HTML
      <div class="comentario">
        <div class="usu">
          <p>{$comentario['fecha']}</p>
          <p>{$comentario['usuario']}</p>
        </div>
        <div class="com">
          <p>{$comentario['comentario']}</p>
        </div>
      </div>
HTML;
    if(isset($_SESSION['tipo'])){
      if($_SESSION['tipo'] == "Administrador"){
        echo <<< HTML
        <div class="borrarComentario"><form action="gestion.php" method='POST'>
          <input type="hidden" name="usuarioComentario" value="{$comentario['usuario']}"/>
          <input type="hidden" name="recetaComentario" value="$titulo"/>
          <input type="hidden" name="comentario_elim" value="{$comentario['comentario']}"/>
          <input type="hidden" name="accion" value="borrarComentario"/>
          <input type="image" src="img/eliminar.png" width= "30px" height= "30px" name="borrar" value="Eliminar comentario"/>
        </form></div>
HTML;
    }
  }
  }
}
}

function MostrarReceta($titulo)
{
  $db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
  $query = mysqli_query($db, "SELECT * FROM recetas");

  $busqueda_titulo = true;

  if(mysqli_num_rows($query)>0)
  {

    while($receta=mysqli_fetch_array($query))
    {
        if(strpos($receta['titulo'], $titulo) == true)
            Mostrar($receta);
    }
  }
}

function ListadoRecetas($array_titulos){
echo <<< HTML
    <div class="celdaTitulo">
      <div class="titPlato"><h2>Listado de recetas</h2></div>
    </div>
HTML;

$url = $_SERVER["REQUEST_URI"];

  foreach ($array_titulos as $i){

  echo <<< HTML
    <div class="celdaTitulo">
      <div class="titPlato"><h2>{$i['titulo']}</h2></div>
HTML;
  $titulo = $i['titulo'];
  if(isset($_SESSION['tipo'])){
  if(($_SESSION['tipo'] == "Administrador") || ($_SESSION['nombre'] == $i['autor'] ) ){
    echo <<< HTML
    <form action="$url" method='POST'>
      <input type="hidden" name="receta" value="$titulo"/>
      <input type="hidden" name="accion" value="borrar"/>
        <input class="opciones" type="image" src="img/eliminar.png" width= "30px" height= "30px" name="borrar" value="Eliminar receta"/>
    </form>
    <form action="$url" method='POST'>
        <input type="hidden" name="receta" value="$titulo"/>
        <input type="hidden" name="accion" value="modificar"/>
        <input class="opciones" type="image" src="img/editar.png" width= "30px" height= "30px" name="modificar" value="Modificar receta"/>
    </form>
    <form action="$url" method='POST'>
        <input type="hidden" name="receta" value="$titulo"/>
        <input type="hidden" name="accion" value="visualizar"/>
        <input class="opciones" type="image" src="img/visualizar.png" width= "30px" height= "30px" name="visualizar" value="Visualizar receta"/>
    </form>
  </div>
HTML;
}
else{
echo <<< HTML
  <form action="$url" method='POST'>
      <input type="hidden" name="receta" value="$titulo"/>
      <input type="hidden" name="accion" value="visualizar"/>
      <input class="opciones" type="image" src="img/visualizar.png" width= "30px" height= "30px" name="visualizar" value="Visualizar receta"/>
  </form>
  </div>
HTML;
}
}
else{
echo <<< HTML
  <form action="$url" method='POST'>
      <input type="hidden" name="receta" value="$titulo"/>
      <input type="hidden" name="accion" value="visualizar"/>
      <input class="opciones" type="image" src="img/visualizar.png" width= "30px" height= "30px" name="visualizar" value="Visualizar receta"/>
  </form>
  </div>
HTML;
}
}
}

function ListadoRecetasPropias($array_titulos){
echo <<< HTML
    <div class="celdaTitulo">
      <div class="titPlato"><h2>Listado de recetas</h2></div>
    </div>
HTML;

$url = $_SERVER["REQUEST_URI"];

  foreach ($array_titulos as $i){

  echo <<< HTML
    <div class="celdaTitulo">
      <div class="titPlato"><h2>{$i['titulo']}</h2></div>
HTML;
  $titulo = $i['titulo'];
    echo <<< HTML
    <form action="$url" method='POST'>
      <input type="hidden" name="receta" value="$titulo"/>
      <input type="hidden" name="accion" value="borrar"/>
        <input class="opciones" type="image" src="img/eliminar.png" width= "30px" height= "30px" name="borrar" value="Eliminar receta"/>
    </form>
    <form action="$url" method='POST'>
        <input type="hidden" name="receta" value="$titulo"/>
        <input type="hidden" name="accion" value="modificar"/>
        <input class="opciones" type="image" src="img/editar.png" width= "30px" height= "30px" name="modificar" value="Modificar receta"/>
    </form>
    <form action="$url" method='POST'>
        <input type="hidden" name="receta" value="$titulo"/>
        <input type="hidden" name="accion" value="visualizar"/>
        <input class="opciones" type="image" src="img/visualizar.png" width= "30px" height= "30px" name="visualizar" value="Visualizar receta"/>
    </form>
  </div>
HTML;
}
}

function ListadoUsuarios($array_usuarios){
echo <<< HTML
    <div class="celdaTitulo">
      <div class="titPlato"><h2>Listado de usuarios</h2></div>
    </div>
HTML;

  foreach ($array_usuarios as $i){
    $email = $i['email'];
    $foto = base64_encode($i['foto']);

  echo <<< HTML
    <div class="formulario">
      <p>Usuario: {$i['nombre']} {$i['apellidos']}</p>
      <p>Email: {$i['email']}</p>
      <p>Dirección: {$i['direccion']}</p>
      <p>Teléfono: {$i['telefono']}</p>
      <p>Rol: {$i['tipo']}</p>
      <p>Verificado: {$i['estado']}</p>
      <img src='data:img/jpg;base64,$foto' width="100" height="100"/>
    <form action="gestion.php" method='POST'>
      <input type="hidden" name="email_modificar" value="$email"/>
        <input type="hidden" name="usuario" value="modificarUsuario"/>
        <input type="image" src="img/editar.png" width= "30px" height= "30px" name="modificar" value="Modificar usuario"/>
    </form>
    <form action="gestion.php" method='POST'>
      <input type="hidden" name="email_borrar" value="$email"/>
      <input type="hidden" name="usuario" value="borrarUsuario"/>
      <input type="image" src="img/eliminar.png" width= "30px" height= "30px" name="borrar" value="Eliminar usuario"/>
    </form>
  </div>
HTML;
}
}

function FormContacto()
{

        echo <<< HTML
        <main>
        <div class="contenedor">
            <div class="celdaTitulo">
              <div class="titPlato"><h2>Información de contacto</h2></div>
            </div>
            <div class="formulario">
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
        </div>
HTML;

  echo "<aside>";

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

        echo "<label>Nombre<input gestiontype=\"text\" name=\"nombre\"";
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

    if(empty($err))
    {
      $tit = strip_tags($_POST['tit_nuevo']);
      $aut = strip_tags($_POST['aut_nuevo']);
      $cat = strip_tags($_POST['cat_nuevo']);
      $des = strip_tags($_POST['des_nuevo']);
      $ing = strip_tags($_POST['ing_nuevo']);
      $pas = strip_tags($_POST['pas_nuevo']);

            echo <<< HTML
            <main>
            <div class="formulario">
                <form action="" method='POST' enctype='multipart/form-data'>
                    <p>¿Son correctos los siguientes datos?</p>
                    <label>Titulo<input type="text" name="tit_nuevo" value="$tit"/></label>
                    <label>Autor<input type="text" name="aut_nuevo" value="$aut" readonly/></label>
                    <label>Categoria<input type="text" name="cat_nuevo" value="$cat"/></label>
                    <label>Descripción<input type="text" name="des_nuevo" value="$des"/></label>
                    <label>Ingredientes<input type="text" name="ing_nuevo" value="$ing"/></label>
                    <label>Preparación<input type="text" name="pas_nuevo" value="$pas"/></label>
                    <label>Imagen<input type="file" name="img_nueva"/></label>
                    <input type='hidden' name='ejec' value='insert'/>
                    <input type="submit" name='accept' value="Crear receta"/>
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

        echo "<label>Titulo<input type=\"text\" name=\"tit_nuevo\"";
        if(isset($err['tit_nuevo']))
            echo "/></label><p class=\"formulario\">El titulo no puede estar vacío</p>";
        else
            echo " value='".strip_tags($_POST['tit_nuevo'])."'/></label>";


        echo "<label>Autor<input type=\"text\" name=\"aut_nuevo\" readonly";
        if(isset($err['aut_nuevo']))
            echo "/></label><p class=\"formulario\">El autor no puede estar vacio</p>";
        else
            echo " value='".strip_tags($_POST['aut_nuevo'])."'/></label>";


            echo "<label>Categoria<input type=\"text\" name=\"cat_nuevo\"";
            if(isset($err['cat_nuevo']))
                echo "/></label><p class=\"formulario\">La categoria no puede estar vacia</p>";
            else
                echo " value='".strip_tags($_POST['cat_nuevo'])."'/></label>";


        echo "<label>Descripción<input type=\"text\" name=\"des_nuevo\"";
        if(isset($err['des_nuevo']))
            echo "/></label><p class=\"formulario\">La descripción no puede estar vacía</p>";
        else
            echo " value='".strip_tags($_POST['des_nuevo'])."'/></label>";

        echo "<label>Ingredientes<input type=\"text\" name=\"ing_nuevo\"";
        if(isset($err['ing_nuevo']))
            echo "/></label><p class=\"formulario\">Los ingredientes no pueden estar vacíos</p>";
        else
            echo " value='".strip_tags($_POST['ing_nuevo'])."'/></label>";

        echo "<label>Preparación<input type=\"text\" name=\"pas_nuevo\"";
        if(isset($err['pas_nuevo']))
            echo "/></label><p class=\"formulario\">La preparacion no puede estar vacía</p>";
        else
            echo " value='".strip_tags($_POST['pas_nuevo'])."'/></label>";

    echo <<< HTML

    <input type='hidden' name='accion' value='confirmar'/>
    <input type="submit" name='accept' value="Crear receta"/>
  </form>
</div>
HTML;

    }
}

function ConfirmaModificarReceta()
{
    if(empty($_POST["tit_mod"]))
    {
        $err['tit_mod'] = true;
    }

    if(empty($_POST["aut_mod"]))
    {
        $err['aut_mod'] = true;
    }

    if(empty($_POST["cat_mod"]))
    {
        $err['cat_mod'] = true;
    }

    if(empty($_POST["des_mod"]))
    {
        $err['des_mod'] = true;
    }

    if(empty($_POST["ing_mod"]))
    {
        $err['ing_mod'] = true;
    }

    if(empty($_POST["pas_mod"]))
    {
        $err['pas_mod'] = true;
    }

    if(empty($err))
    {
      $tit = strip_tags($_POST['tit_mod']);
      $aut = strip_tags($_POST['aut_mod']);
      $cat = strip_tags($_POST['cat_mod']);
      $des = strip_tags($_POST['des_mod']);
      $ing = strip_tags($_POST['ing_mod']);
      $pas = strip_tags($_POST['pas_mod']);

            echo <<< HTML
            <main>
            <div class="formulario">
                <form action="" method='POST' enctype='multipart/form-data'>
                    <p>¿Son correctos los siguientes datos?</p>
                    <label>Titulo<input type="text" name="tit_mod" value="$tit"/></label>
                    <label>Autor<input type="text" name="aut_mod" value="$aut" readonly/></label>
                    <label>Categoria<input type="text" name="cat_mod" value="$cat"/></label>
                    <label>Descripción<input type="text" name="des_mod" value="$des"/></label>
                    <label>Ingredientes<input type="text" name="ing_mod" value="$ing"/></label>
                    <label>Preparación<input type="text" name="pas_mod" value="$pas"/></label>
                    <label>Imagen<input type="file" name="img_mod"/></label>
                    <input type='hidden' name='ejec' value='update'/>
                    <input type="submit" name='accept' value="Modificar receta"/>
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

        echo "<label>Titulo<input type=\"text\" name=\"tit_mod\"";
        if(isset($err['tit_mod']))
            echo "/></label><p class=\"formulario\">El titulo no puede estar vacío</p>";
        else
            echo " value='".strip_tags($_POST['tit_mod'])."'/></label>";


        echo "<label>Autor<input type=\"text\" name=\"aut_mod\" readonly";
        if(isset($err['aut_mod']))
            echo "/></label><p class=\"formulario\">El autor no puede estar vacio</p>";
        else
            echo " value='".strip_tags($_POST['aut_mod'])."'/></label>";


            echo "<label>Categoria<input type=\"text\" name=\"cat_mod\"";
            if(isset($err['cat_mod']))
                echo "/></label><p class=\"formulario\">La categoria no puede estar vacia</p>";
            else
                echo " value='".strip_tags($_POST['cat_mod'])."'/></label>";


        echo "<label>Descripción<input type=\"text\" name=\"des_mod\"";
        if(isset($err['des_mod']))
            echo "/></label><p class=\"formulario\">La descripción no puede estar vacía</p>";
        else
            echo " value='".strip_tags($_POST['des_mod'])."'/></label>";

        echo "<label>Ingredientes<input type=\"text\" name=\"ing_mod\"";
        if(isset($err['ing_mod']))
            echo "/></label><p class=\"formulario\">Los ingredientes no pueden estar vacíos</p>";
        else
            echo " value='".strip_tags($_POST['ing_mod'])."'/></label>";

        echo "<label>Preparación<input type=\"text\" name=\"pas_mod\"";
        if(isset($err['pas_mod']))
            echo "/></label><p class=\"formulario\">La preparacion no puede estar vacía</p>";
        else
            echo " value='".strip_tags($_POST['pas_mod'])."'/></label>";

    echo <<< HTML

    <input type='hidden' name='accion' value='confirmarModificar'/>
    <input type="submit" name='accept' value="Verificar datos"/>
  </form>
</div>
HTML;

    }
}

function ConfirmaUsuario()
{
    if(empty($_POST["nom_nuevo"]))
    {
        $err['nom_nuevo'] = true;
    }

    if(empty($_POST["ape_nuevo"]))
    {
        $err['ape_nuevo'] = true;
    }

    if(empty($_POST["ema_nuevo"]))
    {
        $err['ema_nuevo'] = true;
    }

    if(empty($_POST["pas_nuevo1"]))
    {
        $err['pas_nuevo1'] = true;
    }

    if(empty($_POST["pas_nuevo2"]))
    {
        $err['pas_nuevo2'] = true;
    }

    if(empty($_POST["dir_nuevo"]))
    {
        $err['dir_nuevo'] = true;
    }

    if(empty($_POST["tel_nuevo"]))
    {
        $err['tel_nuevo'] = true;
    }

    if(empty($_POST["tip_nuevo"]))
    {
        $err['tip_nuevo'] = true;
    }

    if(empty($_POST["est_nuevo"]))
    {
        $err['est_nuevo'] = true;
    }

    if(empty($err))
    {
      $nombre = strip_tags($_POST['nom_nuevo']);
      $apellidos = strip_tags($_POST['ape_nuevo']);
      $email = strip_tags($_POST['ema_nuevo']);
      $password1 = strip_tags($_POST['pas_nuevo1']);
      $password2 = strip_tags($_POST['pas_nuevo2']);
      $direccion = strip_tags($_POST['dir_nuevo']);
      $telefono = strip_tags($_POST['tel_nuevo']);
      $tipo = strip_tags($_POST['tip_nuevo']);
      $estado = strip_tags($_POST['est_nuevo']);

            echo <<< HTML
            <main>
            <div class="formulario">
                <form action="gestion.php" method='POST' enctype='multipart/form-data'>
                    <p>¿Son correctos los siguientes datos?</p>
                    <label>nombre<input type="text" name="nom_nuevo" value="$nombre"/></label>
                    <label>Apellidos<input type="text" name="ape_nuevo" value="$apellidos"/></label>
                    <label>Email<input type="text" name="ema_nuevo" value="$email"/></label>
                    <label>Clave<input type="password" name="pas_nuevo1" value="$password1"/></label>
                    <label><input type="password" name="pas_nuevo2" value="$password2"/></label>
                    <label>Dirección<input type="text" name="dir_nuevo" value="$direccion"/></label>
                    <label>Teléfono<input type="text" name="tel_nuevo" value="$telefono"/></label>
                    <label>Tipo<input type="text" name="tip_nuevo" value="$tipo"/></label>
                    <label>Estado<input type="text" name="est_nuevo" value="$estado"/></label>
                    <label>Foto<input type="file" name="img_nueva"/></label>
                    <input type='hidden' name='accionUsuario' value='crearUsuario'/>
                    <input type="submit" name='accept' value="Crear usuario"/>
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

        echo "<label>Nombre<input type=\"text\" name=\"nom_nuevo\"";
        if(isset($err['nom_nuevo']))
            echo "/></label><p class=\"formulario\">El nombre no puede estar vacío</p>";
        else
            echo " value='".strip_tags($_POST['nom_nuevo'])."'/></label>";


        echo "<label>Apellidos<input type=\"text\" name=\"ape_nuevo\"";
        if(isset($err['ape_nuevo']))
            echo "/></label><p class=\"formulario\">Los apellidos no pueden estar vacíos</p>";
        else
            echo " value='".strip_tags($_POST['ape_nuevo'])."'/></label>";


        echo "<label>Email<input type=\"text\" name=\"ema_nuevo\"";
        if(isset($err['ema_nuevo']))
          echo "/></label><p class=\"formulario\">El email no puede estar vacío</p>";
        else
          echo " value='".strip_tags($_POST['ema_nuevo'])."'/></label>";


        echo "<label>Clave<input type=\"password\" name=\"pas_nuevo1\"";
        if(isset($err['pas_nuevo1']))
            echo "/></label><p class=\"formulario\">La clave no puede estar vacía</p>";
        else
            echo " value='".strip_tags($_POST['pas_nuevo1'])."'/></label>";

        echo "<label><input type=\"password\" name=\"pas_nuevo2\"";
        if(isset($err['pas_nuevo2']))
            echo "/></label><p class=\"formulario\">La clave no puede estar vacía</p>";
        else
            echo " value='".strip_tags($_POST['pas_nuevo2'])."'/></label>";

        echo "<label>Dirección<input type=\"text\" name=\"dir_nuevo\"";
        if(isset($err['dir_nuevo']))
            echo "/></label><p class=\"formulario\">La dirección no puede estar vacía</p>";
        else
            echo " value='".strip_tags($_POST['dir_nuevo'])."'/></label>";

        echo "<label>Teléfono<input type=\"text\" name=\"tel_nuevo\"";
        if(isset($err['tel_nuevo']))
            echo "/></label><p class=\"formulario\">El teléfono no puede estar vacío</p>";
        else
            echo " value='".strip_tags($_POST['tel_nuevo'])."'/></label>";

        echo "<label>Tipo<input type=\"text\" name=\"tip_nuevo\"";
        if(isset($err['tip_nuevo']))
          echo "/></label><p class=\"formulario\">El tipo no puede estar vacío</p>";
        else
          echo " value='".strip_tags($_POST['tip_nuevo'])."'/></label>";

        echo "<label>Estado<input type=\"text\" name=\"est_nuevo\"";
        if(isset($err['est_nuevo']))
          echo "/></label><p class=\"formulario\">El estado no puede estar vacío</p>";
        else
          echo " value='".strip_tags($_POST['est_nuevo'])."'/></label>";

    echo <<< HTML

    <input type='hidden' name='usuario' value='confirmarUsuario'/>
    <input type="submit" name='accept' value="Crear usuario"/>
  </form>
</div>
HTML;

    }
}

function ConfirmaModificarUsuario()
{
    if(empty($_POST["nom_mod"]))
    {
        $err['nom_mod'] = true;
    }

    if(empty($_POST["ape_mod"]))
    {
        $err['ape_mod'] = true;
    }

    if(empty($_POST["ema_mod"]))
    {
        $err['ema_mod'] = true;
    }

    if(empty($_POST["pas_mod"]))
    {
        $err['pas_mod'] = true;
    }

    if(empty($_POST["dir_mod"]))
    {
        $err['dir_mod'] = true;
    }

    if(empty($_POST["tel_mod"]))
    {
        $err['tel_mod'] = true;
    }

    if(empty($_POST["tip_mod"]))
    {
        $err['tip_mod'] = true;
    }

    if(empty($_POST["est_mod"]))
    {
        $err['est_mod'] = true;
    }

    if(empty($err))
    {
      $nombre = strip_tags($_POST['nom_mod']);
      $apellidos = strip_tags($_POST['ape_mod']);
      $email = strip_tags($_POST['ema_mod']);
      $password = strip_tags($_POST['pas_mod']);
      $direccion = strip_tags($_POST['dir_mod']);
      $telefono = strip_tags($_POST['tel_mod']);
      $tipo = strip_tags($_POST['tip_mod']);
      $estado = strip_tags($_POST['est_mod']);

            echo <<< HTML
            <main>
            <div class="formulario">
                <form action="gestion.php" method='POST' enctype='multipart/form-data'>
                    <p>¿Son correctos los siguientes datos?</p>
                    <label>nombre<input type="text" name="nom_mod" value="$nombre"/></label>
                    <label>Apellidos<input type="text" name="ape_mod" value="$apellidos"/></label>
                    <label>Email<input type="text" name="ema_mod" value="$email"/></label>
                    <label>Clave<input type="password" name="pas_mod" value="$password"/></label>
                    <label>Dirección<input type="text" name="dir_mod" value="$direccion"/></label>
                    <label>Teléfono<input type="text" name="tel_mod" value="$telefono"/></label>
                    <label>Tipo<input type="text" name="tip_mod" value="$tipo"/></label>
                    <label>Estado<input type="text" name="est_mod" value="$estado"/></label>
                      <label>Foto<input type="file" name="foto_mod"/></label>
                    <input type='hidden' name='accionUsuario' value='modificarUsuario'/>
                    <input type="submit" name='accept' value="Modificar usuario"/>
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

        echo "<label>Nombre<input type=\"text\" name=\"nom_mod\"";
        if(isset($err['nom_mod']))
            echo "/></label><p class=\"formulario\">El nombre no puede estar vacío</p>";
        else
            echo " value='".strip_tags($_POST['nom_mod'])."'/></label>";


        echo "<label>Apellidos<input type=\"text\" name=\"ape_mod\"";
        if(isset($err['ape_mod']))
            echo "/></label><p class=\"formulario\">Los apellidos no pueden estar vacíos</p>";
        else
            echo " value='".strip_tags($_POST['ape_mod'])."'/></label>";


        echo "<label>Email<input type=\"text\" name=\"ema_mod\"";
        if(isset($err['ema_mod']))
          echo "/></label><p class=\"formulario\">El email no puede estar vacío</p>";
        else
          echo " value='".strip_tags($_POST['ema_mod'])."'/></label>";


        echo "<label>Clave<input type=\"password\" name=\"pas_mod\"";
        if(isset($err['pas_mod']))
            echo "/></label><p class=\"formulario\">La clave no puede estar vacía</p>";
        else
            echo " value='".strip_tags($_POST['pas_mod'])."'/></label>";

        echo "<label>Dirección<input type=\"text\" name=\"dir_mod\"";
        if(isset($err['dir_mod']))
            echo "/></label><p class=\"formulario\">La dirección no puede estar vacía</p>";
        else
            echo " value='".strip_tags($_POST['dir_mod'])."'/></label>";

        echo "<label>Teléfono<input type=\"text\" name=\"tel_mod\"";
        if(isset($err['tel_mod']))
            echo "/></label><p class=\"formulario\">El teléfono no puede estar vacío</p>";
        else
            echo " value='".strip_tags($_POST['tel_mod'])."'/></label>";

        echo "<label>Tipo<input type=\"text\" name=\"tip_mod\"";
        if(isset($err['tip_mod']))
          echo "/></label><p class=\"formulario\">El tipo no puede estar vacío</p>";
        else
          echo " value='".strip_tags($_POST['tip_mod'])."'/></label>";

        echo "<label>Estado<input type=\"text\" name=\"est_mod\"";
        if(isset($err['est_mod']))
          echo "/></label><p class=\"formulario\">El estado no puede estar vacío</p>";
        else
          echo " value='".strip_tags($_POST['est_mod'])."'/></label>";

    echo <<< HTML

    <input type='hidden' name='usuario' value='confirmarModificarUsuario'/>
    <input type="submit" name='accept' value="Verificar datos"/>
  </form>
</div>
HTML;

    }
}

function InsertarReceta()
{
  $autor = $_POST['aut_nuevo'];

    echo <<< HTML
    <main>
    <div class="contenedor">
      <div class="celdaTitulo">
          <div class="titPlato"><h2>Registro nueva receta</h2></div>
      </div>
          <div class="formulario"><p>Introduce los datos de la nueva receta</p>
            <form action="gestion.php" method="POST" enctype="multipart/form-data">
            <label>Título<input type="text" name="tit_nuevo"/></label>
            <label>Autor<input type="text" name="aut_nuevo" value="{$autor}" readonly/></label>
            <label>Categoría<input type="text" name="cat_nuevo"/></label>
            <label>Descripción<input type="text" name="des_nuevo"/></label>
            <label>Ingredientes<input type="text" name="ing_nuevo"/></label>
            <label>Preparación<input type="text" name="pas_nuevo"/></label>
            <input type="hidden" name="accion" value="confirmar"/>
            <input type="submit" name='nuevo' value="Añadir"/>
            </form>
          </div>
        </div>
HTML;
}

function InsertarComentario()
{

  $usuario = $_POST['usuarioComentario'];
  $receta = $_POST['recetaComentario'];

    echo <<< HTML
    <main>
    <div class="contenedor">
    		<div class="celdaTitulo">
    				<div class="titPlato"><h2>Introduce el nuevo comentario</h2></div>
    		</div>
    				<div class="formulario"><form action="gestion.php" method="POST" enctype="multipart/form-data">
            <label>Usuario<input type="text" name="user_nuevo" value="$usuario" readonly/></label>
            <label>Receta<input type="text" name="recet_nuevo" value="$receta" readonly/></label><br>
            <label>Comentario<input type="text" name="coment_nuevo"/></label><br>
HTML;
            if(isset($_SESSION['tipo'])){
              echo <<< HTML
            <div class="valoracion">
              <input id="radio1" type="radio" name="valoracion_nueva" value="5">
              <label for="radio1">★</label>
              <input id="radio2" type="radio" name="valoracion_nueva" value="4">
              <label for="radio2">★</label>
              <input id="radio3" type="radio" name="valoracion_nueva" value="3">
              <label for="radio3">★</label>
              <input id="radio4" type="radio" name="valoracion_nueva" value="2">
              <label for="radio4">★</label>
              <input id="radio5" type="radio" name="valoracion_nueva" value="1">
              <label for="radio5">★</label>
            </div>
HTML;
            }
            echo <<< HTML
            <input type="hidden" name="ejec" value="comentario"/>
            <br><input type="submit" name='nuevo' value="Añadir comentario"/>
        </form>
      </div>
HTML;
}

function ModificarReceta()
{
    echo <<< HTML
    <main>
        <div class="formulario"><form action="gestion.php" method="POST" enctype="multipart/form-data">
            <h2>Introduce el titulo de la receta a modificar</h2>
            <label>Título<input type="text" name="tit_mod"/></label>
            <input type="hidden" name="accion" value="enviar"/>
            <input type="submit" name='envio_titulo' value="Aceptar"/>
        </form>
      </div>
HTML;
}

function busquedaUsuario()
{
    echo <<< HTML
    <main>
        <div class="formulario"><form action="gestion.php" method="POST" enctype="multipart/form-data">
            <h2>Introduce el email del usuario a modificar</h2>
            <label>Email<input type="email" name="email_mod"/></label>
            <input type="hidden" name="usuario" value="modificarUsuario"/>
            <input type="submit" name='envio_titulo' value="Aceptar"/>
        </form>
      </div>
HTML;
}

function DatosAModificar($db)
{
    $tit_modificar = mysqli_real_escape_string($db, $_POST['tit_mod']);

    $query = mysqli_query($db, "SELECT * FROM recetas WHERE titulo='$tit_modificar'");
  	if(mysqli_num_rows($query)>0){
  			$receta=mysqli_fetch_array($query);

        $aut_modificar=$receta['autor'];
        $cat_modificar=$receta['categoria'];
        $des_modificar=$receta['descripcion'];
        $ing_modificar=$receta['ingredientes'];
        $pre_modificar=$receta['preparacion'];
        $imagen_modificar = base64_encode($receta['imagen']);

        echo <<< HTML
          <main>
            <div class="formulario">
              <form action="gestion.php" method="POST">
                <img src='data:img/jpg;base64,$imagen_modificar' width="180" height="180"/>
                <label>Titulo<input type="text" name="tit_mod" value="{$tit_modificar}" readonly/></label>
                <label>Autor<input type="text" name="aut_mod" value="{$aut_modificar}"/></label>
                <label>Categoría<input type="text" name="cat_mod" value="{$cat_modificar}"/></label>
                <label>Descripción<input type="text" name="des_mod" value="{$des_modificar}"/></label>
                <label>Ingredientes<input type="text" name="ing_mod" value="{$ing_modificar}"/></label>
                <label>Preparación<input type="text" name="pas_mod" value="{$pre_modificar}"/></label>
                <input type="hidden" name="ejec" value="update"/>
                <input type="submit" name='modif' value="Modificar"/>
            </form></div>
HTML;
    }

    else {
        echo "<p class=\"formulario\">No existe la receta especificada</p>";
    }
}

function modificarUsuario($db)
{

    $email_modificar = mysqli_real_escape_string($db, $_POST['email_modificar']);

  	$query = mysqli_query($db, "SELECT * FROM usuarios WHERE email='$email_modificar'");
  	if(mysqli_num_rows($query)>0){
  			$usuario=mysqli_fetch_array($query);

    $nombre_modificar = $usuario['nombre'];
    $apellidos_modificar = $usuario['apellidos'];
    $direccion_modificar = $usuario['direccion'];
    $telefono_modificar = $usuario['telefono'];
    $tipo_modificar = $usuario['tipo'];
    $estado_modificar = $usuario['estado'];
    $foto_modificar = base64_encode($usuario['foto']);
        echo <<< HTML
        <main>
          <div class="contenedor">
            <div class="celdaTitulo">
                <div class="titPlato"><h2>Editar usuario</h2></div>
            </div>
            <div class="formulario">
              <form action="gestion.php" method="POST">
                <img src='data:img/jpg;base64,$foto_modificar' width="180" height="180"/>
                <label>Nombre<input type="text" name="nom_mod" value="{$nombre_modificar}"/></label>
                <label>Apellidos<input type="text" name="ape_mod" value="{$apellidos_modificar}"/></label>
                <label>Email<input type="text" name="ema_mod" value={$email_modificar} readonly/></label>
                <label>Password<input type="password" name="pas_mod"/></label>
                <label>Dirección<input type="text" name="dir_mod" value="{$direccion_modificar}"/></label>
                <label>Telefono<input type="text" name="tel_mod" value="{$telefono_modificar}"/></label>
                <label>Tipo</label>
                <select name="tip_mod">
                   <option value="{$tipo_modificar}">$tipo_modificar</option>
                </select>
                <label>Verificado</label>
                <select name="est_mod">
                   <option value="{$estado_modificar}">$estado_modificar</option>
                </select>
                <input type="hidden" name="usuario" value="confirmarModificarUsuario"/>
                <input type="submit" name='modif' value="Verificar datos"/>
            </form>
          </div>
        </div>
HTML;
}
  else{
    echo "<p class=\"formulario\">No existe el usuario especificado</p>";
  }
}

function EditarReceta($receta)
{
        $tit_modificar=$receta['titulo'];
        $aut_modificar=$receta['autor'];
        $cat_modificar=$receta['categoria'];
        $des_modificar=$receta['descripcion'];
        $ing_modificar=$receta['ingredientes'];
        $pre_modificar=$receta['preparacion'];

        echo <<< HTML
        <div class="contenedor">
          <div class="celdaTitulo">
              <div class="titPlato"><h2>Editar receta</h2></div>
          </div>
          <div class="formulario">
              <form action="gestion.php" method="POST">
                <label>Titulo<input type="text" name="tit_mod" value="{$tit_modificar}" readonly/></label>
                <label>Autor<input type="text" name="aut_mod" value="{$aut_modificar}"/></label>
                <label>Categoría<input type="text" name="cat_mod" value="{$cat_modificar}"/></label>
                <label>Descripción<input type="text" name="des_mod" value="{$des_modificar}"/></label>
                <label>Ingredientes<input type="text" name="ing_mod" value="{$ing_modificar}"/></label>
                <label>Preparación<input type="text" name="pas_mod" value="{$pre_modificar}"/></label>
                <input type="hidden" name="accion" value="confirmarModificar"/>
                <input type="submit" name='verificar' value="Verificar datos"/>
            </form>
          </div>
        </div>
HTML;
}

function BorrarReceta()
{
    echo <<< HTML
    <main>
        <div class="formulario"><form action="gestion.php" method="POST">
            <h2>Introduce el titulo de la receta a borrar</h2>
            <label>Titulo<input type="text" name="tit_elim"/></label>
            <input type="hidden" name="ejec" value="delete"/>
            <input type="submit" name='elim' value="Eliminar"/>
        </form>
      </div>
HTML;
}

function BorrarUsuario()
{
    echo <<< HTML
    <main>
        <div class="formulario"><form action="gestion.php" method="POST">
            <h2>Introduce el email del usuario a borrar</h2>
            <label>Email<input type="text" name="email_elim"/></label>
            <input type="hidden" name="accionUsuario" value="borrarUsuario"/>
            <input type="submit" name='elim' value="Eliminar"/>
        </form>
      </div>
HTML;
}

function EliminarReceta($receta)
{
    $titulo = $receta['titulo'];
    echo <<< HTML
        <div class="contenedor">
          <div class="celdaTitulo">
      				<div class="titPlato"><h2>Eliminar receta</h2></div>
      		</div>
          <div class="formulario"><h2>¿Está seguro que desea borrar esta receta?</h2>
            <form action="gestion.php" method="POST">
              <label>Titulo<input type="text" name="tit_elim" value="$titulo" readonly/></label>
              <input type="hidden" name="ejec" value="delete"/>
              <input type="submit" name='elim' value="Eliminar"/>
            </form>
          </div>
      </div>
HTML;
}

function EliminarUsuario($email)
{
    echo <<< HTML
    <main>
        <div class="contenedor">
          <div class="celdaTitulo">
      				<div class="titPlato"><h2>Eliminar usuario</h2></div>
      		</div>
          <div class="formulario"><h2>¿Está seguro que desea borrar este usuario?</h2>
            <form action="gestion.php" method="POST">
              <label>Email<input type="email" name="email_borrar" value="$email" readonly/></label>
              <input type="hidden" name="accionUsuario" value="borrarUsuario"/>
              <input type="submit" name='elim' value="Eliminar"/>
            </form>
          </div>
      </div>
HTML;
}

function EliminarComentario()
{

  $usuario = $_POST['usuarioComentario'];
  $receta = $_POST['recetaComentario'];
  $comentario = $_POST['comentario_elim'];

    echo <<< HTML
    <main>
        <div class="contenedor">
          <div class="celdaTitulo">
      				<div class="titPlato"><h2>Eliminar comentario</h2></div>
      		</div>
          <div class="formulario"><h2>¿Está seguro que desea borrar este comentario?</h2>
            <form action="gestion.php" method="POST">
              <label>Usuario<input type="text" name="usuarioComentario" value="$usuario" readonly/></label>
              <label>Receta<input type="text" name="recetaComentario" value="$receta" readonly/></label>
              <label>Comentario<input type="text" name="comentario_elim" value="$comentario" readonly/></label>
              <input type="hidden" name="ejec" value="borrarComentario"/>
              <input type="submit" name='elimComentario' value="Eliminar"/>
            </form>
          </div>
      </div>
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
