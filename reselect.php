<?php
include 'dbUtils.php';
$ssData = json_decode($_REQUEST['data']);
$query = "SELECT * FROM person WHERE email_address = '$ssData->username' AND loginid = '$ssData->token'";
$loginData = obtain_query_result($query, $con);
// var_dump($loginData);
$currentTime = date('Y-m-d H:i:s', time());
if($loginData === NULL) {
    die(json_encode(array("ERROR", "invalid token: Please refresh the page to login ")));
}
// if($loginData['employer'] !== "1" && $loginData['role'] !== "1" ) {
//     die(json_encode(array("ERROR", "You are not an admin ")));
// }
$reselect_by = $loginData['pnid'];
$sql = "UPDATE strategy_statement SET ss_unimplement = 0, reselect_date = '$currentTime',  reselect_by = $reselect_by WHERE ssid = $ssData->currentSS";
var_dump($sql);
updateData($sql, $con);
echo '["",""]';
?>