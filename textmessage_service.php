<?php

$API_KEY = "XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX";

$DELIVERY_STATUS_ALL = "all";
$DELIVERY_STATUS_DELIVERED = "true";
$DELIVERY_STATUS_UNDELIVERED = "false";

$REPORT_GROUP_TYPE_DAILY = "false";
$REPORT_GROUP_TYPE_MONTHLY = "true";

function send($sender, $content, $receivers) {
    global $API_KEY;

    $service_url = "https://sms.comtele.com.br/api/v2/send";
    $payload = [
        "Sender" => $sender,
        "Content" => $content,
        "Receivers" => implode(",", $receivers)
    ];

    $headers = [
        "Content-Type: application/json",
        "Content-Length: ".strlen(json_encode($payload)),
        "auth-key:".$API_KEY
    ];

    $curl = curl_init($service_url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($payload));

    $server_output = curl_exec($curl);
    curl_close($curl);
    $res = json_decode($server_output);

    return $res;
}

function schedule($sender, $content, $schedule_date, $receivers) {
    global $API_KEY;

    $service_url = "https://sms.comtele.com.br/api/v2/schedule";
    $payload = [
        "Sender" => $sender,
        "Content" => $content,
        "ScheduleDate" => $schedule_date,
        "Receivers" => implode(",", $receivers)
    ];

    $headers = [
        "Content-Type: application/json",
        "Content-Length: ".strlen(json_encode($payload)),
        "auth-key:".$API_KEY
    ];

    $curl = curl_init($service_url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($payload));

    $server_output = curl_exec($curl);
    curl_close($curl);
    $res = json_decode($server_output);

    return $res;
}

function get_detailed_report($start_date, $end_date, $delivery_status) {
    global $API_KEY;

    $service_url = "https://sms.comtele.com.br/api/v2/detailedreporting?startDate=".urlencode($start_date)."&endDate=".urlencode($end_date)."&delivered=".$delivery_status;
    $headers = ["Content-Type: application/json","auth-key: ".$API_KEY];

    $curl = curl_init($service_url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $server_output = curl_exec($curl);
    curl_close($curl);
    $res = json_decode($server_output);

    return $res;
}

function get_consolidated_report($start_date, $end_date, $group_type) {
    global $API_KEY;

    $service_url = "https://sms.comtele.com.br/api/v2/consolidatedreporting?startDate=".urlencode($start_date)."&endDate=".urlencode($end_date)."&group=".$group_type;
    $headers = ["Content-Type: application/json","auth-key: ".$API_KEY];

    $curl = curl_init($service_url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $server_output = curl_exec($curl);
    curl_close($curl);
    $res = json_decode($server_output);

    return $res;
}

//print_r(send("remetente", "teste via PHP", ["5516999994444"]))
//print_r(schedule("remetente", "teste agendado via PHP", "2018-05-28 11:00", ["5516999994444"]))
//print_r(get_detailed_report("2018-05-01", "2018-05-28 23:59", $DELIVERY_STATUS_UNDELIVERED));
//print_r(get_consolidated_report("2018-05-01", "2018-05-28 23:59", $REPORT_GROUP_TYPE_MONTHLY));

?>