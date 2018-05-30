<?php
$API_KEY = "XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX";

function get_all_accounts() {
    global $API_KEY;

    $service_url = "https://sms.comtele.com.br/api/v2/accounts";
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

function get_account_by_username($username) {
    global $API_KEY;

    $service_url = "https://sms.comtele.com.br/api/v2/accounts?id=".$username;
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

?>
