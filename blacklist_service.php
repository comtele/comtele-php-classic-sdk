<?php
$API_KEY = "XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX";

function get_blacklist()
{
    global $API_KEY;

    $service_url = "https://sms.comtele.com.br/api/v2/blacklist";
    $headers = ["Content-Type: application/json", "auth-key: " . $API_KEY];

    $curl = curl_init($service_url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $server_output = curl_exec($curl);
    curl_close($curl);
    $res = json_decode($server_output);

    return $res;
}

function get_by_phone_number($phone_number)
{
    global $API_KEY;

    $service_url = "https://sms.comtele.com.br/api/v2/blacklist?id" . urldecode($phone_number);
    $headers = ["Content-Type: application/json", "auth-key: " . $API_KEY];

    $curl = curl_init($service_url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $server_output = curl_exec($curl);
    curl_close($curl);
    $res = json_decode($server_output);

    return $res;
}

function insert($phone_number)
{
    global $API_KEY;

    $service_url = "https://sms.comtele.com.br/api/v2/blacklist";

    $payload = [
        "PhoneNumber" => $phone_number
    ];

    $headers = [
        "Content-Type: application/json",
        "Content-Length: " . strlen(json_encode($payload)),
        "auth-key:" . $API_KEY,
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

    return json_decode($server_output);
}

function remove($phone_number)
{
    global $API_KEY;

    $service_url = "https://sms.comtele.com.br/api/v2/blacklist?id" . $phone_number;
    $headers = ["Content-Type: application/json", "auth-key: " . $API_KEY, "Content-Length: 0"];

    $curl = curl_init($service_url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_POST, true);

    $server_output = curl_exec($curl);
    curl_close($curl);
    $res = json_decode($server_output);

    return $res;
}

?>