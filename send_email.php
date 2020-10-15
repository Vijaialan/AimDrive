<?php
require 'mail_content.php';
//echo $sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
//5th Participant is selected starts

if ($_POST['mailAction'] == 'ParticipantSelected') {
  $body_message = CreateHtml($_POST);
  $email_data = array(
    'to' => $_POST['email'],
    'subject' => 'AIM&DRIVE: Workshop Participants added for ' . $_POST['ProjectName'],
    'message' => $body_message,
  );
  print_r($email_data);
  //$email_response = sendEmailNew($email_data);
  //var_dump($email_response); 
}
//5th Participant is selected ends
//15th edit ss starts
if ($_POST['mailAction'] == 'ssEditMailData') {
  $body_message = CreateHtml($_POST);
  $email_data = array(
    'to' => $_POST['email'],
    'subject' => 'AIM&DRIVE: Strategy Statement assigned for ' . $_POST['ProjectName'],
    'message' => $body_message,
  );
  //print_r($email_data);
  $email_response = sendEmailNew($email_data);
}
//15th edit ss ends
//28th ss dropped starts
if ($_POST['mailAction'] == 'ssDropped') {
  $body_message = CreateHtml($_POST);
  $email_data = array(
    'to' => $_POST['email'],
    'subject' => 'AIM&DRIVE: Strategy Statement dropped for ' . $_POST['ProjectName'],
    'message' => $body_message,
  );
  //print_r($email_data);
  $email_response = sendEmailNew($email_data);
}
//28th ss dropped ends
//32nd SS is unselected starts
if ($_POST['mailAction'] == 'SSUnSelectImplementation') {
  $body_message = CreateHtml($_POST);
  $email_data = array(
    'to' => $_POST['email'],
    'subject' => 'AIM&DRIVE: Strategy Statement unselected for implementation for ' . $_POST['ProjectName'],
    'message' => $body_message,
  );
  //print_r($email_data);
  $email_response = sendEmailNew($email_data);
}
//32nd SS is unselected ends
//34th Value Realized is updated for a SS starts
if ($_POST['mailAction'] == 'SSvalueRelizedUpdate') {
  $body_message = CreateHtml($_POST);
  $email_data = array(
    'to' => $_POST['email'],
    'subject' => 'AIM&DRIVE: Value Realized for ' . $_POST['ProjectName'],
    'message' => $body_message,
  );
  //print_r($email_data);
  $email_response = sendEmailNew($email_data);
}
//34th Value Realized is updated for a SS ends

//---------------------------Second day update -------------------------//
//35th Action Item is marked as complete starts
if ($_POST['mailAction'] == 'ActionItemCompleted') {
  $body_message = CreateHtml($_POST);
  $email_data = array(
    'to' => $_POST['email'],
    'subject' => 'AIM&DRIVE: Action Item completed for ' . $_POST['ProjectName'],
    'message' => $body_message,
  );
  //print_r($email_data);
  $email_response = sendEmailNew($email_data); 
}
//35th Action Item is marked as complete ends
//36th Action Item is dropped starts
if ($_POST['mailAction'] == 'ActionItemDropped') {
  $single_id = array($_POST['email']);
  $extra_ids = $_POST['ActionOwners'];
  $multi_mail_id = array_merge($single_id, $extra_ids);
  //print_r($multi_mail_id);
  for ($i = 0; $i < count($multi_mail_id); $i++) {
    $body_message = CreateHtml($_POST);
    $email_data = array(
      'to' => $multi_mail_id[$i],
      'subject' => 'AIM&DRIVE: Action Item completed for ' . $_POST['ProjectName'],
      'message' => $body_message,
    );
    //print_r($email_data);
    $email_response = sendEmailNew($email_data);
  }
}
//36th Action Item is dropped ends
//38th Action Item progess percentage is updated starts
if ($_POST['mailAction'] == 'ActionItemUpdated') {
  $body_message = CreateHtml($_POST);
  $email_data = array(
    'to' => $_POST['email'],
    'subject' => 'AIM&DRIVE: Action Item Progress updated for ' . $_POST['ProjectName'],
    'message' => $body_message,
  );
  //print_r($email_data);
  $email_response = sendEmailNew($email_data);
}
//38th Action Item progess percentage is updated starts
//02nd New Project is created starts
if ($_POST['mailAction'] == 'NewProjectCreated') {
  $body_message = CreateHtml($_POST);
  $email_data = array(
    'to' => $_POST['email'],
    'subject' => 'AIM&DRIVE: New Project Created',
    'message' => $body_message,
  );
  //print_r($email_data);
  $email_response = sendEmailNew($email_data);
}
//02nd New Project is created ends 
//03rd Participant is newly added starts 
if ($_POST['mailAction'] == 'NewParticipantadded') {
  $body_message = CreateHtml($_POST);
  $email_data = array(
    'to' => $_POST['email'],
    'subject' => 'AIM&DRIVE: Stakeholder added for ' . $_POST['ProjectName'],
    'message' => $body_message,
  );
  //print_r($email_data);
  $email_response = sendEmailNew($email_data);
}
//03rd Participant is newly added ends

//SNS - 13
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
  $email_response = sendEmailNew($email_data); 
  //var_dump($email_response); 
}
//11 - Participant is added to a new task
if ($_POST['mailAction'] == 'taskParticipant') {

  $body_message = CreateHtml($_POST);
  $email_data = array(
    'to' => $_POST['email'][0],
    //'to' => implode(', ', $_POST['email']),
    'to_name' => '',
    'subject' => 'AIM&DRIVE: Project Setup Tasks assigned for ' . $_POST['ProjectName'],
    'message' => $body_message,
  );
  //print_r($email_data);
  $email_response = sendEmailNew($email_data);
  //var_dump($email_response); 
}









/* Send email */
function sendEmailNew($email_data)
{

  require "sendgrid/sendgrid-php.php";
  require_once '/var/secure/MailApiKey.php';

  $email = new \SendGrid\Mail\Mail();
  $email->setFrom("conroy.fernandes@anklesaria.com", "AIM&DRIVE");
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
