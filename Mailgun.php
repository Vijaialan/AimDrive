
<?php

# Include the Autoloader (see "Libraries" for install instructions)
require 'vendor/autoload.php';
use Mailgun\Mailgun;
# Instantiate the client.
$mgClient = new Mailgun($Mailgun);

$domain = "mail.anklesaria.com";
# Make the call to the client.
$result = $mgClient->sendMessage($domain, array(
    'from'  => 'New Mail  <sharathreddy@stepnstones.in>',
    'to'    => 'Play Boy <sharathreddy@stepnstones.in>',
    'subject' => 'Hello',
    'text'  => 'Final Testing some Mailgun awesomness!'
));


?>
