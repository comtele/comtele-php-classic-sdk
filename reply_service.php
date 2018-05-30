<?php

$API_KEY = "XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX";

function get_report($start_date, $end_date, $sender) {
    global $API_KEY;

    $service_url = "https://sms.comtele.com.br/api/v2/replyreporting?startDate=".urlencode($start_date)
        ."&endDate=".urlencode($end_date)
        ."&sender=".urlencode($sender);

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

//print_r(get_report("2018-05-01", "2018-05-28 23:59", ""));

?>