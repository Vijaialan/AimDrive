<?php

$to = 'vijay@stepnstones.in';
$title = 'title of mail';
$content = 'hello from world';
$titles = 'From: admin@anklesaria.com' . "\r\n" .
    'Reply-To: admin@anklesaria.com' . "\r\n" .
    'X-Mailer: PHP/' .phpversion();
mail($to, $title, $content, $titles);


?>



<?php
    //ini_set( 'display_errors', 1 );
    //error_reporting( E_ALL );
    $from = "vijay@stepnstones.in";
    $to = "vijaialan07@gmail.com";
    $subject = "PHP Mail Test script";
    $message = "This is a test to check the PHP Mail functionality";
    $headers = "From:" . $from;
$headers .= "Reply-To: $to";
    var_dump(mail($to,$subject,$message,$headers));

    ?>
