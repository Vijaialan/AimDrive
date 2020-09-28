<?php

//echo $sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));

//for mail function
class MailFunction
{
  function SendMail($uemail)
  {

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
    ///mail($to, $subject, $htmlContent, $headers);

    $myfile = file_put_contents('logs.txt', $from.PHP_EOL , FILE_APPEND | LOCK_EX);
    //return $mgs;

  }
}

/* Send email */
function sendEmailNew($email_data) {
  require("sendgrid/sendgrid-php.php");
  $email = new \SendGrid\Mail\Mail(); 
  $email->setFrom("vijay@stepnstones.in", "Stepnstones");
  $email->setSubject($email_data['subject']);
  $email->addTo($email_data['to'], $email_data['to_name']);
  //$email->addContent("text/plain", $email_data['message']);
  $email->addContent("text/html", $email_data['message']);


  //$sendgrid = new \SendGrid("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"); //
  //$sendgrid = new \SendGrid("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"); //Sheetal
    $sendgrid = new \SendGrid("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"); //Vijay
  //echo $sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));

  try {
      $response = $sendgrid->send($email);
      return $response;
  } catch (Exception $e) {
      return $e->getMessage();
  }
}

?>