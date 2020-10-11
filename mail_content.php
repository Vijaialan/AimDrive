<?php

//  $body = CreateHtml('test proj','testing');
//  echo $body;

function CreateHtml($Content)
{
  $htmlbody = '
<html lang="en">
  <head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"></head>
  <body><section>
  <h3 id="subject">'.$Content['mailIntro'].'</h3><table>';

  if(!empty($Content['ProjectName']))
  {
    $Pname = '<tr>
              <td style="width: 30%;"><p>Project name : </p></td> 
              <td style="width: 70%;"><p>' . $Content['ProjectName'] . '</p></td> 
              </tr>';
  }
  if(!empty($Content['TaskDescription']))
  {
    $TaskDesc = '<tr>
                <td style="width: 30%;"><p>Task Description : </p></td> 
                <td style="width: 70%;"><p>' . $Content['TaskDescription'] . '</p></td> 
                </tr>';
  }
  if(!empty($Content['DueDate']))
  {
    $DueDate = '<tr>
                <td style="width: 30%;"><p>Due Date  : </p></td> 
                <td style="width: 70%;"><p>' . $Content['DueDate'] . '</p></td> 
               </tr>';
  }
  if(!empty($Content['ProcessStep']))
  {
    
    $ProcessStep = '<tr>
                    <td style="width: 30%;"><p>Process Step : </p></td> 
                    <td style="width: 70%;"><p>' . $Content['ProcessStep'] . '</p></td> 
                    </tr>'; 
  }
              
  $bodyContent = $Pname . $TaskDesc . $DueDate . $ProcessStep;
                      
  $footer = '</table></section>
  <footer><p>Copyright © 2020-2021 Aim&Drive, All Rights Reserved.</p></footer></body></html>';

  //return full html content
  return $htmlbody . $bodyContent . $footer;
}

?>