<?php
header("Content-Type:application/json");

$state = $_GET["state"];

$response = callAPI($state == "on" ? true : false);
response(200, $response);

function response($response_code, $response_desc)
{
    $response["response_code"] = $response_code;
    $response["response_desc"] = $response_desc;

    $json_response = json_encode($response);
    echo $json_response;
}

function callAPI($state)
{
    $HUE_BRIDGE_USER = getenv("HUE_BRIDGE_USER");
    $HUE_BRIDGE_IP = getenv("HUE_BRIDGE_IP");

    $apiUrl = "http://$HUE_BRIDGE_IP/api/$HUE_BRIDGE_USER/lights/10/state";

    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, $apiUrl);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode(["on" => $state]));
    curl_setopt($curl, CURLOPT_HTTPHEADER, ["Content-Type:application/json"]);

    $response = curl_exec($curl);

    if ($errno = curl_errno($curl)) {
        $error_message = curl_strerror($errno);
        echo "cURL error ({$errno}):\n {$error_message}";
    }

    curl_close($curl);

    return $response;
}
?>
