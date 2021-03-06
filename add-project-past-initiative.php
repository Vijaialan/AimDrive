<?php
// 2017-07 used add-ss as template
// [company bu] project description startyear identifiedval deliveredval status
require 'CONNECT_TO_DB.php';
//$row is the row of person for this user
//$admin is "admin" if the person works for CMS, otherwise ""
if($admin!="admin"){
  die('["ERROR", "You are not permitted to do this operation!"]');
}

$coid=getcompany();
$buid=getbu();
$pjid=getproject();

if(array_key_exists ("description",$_REQUEST)){
  $desc=slashquote($_REQUEST["description"]);
}else{
  missing("description");
}
if(array_key_exists ("startyear",$_REQUEST)){
  $startyr=slashquote($_REQUEST["startyear"]);
}else{
  missing("startyear");
}
if(array_key_exists ("status",$_REQUEST)){
  $stat=slashquote($_REQUEST["status"]);
}else{
  missing("status");
}
if(array_key_exists ("identifiedval",$_REQUEST)
   && is_numeric($_REQUEST["identifiedval"])){
  $idval=floatval($_REQUEST["identifiedval"]);
}else{
  missing("identifiedval");
}
if(array_key_exists ("deliveredval",$_REQUEST)
   && is_numeric($_REQUEST["deliveredval"])){
  $delval=floatval($_REQUEST["deliveredval"]);
}else{
  missing("deliveredval");
}

$q="select * from project where
 coid=$coid and buid=$buid and pjid=$pjid";
$result=obtain_query_result($q);
if(!mysqli_fetch_assoc($result)) {
  die('["ERROR", "Project does not exist!"]');
}

$q="insert into project_past_initiative set
 coid=$coid, buid=$buid, pjid=$pjid, description='$desc',start_year='$startyr',
 status='$stat',identified_value='$idval',delivered_value='$delval'";
$result=obtain_query_result($q);

$q="select last_insert_id() newid";
$result=obtain_query_result($q);
if($row=mysqli_fetch_assoc($result)) {
  die(json_encode(array("",$row['newid']))); // success
}else{
  die('["ERROR", "insert did not return a new row!"]');
}

?>
