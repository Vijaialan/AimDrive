<?php

$to = 'vija@stepnstones.in';
$title = 'title of mail';
$content = 'hello from world';
$titles = 'From: admin@anklesaria.com' . "\r\n" .
    'Reply-To: admin@anklesaria.com' . "\r\n" .
    'X-Mailer: PHP/' .phpversion();
mail($to, $title, $content, $titles);
?>
?>

