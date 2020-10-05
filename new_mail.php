<?php
require("class.phpmailer.php");
$maill = new PHPMailer();
$maill->Host = 'bmtcscheduler.com'; 
$maill->SMTPAuth = true;
$maill->Username = 'sharathreddy2009@gmail.com';                 // SMTP username
$maill->Password = 'tn09at355';
//$maill->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$maill->Port = 587;  
   $maill->From       = 'bdragon164@gmail.com';
    $maill->FromName   = 'KPCL';
    $maill->AddAddress("vijaialan07@gmail.com");
    $maill->IsHTML(true);
$maill->Subject = 'Thank you for registering with KPCL';
$maill->Body = '<h3>this is testing</h3>';

$maill->SMTPDebug  = 1;



if(!$maill->Send())
{
 echo "ERROOR"; 
}

?>

