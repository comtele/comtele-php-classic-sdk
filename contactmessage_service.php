<?php

$API_KEY = "XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX";

function send($sender, $content, $group_name) {
    global $API_KEY;

    $service_url = "https://sms.comtele.com.br/api/v2/sendcontactmessage";
    $payload = [
        "Sender" => $sender,
        "Content" => $content,
        "GroupName" => $group_name
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

function schedule($sender, $content, $group_name, $schedule_date) {
    global $API_KEY;

    $service_url = "https://sms.comtele.com.br/api/v2/schedulecontacttmessage";
    $payload = [
        "Sender" => $sender,
        "Content" => $content,
        "ScheduleDate" => $schedule_date,
        "GroupName" => $group_name
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

?>