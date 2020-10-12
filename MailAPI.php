<?php
//require 'vendor/autoload.php'; // If you're using Composer (recommended)
// Comment out the above line if not using Composer
//require 'vendor/autoload.php';
require "sendgrid/sendgrid-php.php";

// require_once 'MailApiKey.php';
// If not using Composer, uncomment the above line and
// download sendgrid-php.zip from the latest release here,
// replacing <PATH TO> with the path to the sendgrid-php.php file,
// which is included in the download:
// https://github.com/sendgrid/sendgrid-php/releases
//require_once 'dbconfig.php';

require_once '/var/secure/MailApiKey.php';

$emailid = array("vijaialan07@gmail.com", "sharathreddy@stepnstones.in","vijaialan.mca@gmail.com");

$email = new \SendGrid\Mail\Mail(); 
$email->setFrom("conroy.fernandes@anklesaria.com", "Conroy");
$email->setSubject("Test New Mail Action ");
$email->addTo("vijay@stepnstones.in", "Example User");
$email->addBcc($emailid, "Test");
$email->addContent("text/plain", "and easy to do anywhere, even with PHP");
$email->addContent("text/html", "<strong>and easy to do anywhere, even with PHP</strong>"
);

$sendgrid = new \SendGrid($Sendgrid);

try {
    $response = $sendgrid->send($email);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: '. $e->getMessage() ."\n";
}