<?php

// $to = 'vijay@stepnstones.in';
//     //$to = 'conroy.fernandes@anklesaria.com';
//     $from = 'sharathreddy@stepnstones.in';
//     $fromName = 'Sharath';
//     $subject = "Creating New Project";
//     $htmlContent = '<h5>test 123 45 </h5>';
//     $headers = "From: Aim&Drive\r\n";
//     $headers .= "Reply-To: $from\r\n";
//     $headers .= "Return-Path: $from\r\n";
//     $headers .= 'X-Mailer: PHP/' . phpversion();
//     $headers .= "MIME-Version: 1.0\r\n";
//     $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

//     // Additional headers 
//     // $headers .= 'From: '.$fromName.'<'.$from.'>' . "\r\n"; 
//     // $headers .= 'Cc: vijay@stepnstones.in' . "\r\n"; 
//     // $headers .= 'Bcc: welcome2@example.com' . "\r\n"; 

//     //Send email 
// if(mail($to, $subject, $htmlContent, $headers))
// {
//     echo 'Success';
// }
// else{
//     echo 'Fail';
// }

    


$to = 'vijay@stepnstones.in';
$title = 'title of mail';
$content = 'hello from world';
$titles = 'From: sathish@stepnstones.in' . "\r\n" .
    'Reply-To: sathish@stepnstones.in' . "\r\n" .
    'X-Mailer: PHP/' .phpversion();
mail($to, $title, $content, $titles);
?>