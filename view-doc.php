<?php
// [company bu project] doc.
// (setf output (ad::modify-doc document (ad::theperson who) title desc))
require 'CONNECT_TO_DB.php';
//$row is the row of person for this user
//$admin is "admin" if the person works for CMS, otherwise ""
$row1 = $row; // save it for later
$coid=getcompany();
$buid=getbu();
$pjid=getproject();
if(array_key_exists ("document",$_REQUEST)){
  $docid=slashquote($_REQUEST["document"]);
}else{
  missing("document");
}
if(is_numeric($docid)){
  $docid=intval($docid);
} else{
  die('["ERROR", "non-numeric value for document"]');
}
$q="select * from document where coid=$coid and buid=$buid and pjid=$pjid
  and docid=$docid";
$result=obtain_query_result($q);
if(! $row=mysqli_fetch_assoc($result)) {
  die('["ERROR", "Document not found"]');
}
if($admin!="admin"){
  // logged in user must be on team of project
  $q="select * from project_team where
  coid=$coid and buid=$buid and pjid=$pjid and personid=" . $row1['pnid'];
  $result=obtain_query_result($q);
  if(!mysqli_fetch_assoc($result)) {
    die('["ERROR", "not permitted"]');
  }
}
$ctype=exec("file -i -b uploads/$coid-$buid-$pjid-$docid");

$fn=$row['filename'];
$filepath = "uploads/$coid-$buid-$pjid-$docid";

// Process download  09/11/2020
if(file_exists($filepath)) {
//$mime='vnd.ms-excel';
ob_end_clean(); // this is solution
header('Content-Description: File Transfer');
header("Content-Type: $ctype");
//header('Content-Type: application/octet-stream');
header("Content-Transfer-Encoding: Binary");
header("Content-disposition: attachment; filename=\"" . basename($fn) . "\"");
header('Content-Transfer-Encoding: binary');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
readfile($filepath);
  die();
} else {
  http_response_code(404);
die();
}

?>
