<?php

$API_KEY = "XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX";

function send($sender, $context_rule_name, $receivers) {
    global $API_KEY;

    $service_url = "https://sms.comtele.com.br/api/v2/sendcontextmessage";
    $payload = [
        "Sender" => $sender,
        "ContextRuleName" => $context_rule_name,
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

function schedule($sender, $context_rule_name, $schedule_date, $receivers) {
    global $API_KEY;

    $service_url = "https://sms.comtele.com.br/api/v2/schedulecontextmessage";
    $payload = [
        "Sender" => $sender,
        "ContextRuleName" => $context_rule_name,
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

function get_report($start_date, $end_date, $sender, $context_rule_name) {
    global $API_KEY;

    $service_url = "https://sms.comtele.com.br/api/v2/contextreporting?startDate=".urlencode($start_date)
        ."&endDate=".urlencode($end_date)
        ."&sender=".urlencode($sender)
        ."&contextRuleName=".$context_rule_name;

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

//print_r(get_report("2018-05-01", "2018-05-28 23:59", "", ""));
//print_r(send("remetente", "NOME DA REGRA DE CONTEXTO", ["5516999994444"]));

?>