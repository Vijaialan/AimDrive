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
    width: 100%;
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
    padding-top: 0.3px;
    padding-bottom: 0.3px;
    text-align: center;
    background-color: #2b4b75;
    color: white;
  }
  </style>
  </head>
  <body><section>
  <h3 id="subject">' . $Content['mailIntro'] . '</h3><table id="customers"><th colspan="2"> AIM&DRIVE <sup>&#174;</sup></th>';

  $Title = array_keys($Content);
  $Data  = array_values($Content);

  $ContentTable = "";
  $mailkeys = array('to_name', 'email', 'mailIntro', 'subject', 'mailAction', 'ActionOwners');

  foreach ($Title as $index => $code) {
    if (in_array($code, $mailkeys))  continue; # Skips
    $ContentTable .= '<tr>
    <td style="width: 30%;"><p>' . preg_replace('/(?<!\ )[A-Z]/', ' $0', $code) . '</p></td>    
    <td style="width: 70%;"><p>' . $Data[$index] . '</p></td> 
    </tr>';
  }

  $footer = '</table></section>
  <table id="customers"> 
  <th colspan="2">Copyright © '. date("Y").'-'.date("Y",strtotime("+1 year")).' AIM&DRIVE<sup>&#174;</sup>, All Rights Reserved.</th>
  </table></body></html>';

  //return full html content
  return $htmlbody . $ContentTable . $footer;
}

