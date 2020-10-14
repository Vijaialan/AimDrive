<?php

function CreateHtml($Content)
{
  $htmlbody = '
  <html lang="en">
  <head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
  #customers {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 65%;
  }
  
  #customers td, #customers th {
    border: 1px solid #ddd;
    padding: 8px;
  }
  
  #customers tr:nth-child(even){background-color: #f2f2f2;}
  
  #customers tr:hover {background-color: #ddd;}
  
  #customers th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: center;
    background-color: #2b4b75;
    color: white;
  }
  .footer {
    left: 0;
    bottom: 0;
    width: 65%;
    background-color: #2b4b75;
    color: white;
    text-align: center;
  }
  </style>
  </head>
  <body><section>
  <h3 id="subject">' . $Content['mailIntro'] . '</h3><table id="customers"><th colspan="2"> AIM&DRIVE </h>';
  
  $Title = array_keys($Content);
  $Data  = array_values($Content);

  $ContentTable = "";
  $mailkeys = array('to_name', 'email', 'mailIntro', 'subject', 'mailAction');

  foreach ($Title as $index => $code) {
    if (in_array($code, $mailkeys))  continue; # Skips
    $ContentTable .= '<tr>
    <td style="width: 30%;"><p>' . preg_replace('/(?<!\ )[A-Z]/', ' $0', $code) . '</p></td> 
    
    <td style="width: 70%;"><p>' . $Data[$index] . '</p></td> 
    </tr>';
  }


  $footer = '</table></section>
  <footer class="footer"><p>Copyright © 2020-2021 Aim&Drive, All Rights Reserved.</p></footer></body></html>';

  //return full html content
  return $htmlbody . $ContentTable . $footer;
}


?>