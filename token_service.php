<?php
$API_KEY = "XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX";

function send_totken($phone_number, $prefix)
{
    global $API_KEY;

    $service_url = "https://sms.comtele.com.br/api/v2/tokenmanager";

    $payload = [
        "PhoneNumber" => $phone_number,
        "Prefix" => $prefix
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

function validate_token($token_code)
{
    global $API_KEY;

    $service_url = "https://sms.comtele.com.br/api/v2/tokenmanager";

    $payload = [
        "TokenCode" => $token_code
    ];

    $headers = [
        "Content-Type: application/json",
        "Content-Length: " . strlen(json_encode($payload)),
        "auth-key:" . $API_KEY,
    ];

    $curl = curl_init($service_url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($payload));

    $server_output = curl_exec($curl);
    curl_close($curl);

    return json_decode($server_output);
}

?>