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

 $q2="SELECT COUNT(*) TOTAL, SUM(selected) SEL , SUM(ss_dropped) DRP ,  SUM(CASE WHEN ss_status='ETERNAL' THEN 1 ELSE 0 END ) ET FROM `strategy_statement` WHERE  pjid IN (SELECT pjid FROM project WHERE pj_status<>'INACTIVE') AND pjid IN (". $_REQUEST["project"] .")";

// $q2 ="SELECT COUNT(*) TOTAL, SUM(CASE WHEN selected=1 AND ss_dropped=0 THEN 1 ELSE 0 END) SEL , SUM(CASE WHEN ss_dropped=1 AND selected=0 AND ss_status<>'ETERNAL'  THEN 1 ELSE 0 END) DRP , SUM(CASE WHEN selected=0 AND ss_status<>'ETERNAL' AND ss_dropped<>1  THEN 1 ELSE 0 END) UNSEL,  SUM(CASE WHEN ss_status='ETERNAL' THEN 1 ELSE 0 END ) ET FROM `strategy_statement` WHERE  pjid IN (SELECT pjid FROM project WHERE pj_status<>'INACTIVE') AND pjid IN (". $_REQUEST["project"] .")";

$result2=obtain_query_result($q2);

while($row2= mysqli_fetch_assoc($result2)) {
 
 $Selected = $row2['SEL'];
 //$Unselected = $row2['UNSEL'];
 //$Dropped = $row2['DRP'];
 $Dropped = $row2['TOTAL'] - ($row2['SEL'] + $row2['ET']);
 $Eternal = $row2['ET'];


}

// $q3 ="SELECT *, (Scheduled-Implemented) Onsceduled  FROM (
//     SELECT 
// 	COUNT(ssid) TotalSS,
//     SUM(CASE WHEN Completed=TotalAction THEN 1 ELSE 0 END) Implemented,
//     SUM(CASE WHEN Outstanding > Ontime  THEN 1 ELSE 0 END)  BehindSchedule,
//     SUM(CASE WHEN Outstanding > Ontime THEN 0 ELSE 1 END)  Scheduled
//     FROM (
//     SELECT ssid,
//     (SELECT COUNT(actionid) FROM action WHERE ssid=A.ssid) TotalAction,
//     (SELECT COUNT(*) FROM action WHERE completiontime IS NOT NULL AND ssid=A.ssid) Completed,
//     (SELECT COUNT(*) FROM action WHERE deadline < now() AND completiontime IS NULL AND ssid=A.ssid) Outstanding,
//      (SELECT COUNT(*) FROM action WHERE (deadline IS NULL or deadline > now()) AND completiontime IS NULL AND ssid=A.ssid) Ontime
//     FROM strategy_statement A WHERE selected=1 AND pjid IN (SELECT pjid FROM project WHERE pj_status<>'INACTIVE') AND pjid IN (". $_REQUEST["project"] .") GROUP BY ssid ) B) C";

$q3 ="SELECT COUNT(*) TotalSS, 
SUM(ss_complete) Implemented,
SUM(CASE WHEN ss_enddate < now() AND ss_complete=0 AND (ss_dropped=0 AND ss_unimplement=0)  THEN 1 ELSE 0 END) BehindSchedule,
SUM(CASE WHEN (ss_enddate >= now() or ss_enddate IS NULL) AND ss_complete=0 AND (ss_dropped=0 AND ss_unimplement=0)  THEN 1 ELSE 0 END) Onsceduled,
SUM(CASE WHEN ss_dropped = 1 OR ss_unimplement = 1 THEN 1 ELSE 0 END) Unselected
FROM `strategy_statement` WHERE selected = 1  AND pjid IN (SELECT pjid FROM project WHERE pj_status<>'INACTIVE' AND pjid IN (". $_REQUEST["project"] .") )";

$result3=obtain_query_result($q3);

while($row3= mysqli_fetch_assoc($result3)) {
    $Implemented = $row3['Implemented'];
    $Onsceduled = $row3['Onsceduled'];
    $BehindSchedule = $row3['BehindSchedule'];
    $UnselectedSS = $row3['Unselected'];
}

$com = array(
    mb_convert_encoding($identified,'UTF-8','UTF-8'),
    mb_convert_encoding($realized,'UTF-8','UTF-8'),
    mb_convert_encoding($Selected,'UTF-8','UTF-8'),
   // mb_convert_encoding($Unselected,'UTF-8','UTF-8'),
    mb_convert_encoding($Dropped,'UTF-8','UTF-8'),
    mb_convert_encoding($Eternal,'UTF-8','UTF-8'),
    mb_convert_encoding($Implemented,'UTF-8','UTF-8'),
    mb_convert_encoding($Onsceduled,'UTF-8','UTF-8'),
    mb_convert_encoding($BehindSchedule,'UTF-8','UTF-8'),
    mb_convert_encoding($UnselectedSS,'UTF-8','UTF-8'),


);


$output = $com;
// echo 'high';
// echo '<pre>',var_dump(json_encode($output)), '</pre>';
// echo json_last_error();
echo json_encode(array("",$output));
?>
