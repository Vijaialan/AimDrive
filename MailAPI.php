<?php
//require 'vendor/autoload.php'; // If you're using Composer (recommended)
// Comment out the above line if not using Composer
 require("sendgrid/sendgrid-php.php");
// If not using Composer, uncomment the above line and
// download sendgrid-php.zip from the latest release here,
// replacing <PATH TO> with the path to the sendgrid-php.php file,
// which is included in the download:
// https://github.com/sendgrid/sendgrid-php/releases

$email = new \SendGrid\Mail\Mail(); 
$email->setFrom("vijay@stepnstones.in", "Example User");
$email->setSubject("Test New Mail AIM KEY");
$email->addTo("vijay@stepnstones.in", "Example User");
$email->addContent("text/plain", "and easy to do anywhere, even with PHP");
$email->addContent(
    "text/html", "<strong>and easy to do anywhere, even with PHP</strong>"
);

// echo "export SENDGRID_API_KEY='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'" > sendgrid.env
// echo "sendgrid.env" >> .gitignore
// source ./sendgrid.env

//echo $SENDGRID_API_KEY;

//$sendgrid = new \SendGrid("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"); //Vijay

//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
//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

//$sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));

echo $sendgrid = new \SendGrid("'".$SENDGRID_API_KEY."'");

try {
    $response = $sendgrid->send($email);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: '. $e->getMessage() ."\n";
}