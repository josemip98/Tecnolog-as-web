<?php

session_start();

if(isset($_POST["usuario"]))
{
    if($_POST["usuario"] == "admin" && $_POST["password"] == "clave")
        $_SESSION["usuario"] = $_POST["usuario"];
}

include_once "init.html";
include_once "header.html";
include_once "navegacionUsuario.php";
include_once "creacionHTML.php";

$db = mysqli_connect("localhost", "josemi101920", "UfKhSlgW", "josemi101920");

if(!$db)
{
    echo "<p>Error</p>";
    echo "<p>Código: ".mysqli_connect_errno()."</p>";
    echo "<p>Mensaje: ".mysqli_connect_error()."</p>";
    die("Fin de la ejecución");
}

mysqli_set_charset($db, "utf8");

if(isset($_SESSION['usuario']))
{
    if(isset($_POST['accion']))
    {
        switch ($_POST['accion']) {
            case 'confirmar':
                ConfirmaReceta();
                break;
            case 'crear':
                InsertarReceta();
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
        }
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
                $imagen = mysqli_real_escape_string($db, file_get_contents($_FILES['img_nueva']['tmp_name']));
                $query = mysqli_query($db, "INSERT INTO recetas(titulo,autor,categoria,descripcion,ingredientes,preparacion,imagen) VALUES ('$tit', '$aut','$cat','$des','$ing','$pas','{$imagen}')") or die('Error insertar receta' .mysqli_error($db));
                echo "<p>La receta $tit se ha creado correctamente</p>";
            }

            else {
                echo "<p>Los datos no se han introducido</p>";
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

              $query = mysqli_query($db, "UPDATE recetas SET autor='$aut', categoria='$cat', ingredientes='$ing', preparacion='$pas', descripcion='$des' WHERE titulo='$tit'") or die('Error modificar' .mysqli_error($db));
              echo "<p>La receta $tit se ha modificado correctamente</p>";
            }

            else {
                echo "<p>Los datos no se han modificado</p>";
            }
            break;
        case 'delete':
            if(!ErrorBorrado())
            {
                $tit_borrar = mysqli_real_escape_string($db, $_POST['tit_elim']);
                $query = mysqli_query($db, "DELETE FROM recetas WHERE titulo='$tit_borrar'") or die('Error borrado' .mysqli_error($db));

                echo "<p>La receta $tit_borrar eliminada correctamente</p>";
            }
            else {
              echo "<p>La receta no se ha eliminado</p>";
            }

            break;
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
           echo "<p class=\"error\">Los datos introducidos no son válidos</p>";
            $error = true;
          }
    }

    else{
        $error = true;
        echo "<p class=\"error\">Los datos introducidos no son válidos</p>";
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
            echo "<p class=\"error\">Los datos no son válidos</p>";
          }

    }

    else{
        $error = true;
        echo "<p class=\"error\">Los datos no son válidos</p>";
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
            echo "<p class=\"error\">No se ha introducido ningún título</p>";
          }
    }

    else{
        $error = true;
        echo "<p class=\"error\">El titulo introducido no es válido</p>";
    }

    return $error;
}

include_once "aside.php";
include_once "footer.html";
include_once "end.html";

?>
