
<?php

# Include the Autoloader (see "Libraries" for install instructions)
require 'vendor/autoload.php';
use Mailgun\Mailgun;
# Instantiate the client.
$mgClient = new Mailgun('8f340fc507082efe5f1f050c65077f84-0d2e38f7-42ab1d7d');
$domain = "mail.anklesaria.com";
# Make the call to the client.
$result = $mgClient->sendMessage($domain, array(
    'from'  => 'Excited User <sharathreddy@stepnstones.in>',
    'to'    => 'Baz <sharathreddy@stepnstones.in>',
    'subject' => 'Hello',
    'text'  => 'Final Testing some Mailgun awesomness!'
));


?>
