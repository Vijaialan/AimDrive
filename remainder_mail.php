<?php
// ALL REMAINDER MAIL FUNCTION 
require_once 'dbconfig.php';
//require 'send_email.php';

date_default_timezone_set("Europe/London");
mysqli_set_charset($con, "utf8");
$curDate = date("Y-m-d");

//7 , 9 Session is coming up in 5 working day & 1 day
$work_plan = "SELECT *, DATE(starttime) wp_date, TIME(starttime) stTime  FROM `project_meeting`  A, project_meeting_participant  B, project C  WHERE A.pjid=B.pjid AND B.pjid=C.pjid AND length(participant)>0 AND A.pjid IN (38,40,41)";
$wp_result = mysqli_query($con, $work_plan);
while ($wp_row = mysqli_fetch_array($wp_result)) {
    $MailAction = 0;
    $wpData = array(
        'ProjectName' => $wp_row['pj_name'],
        'Agenda' => $wp_row['agenda'],
        'ProcessStep' => $wp_row['step'],
        'SessionType' => $wp_row['meeting_type'],
        'Date' => getDateFromat($wp_row['wp_date']),
        'Time' => $wp_row['stTime'],
        'Location' => $wp_row['location'],
        'to_name' => 'Participant'
    );

    if ($curDate >=  $wp_row['wp_date']) {

        $days = getdateDiff($curDate, $wp_row['wp_date']);
        if (1 == 1)
        //if ($days == 5) 
        {
            $MailAction = 1;
            $wpData = array_merge(
                $wpData,
                array(
                    "email" => getParticipant($con, $wp_row['participant']),
                    "subject" => "AIM&DRIVE: Reminder for Workshop Session Scheduled for " . $wp_row['pj_name'] . " on " . $wp_row['starttime'],
                    "mailIntro" => 'Workshop Session due in 5 days...!'
                )
            );
        } elseif ($days == 0) {
            $MailAction = 1;
            $wpData = array_merge(
                $wpData,
                array(
                    "email" => getParticipant($con, $wp_row['participant']),
                    "subject" => "AIM&DRIVE: Reminder for Workshop Session Scheduled for " . $wp_row['pj_name'] . " on " . $wp_row['starttime'],
                    "mailIntro" => 'Workshop Session due Today...!'
                )
            );
        }
    }
    // echo json_encode($wpData);
    $email_content = callMailContent($wpData, $MailAction);
    print_r($email_content);
}

// 12, 13 Task assigned to a participant is due in 5 working days
$task = "SELECT A.*, B.*, C.pj_name, DATE(due_date) DUE FROM `project_task` A, project_task_participant B, project C WHERE A.pjid=B.pjid AND B.pjid=C.pjid AND A.pjtaskid=B.pjtaskid AND A.pjid IN (38,40,41) ORDER BY 4 LIMIT 10";
$task_result = mysqli_query($con, $task);
while ($Trow = mysqli_fetch_array($task_result)) {
    $MailAction = 0;
    $taskData = array(
        'ProjectName' => $Trow['pj_name'],
        'TaskDescription' => $Trow['description'],
        'ProcessStep' => $Trow['step'],
        'DueDate' => getDateFromat($Trow['DUE']),
        'to_name' => 'Participant'
    );
    //print_r($taskData);
    //if (1 == 1) 
    if ($curDate >=  $Trow['DUE']) {
        $days = getdateDiff($curDate, $Trow['DUE']);
        //if (1 == 1)
        if ($days == 5) {
            $MailAction = 1;
            $taskData = array_merge(
                $taskData,
                array(
                    "email" => getParticipant($con, $Trow['participant']),
                    "subject" => "AIM&DRIVE: Reminder for Project Setup Tasks for " . $Trow['pj_name'] . " on " . getDateFromat($Trow['DUE']),
                    "mailIntro" => 'Project Setup Task due in 5 days...!'
                )
            );
        } elseif ($days == 0) {
            $MailAction = 1;
            $taskData = array_merge(
                $taskData,
                array(
                    "email" => getParticipant($con, $Trow['participant']),
                    "subject" => "AIM&DRIVE: Reminder for Project Setup Tasks for " . $Trow['pj_name'] . " on " . getDateFromat($Trow['DUE']),
                    "mailIntro" => 'Project Setup Task due today...!'
                )
            );
        }
    }
    //echo json_encode($taskData);
    $email_content = callMailContent($taskData, $MailAction);
    print_r($email_content);
}

//17, 19 SS Target date is due in 5 working days
$SS = "SELECT * FROM `strategy_statement` A, project B WHERE A.pjid=B.pjid AND  `ss_dropped`=0 AND ss_complete=0 AND unimplement=0 AND ss_owner IS NOT NULL AND A.pjid IN (38,40,41) ";
$SS_result = mysqli_query($con, $SS);
while ($SSrow = mysqli_fetch_array($SS_result)) {
    $MailAction = 0;
    $SSData = array(
        'ProjectName' => $SSrow['pj_name'],
        'StrategyStatementNo' => $SSrow['ss_handle'],
        'StrategyStatementDescription' => $SSrow['ss_desc'],
        'StartAndTargetDate' => getDateFromat($SSrow['ss_startdate']) . ' & ' . getDateFromat($SSrow['ss_enddate']),
        'Priority' => $SSrow['priority'],
        'NetPotentialValueIdentified' => '',
        'to_name' => 'Participant'
    );
    if ($curDate >=  $SSrow['ss_enddate']) {
        $days = getdateDiff($curDate, $SSrow['ss_enddate']);
        //if (1 == 1)
        if ($days == 5) {
            $MailAction = 1;
            $SSData = array_merge(
                $SSData,
                array(
                    "email" => getParticipant($con, $SSrow['ss_owner']),
                    "subject" => "AIM&DRIVE: Reminder for Strategy Statement due for completion for " . $SSrow['pj_name'] . " on " . $SSrow['ss_enddate'],
                    "mailIntro" => 'Strategy Statements due for completion in 5 days ...!'
                )
            );
        } elseif ($days == 0) {
            $MailAction = 1;
            $SSData = array_merge(
                $SSData,
                array(
                    "email" => getParticipant($con, $SSrow['ss_owner']),
                    "subject" => "AIM&DRIVE: Reminder for Strategy Statement due for completion for " . $SSrow['pj_name'] . " Today",
                    "mailIntro" => 'Strategy Statements due for completion today...!'
                )
            );
        }
    }
    //json_encode($SSData);
    $email_content = callMailContent($SSData, $MailAction);
    print_r($email_content);
}

//24, 26 Action Item Target date is due in 5 working days
$action = "SELECT actionid, description, responsible, DATE(deadline) Adeadline, A.ssid, ss_handle ,ss_desc, pj_name FROM action A, strategy_statement B, project C WHERE dropped=0 AND completed=0 AND deadline IS NOT NULL AND A.ssid=B.ssid AND A.pjid=B.pjid AND B.pjid=C.pjid AND length(responsible)>0 AND A.pjid IN (38,40,41) ";
$action_result = mysqli_query($con, $action);
while ($AI_row = mysqli_fetch_array($action_result)) {
    $MailAction = 0;
    $ActionData = array(
        'ProjectName' => $AI_row['pj_name'],
        'StrategyStatementNo' => $AI_row['ss_handle'],
        'StrategyStatementDescription' => $AI_row['ss_desc'],
        'ActionItemDescription' => $AI_row['description'],
        'ActionTargetDate' => getDateFromat($AI_row['Adeadline']),
        'to_name' => 'Participant'
    );
    if ($curDate >=  $AI_row['Adeadline']) {
        $days = getdateDiff($curDate, $AI_row['Adeadline']);
        //if (1 == 1)
        if ($days == 5) {
            $MailAction = 1;
            $ActionData = array_merge(
                $ActionData,
                array(
                    "email" => getParticipant($con, $AI_row['responsible']),
                    "subject" => "AIM&DRIVE: Reminder for Action Item due for completion for " . $AI_row['pj_name'] . " on " . $AI_row['Adeadline'],
                    "mailIntro" => 'Action Items due for completion in 5 days ...!'
                )
            );
        } elseif ($days == 0) {
            $MailAction = 1;
            $ActionData = array_merge(
                $ActionData,
                array(
                    "email" => getParticipant($con, $AI_row['responsible']),
                    "subject" => "AIM&DRIVE: Reminder for Action Item due for completion for " . $AI_row['pj_name'] . " on Today",
                    "mailIntro" => 'Action Items due for completion today...!'
                )
            );
        }
    }
    //json_encode($SSData);
    $email_content = callMailContent($ActionData, $MailAction);
    print_r($email_content);
}

//22 Action Item Owner is assigned
//$Aowner = "SELECT actionid, description, responsible, DATE(deadline) Adeadline, A.ssid, ss_handle ,ss_desc, pj_name FROM action A, strategy_statement B, project C WHERE dropped=0  AND deadline IS NOT NULL AND A.ssid=B.ssid AND A.pjid=B.pjid AND B.pjid=C.pjid AND LENGTH(responsible)> 0 AND A.pjid='38' "  ;

$SSowner = "SELECT * FROM strategy_statement A, project B WHERE ss_dropped=0 AND ss_unimplement=0 AND ss_complete=0 AND A.pjid=B.pjid AND ssid IN (SELECT ssid from action WHERE DATE(lastupdate)='" . $curDate . "') AND A.pjid IN (38,40,41) limit 4";
$SAowner_result = mysqli_query($con, $SSowner);
while ($SSAO_row = mysqli_fetch_array($SAowner_result)) {
    $MailAction = 1;
    $AownerData = array(
        'ProjectName' => $SSAO_row['pj_name'],
        'StrategyStatementNo' => $SSAO_row['ss_handle'],
        'StrategyStatementDescription' => $SSAO_row['ss_desc'],
        'to_name' => 'Participant',
    );
    $owners_sql = "SELECT * FROM `action` WHERE ssid='" . $SSAO_row['ssid'] . "'";
    $owner_result = mysqli_query($con, $owners_sql);
    $ActionOwnerEmail = '';
    $i = 0;
    $ActoinItems = [];
    while ($ActOwner = mysqli_fetch_array($owner_result)) {
        $i++;
        $ActoinItems = array_merge(
            $ActoinItems,
            array(
                //"ActionItemDescription" .'-'. $i => $ActOwner['ordering'] . ' - ' . $ActOwner['description'],
                "ActionItemDescription" . '-' . $i => $ActOwner['description'],
                "ActionTargetDate" . '-' . $i => getDateFromat($ActOwner['deadline'])
            )
        );
        $ActionOwnerEmail = $ActOwner['responsible'];
    }

    $AownerData = array_merge($AownerData, array(
        "email" => getParticipant($con, $ActionOwnerEmail),
        "subject" => "AIM&DRIVE: Action Item Owners assigned for " . $SSAO_row['pj_name'],
        "mailIntro" => 'Action Items assigned to you for Strategy Statement ' . $SSAO_row['ss_handle'] . ' for ' . $SSAO_row['pj_name']
    ));

    $SS_ActionItem = array_merge($AownerData, $ActoinItems);
    //print_r($ActoinItems);
    $email_content = callMailContent($SS_ActionItem, $MailAction);
    print_r($email_content);
}





//REF FUNCTION 

function callMailContent($EData, $MailAction)
{
    require_once 'mail_content.php';

    if ($MailAction == 1) {
        $body_message = CreateHtml($EData);
        $email_data = array(
            'to' => $EData['email'],
            'to_name' => $EData['to_name'],
            'subject' => $EData['subject'],
            'message' => $body_message,
        );

        //return ($email_data);
        return $email_response = sendEmailNew($email_data);
    }
}

function getdateDiff($D1, $D2)
{
    $date1 = date_create($D1);
    $date2 = date_create($D2);
    $diff = date_diff($date1, $date2);
    return $diff->format("%a");
}

function getDateFromat($Date)
{
    return  date("d/M/Y", strtotime($Date));
}
//get person mail id
function getParticipant($con, $ids)
{
    $emailId = 'NA';
    $email_sql = "SELECT * FROM person WHERE pnid IN ($ids) ";
    $result = mysqli_query($con, $email_sql);
    //print_r($result);
    while ($part_row = mysqli_fetch_assoc($result)) {
        $emailId =  $part_row['email_address'];
    }
    return $emailId;
}
/* Send email */
function sendEmailNew($email_data)
{

    require "sendgrid/sendgrid-php.php";
    require '/var/secure/MailApiKey.php';

    $email = new \SendGrid\Mail\Mail();
    $email->setFrom("conroy.fernandes@anklesaria.com", "AIM&DRIVE");
    $email->setSubject($email_data['subject']);
    $email->addTo($email_data['to']);
    //$email->addBcc($email_data['bcc']);
    //$email->addContent("text/plain", $email_data['message']);
    $email->addContent("text/html", $email_data['message']);

    //$sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));

    $sendgrid = new \SendGrid($Sendgrid);
    try {
        $response = $sendgrid->send($email);
        return $response;
    } catch (Exception $e) {
        return $e->getMessage();
    }
}
