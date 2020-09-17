<?php

$to = 'sharathreddy@stepnstones.in';
    //$to = 'conroy.fernandes@anklesaria.com';
    $from = 'sharathreddy@stepnstones.in';
    $fromName = 'Sharath';
    $subject = "Creating New Project";
    $htmlContent = '<h5>hi</h5>';
    $headers = "From: Aim&Drive\r\n";
    $headers .= "Reply-To: $from\r\n";
    $headers .= "Return-Path: $from\r\n";
    $headers .= 'X-Mailer: PHP/' . phpversion();
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

    // Additional headers 
    // $headers .= 'From: '.$fromName.'<'.$from.'>' . "\r\n"; 
    // $headers .= 'Cc: vijay@stepnstones.in' . "\r\n"; 
    // $headers .= 'Bcc: welcome2@example.com' . "\r\n"; 

    //Send email 
mail($to, $subject, $htmlContent, $headers);
    


// $to = 'vijay@stepnstones.in';
// $title = 'title of mail';
// $content = 'hello from world';
// $titles = 'From: sendfrom@outlook.com' . "\r\n" .
//     'Reply-To: sendfrom@outlook.com' . "\r\n" .
//     'X-Mailer: PHP/' .phpversion();
// mail($to, $title, $content, $titles);
?>