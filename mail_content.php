<style>
  * {
    box-sizing: border-box;
  }

  body {
    font-family: Arial, Helvetica, sans-serif;
    width: 60%;
  }

  /* Style the header */
  header {
    background-color: #6bb3f7;
    padding: 10px;
    text-align: center;
    color: white;
  }

  section {
    width: 90%;
    text-align: center;
    margin: auto;
  }

  /* Style the footer */
  footer {
    background-color: #6bb3f7;
    padding: 10px;
    text-align: center;
    color: white;
  }

  tr {
    line-height: 25px;
  }

  #subject {
    text-align: center;
  }

  /* Responsive layout - makes the two columns/boxes stack on top of each other instead of next to each other, on small screens */
  @media (max-width: 600px) {

    nav,
    article {
      width: 100%;
      height: auto;
    }
  }
</style>
<?php


//  $body = CreateHtml('test proj','testing');
//  echo $body;
function CreateHtml($Content)
{
  $htmlbody = '
<html lang="en">
  <head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"></head>
  <body><header><img src="images/logo_big.png"></header><section><table>
  <h3 id="subject">You have been added to the Project ' . $Content['ProjectName'] . '</h3>
      
                    <tr>
                        <td style="width: 30%;"><p>Project name : </p></td> 
                        <td style="width: 70%;"><p>' . $Content['ProjectName'] . '</p></td> 
                    </tr>
  
                      <tr>
                        <td style="width: 30%;"><p>Project Description : </p></td> 
                        <td style="width: 70%;"><p>' . $Content['TaskDescription'] . '</p></td> 
                    </tr>
  
                    <tr>
                        <td style="width: 30%;"><p>Supplier Name : </p></td> 
                        <td ><p>' . $Content['TaskDescription'] . '</p></td> 
                    </tr>
  
                     <tr>
                        <td style="width: 30%;"><p>Project Value : </p></td> 
                        <td style="width: 70%;"><p>' . $Content['TaskDescription'] . '</p></td> 
                    </tr> 
                     <tr>
                        <td style="width: 30%;"><p>Start Date : </p></td> 
                        <td style="width: 70%;"><p> ' . $Content['TaskDescription']. '</p></td> 
                    </tr> 
                      
    </table></section>
  <footer><p>Copyright © 2020-2021 Aim&Drive, All Rights Reserved.</p></footer></body></html>';

  return $htmlbody;
}

?>