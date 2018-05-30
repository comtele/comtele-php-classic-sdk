<?php

$API_KEY = "XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX";

function get_my_credits() {

    global $API_KEY;

    $service_url = "https://sms.comtele.com.br/api/v2/credits";
    $headers = ["Content-Type: application/json","auth-key: ".$API_KEY];

    $curl = curl_init($service_url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $server_output = curl_exec($curl);
    curl_close($curl);
    $res = json_decode($server_output);
    return $res->Object;
}

function get_credits($username) {

    global $API_KEY;

    $service_url = "https://sms.comtele.com.br/api/v2/credits?id=" . $username;
    $headers = ["Content-Type: application/json","auth-key: ".$API_KEY];

    $curl = curl_init($service_url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $server_output = curl_exec($curl);
    curl_close($curl);
    $res = json_decode($server_output);
    return $res->Object;
}

function add_credits($username, $amount) {
    global $API_KEY;

    $service_url = "https://sms.comtele.com.br/api/v2/credits?id=".$username."&amount=".$amount;
    $headers = ["Content-Type: application/json","auth-key: ".$API_KEY, "Content-Length: 0"];

    $curl = curl_init($service_url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_POST, true);

    $server_output = curl_exec($curl);
    curl_close($curl);
    $res = json_decode($server_output);

    return $res;
}

?>