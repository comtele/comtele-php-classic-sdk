<?php
$API_KEY = "XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX";
    
    function create_group($group_name, $group_description)
    {
        global $API_KEY;

        $service_url = "https://sms.comtele.com.br/api/v2/contactgroup";

        $payload = [
            "Name" => $group_name,
            "Description" => $group_description
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

    function remove_group($group_name)
    {
        global $API_KEY;

        $service_url = "https://sms.comtele.com.br/api/v2/contactgroup?id=" . $group_name;
        $headers = ["Content-Type: application/json", "auth-key: " . $API_KEY, "Content-Length: 0"];

        $curl = curl_init($service_url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_POST, true);

        $server_output = curl_exec($curl);
        curl_close($curl);
        return json_decode($server_output);        
    }

    function get_all_groups()
    {
        global $API_KEY;

        $service_url = "https://sms.comtele.com.br/api/v2/contactgroup";
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

    function get_group_by_name($group_name)
    {
        global $API_KEY;

        $service_url = "https://sms.comtele.com.br/api/v2/contactgroup?id=" . $group_name;
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

    function add_contact_to_group($group_name, $contact_phone, $contact_name)
    {
        global $API_KEY;

        $service_url = "https://sms.comtele.com.br/api/v2/contactgroup";

        $payload = [
            "GroupName" => $group_name,
            "ContactPhone" => $contact_phone,
            "ContactName" => $contact_name,
            "Action" => "add_number"
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
        $res = json_decode($server_output);

        return $res;
    }

    function remove_contact_from_group($group_name, $contact_phone, $contact_name)
    {
        global $API_KEY;

        $service_url = "https://sms.comtele.com.br/api/v2/contactgroup";

        $payload = [
            "GroupName" => $group_name,
            "ContactPhone" => $contact_phone,
            "ContactName" => $contact_name,
            "Action" => "remove_number"
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
        $res = json_decode($server_output);

        return $res;
    }

?>