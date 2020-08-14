<?php
require 'CONNECT_TO_DB.php';
//$row is the row of person for this user
//$admin is "admin" if the person works for CMS, otherwise ""

$output=array();
$com=array();
$identified = 0;
$realized = 0; 
// var_dump($employer);

 $q="SELECT IFNULL(SUM(expected_value),0) IDENT  FROM  `ss_benefit`  WHERE ssid IN (SELECT ssid from strategy_statement WHERE selected >0 AND pjid IN (". $_REQUEST["project"] ."))";
$result=obtain_query_result($q);

while($row= mysqli_fetch_assoc($result)) {

 $identified = $row['IDENT'];

}
$q1= "SELECT IFNULL(SUM(value),0) realized FROM `strategy_statement_savings` WHERE pjid IN (". $_REQUEST["project"] .")";
$result1=obtain_query_result($q1);

while($row1= mysqli_fetch_assoc($result1)) {
 
 $realized = $row1['realized'];

}

$com = array(
    mb_convert_encoding($identified,'UTF-8','UTF-8'),
    mb_convert_encoding($realized,'UTF-8','UTF-8')
);


$output = $com;
// echo 'high';
// echo '<pre>',var_dump(json_encode($output)), '</pre>';
// echo json_last_error();
echo json_encode(array("",$output));
?>
