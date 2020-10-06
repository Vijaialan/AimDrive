<?php

$to = 'vija@stepnstones.in';
$title = 'title of mail';
$content = 'hello from world';
$titles = 'From: admin@anklesaria.com' . "\r\n" .
    'Reply-To: admin@anklesaria.com' . "\r\n" .
    'X-Mailer: PHP/' .phpversion();
mail($to, $title, $content, $titles);


?>



<?php
    ini_set( 'display_errors', 1 );
    error_reporting( E_ALL );
    $from = "vija@stepnstones.in";
    $to = "vija@stepnstones.in";
    $subject = "PHP Mail Test script";
    $message = "This is a test to check the PHP Mail functionality";
    $headers = "From:" . $from;
$headers .= "Reply-To: $to";
    var_dump(mail($to,$subject,$message,$headers));

    ?>
    