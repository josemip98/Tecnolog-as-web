<?php
require("class.phpmailer.php");
require("class.smtp.php");

function Send_Mail($to,$subject,$body)
{
$from       = "from@yourwebsite.com";
$mail       = new PHPMailer();
$mail->IsSMTP(true);            // use SMTP
$mail->IsHTML(true);
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->Host       = "tls://smtp.mailtrap.io"; // SMTP host
$mail->Port       =  465;                    // set the SMTP port
$mail->Username   = "55df9471b806c2";  // SMTP  username
$mail->Password   = "a8260bef6286f6";  // SMTP password
$mail->SetFrom($from, 'From Name');
$mail->AddReplyTo($from,'From Name');
$mail->Subject    = $subject;
$mail->MsgHTML($body);
$address = $to;
$mail->AddAddress($address, $to);
$mail->Send();
}
?>
