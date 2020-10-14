<?php
include 'conectarBD.php';

$msg='Pagina verificación';
if(!empty($_GET['code']) && isset($_GET['code']))
{
$code=mysqli_real_escape_string($connection,$_GET['code']);
$c=mysqli_query($connection,"SELECT id FROM usuarios WHERE email='$code'");

if(mysqli_num_rows($c) > 0)
{
$count=mysqli_query($connection,"SELECT id FROM usuarios WHERE email='$code' and status='0'");

if(mysqli_num_rows($count) == 1)
{
mysqli_query($connection,"UPDATE usuarios SET estado='true' WHERE email='$code'");
$msg="Your account is activated";
}
else
{
$msg ="Your account is already active, no need to activate again";
}

}
else
{
$msg ="Wrong activation code.";
}

}
?>
<?php echo $msg; ?>
