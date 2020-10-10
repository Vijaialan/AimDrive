<?php
require 'mail_content.php';
//echo $sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));

//for mail function
class MailFunction
{
  function SendMail($uemail)
  {

    $to = 'sharathreddy@stepnstones.in';
    //$to = 'conroy.fernandes@anklesaria.com';
    $from = 'sharathreddy@stepnstones.in';
    $fromName = 'Admin ';
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
    // $myfile = file_put_contents('logs.txt', $from.PHP_EOL , FILE_APPEND | LOCK_EX);
    // return $mgs;

  }
}


//22 - Assign Action Item Owner
if ($_POST['mailAction'] == 'actionOwner') {
  $body_message = CreateHtml($_POST);
  $email_data = array(
    'to' => $_POST['email'],
    'to_name' => '',
    'subject' => 'AIM&DRIVE: Action Item Owners assigned for ' . $_POST['pname'],
    'message' => $body_message,
  );
  //print_r($email_data);
  //$email_response = sendEmailNew($email_data); 
  //var_dump($email_response); 
}


//11 - Participant is added to a new task
if ($_POST['mailAction'] == 'taskParticipant') {
  $body_message = CreateHtml($_POST);
  $email_data = array(
    'to' => $_POST['EmailId'][0],
    'to_name' => '',
    'bcc' => implode(', ', $_POST['EmailId']),
    'subject' => 'AIM&DRIVE: Project Setup Tasks assigned for ' . $_POST['ProjectName'],
    'message' => $body_message,
  );
  print_r($email_data);
  $email_response = sendEmailNew($email_data); 
  var_dump($email_response); 
}









/* Send email */
function sendEmailNew($email_data)
{

  require "sendgrid/sendgrid-php.php";
  require_once '/var/secure/MailApiKey.php';

  $email = new \SendGrid\Mail\Mail();
  $email->setFrom("conroy.fernandes@anklesaria.com", "AimDrive");
  $email->setSubject($email_data['subject']);
  $email->addTo($email_data['to'], "Admin");
  //$email->addBcc($email_data['bcc']);
  //$email->addContent("text/plain", $email_data['message']);
  $email->addContent("text/html", $email_data['message']);

  //$sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));

  $sendgrid = new \SendGrid($Sendgrid);
  try {
    $response = $sendgrid->send($email);
    return $response;
  } catch (Exception $e) {
    return $e->getMessage();
  }
}


// function sendMainGun(){
  
// # Include the Autoloader (see "Libraries" for install instructions)
// require 'vendor/autoload.php';
// require_once '/var/secure/MailApiKey.php';
// //require 'C:/xampp/htdocs/API/TEST.PHP';

// use Mailgun\Mailgun;
// # Instantiate the client.
// $mgClient = new Mailgun($Mailgun);
// $domain = "mail.anklesaria.com";
// # Make the call to the client.
// $result = $mgClient->sendMessage($domain, array(
//     'from'  => 'New Mail  <sharathreddy@stepnstones.in>',
//     'to'    => 'Test Mail <sharathreddy@stepnstones.in>',
//     'subject' => 'Hello',
//     'text'  => 'Final Testing some Mailgun awesomness!'
// ));

// }
