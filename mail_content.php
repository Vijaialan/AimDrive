<?php

//  $body = CreateHtml('test proj','testing');
//  echo $body;

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
    text-align: left;
    background-color: #4CAF50;
    color: white;
  }
  </style>
  </head>
  <body><section>
  <h3 id="subject">' . $Content['mailIntro'] . '</h3><table id="customers">';

  $Title = array_keys($Content);
  $Data  = array_values($Content);

  $ContentTable = "";
  $mailkeys = array('to_name', 'email', 'mailIntro', 'subject', 'mailAction');

  foreach ($Title as $index => $code) {
    if (in_array($code, $mailkeys))  continue; # Skips
    $ContentTable .= '<tr>
    <td style="width: 28%;"><p>' . preg_replace('/(?<!\ )[A-Z]/', ' $0', $code) . '</p></td> 
    
    <td style="width: 70%;"><p>' . $Data[$index] . '</p></td> 
    </tr>';
  }


  $footer = '</table></section>
  <footer><p>Copyright © 2020-2021 Aim&Drive, All Rights Reserved.</p></footer></body></html>';

  //return full html content
  return $htmlbody . $ContentTable . $footer;
}
