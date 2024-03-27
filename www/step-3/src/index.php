<?php

header("Content-Type:application/json");

require "./CurlRequest.php";
require "./Bulb.php";

if (!isset($_GET["state"])) {
    response(400, "Invalid request");
    exit();
}

$state = $_GET["state"];

$curl_request = getCurlRequest();

$bulb = new bulb($curl_request);
$response = $bulb->changeState($state);

response(200, $response);

function response($response_code, $response_desc)
{
    $response["response_code"] = $response_code;
    $response["response_desc"] = $response_desc;

    $json_response = json_encode($response);
    echo $json_response;
}

function getCurlRequest()
{
    $HUE_BRIDGE_USER = getenv("HUE_BRIDGE_USER");
    $HUE_BRIDGE_IP = getenv("HUE_BRIDGE_IP");
    $HUE_LIGHT_ID = getenv("HUE_LIGHT_ID");

    $curl_request = new CurlRequest(
        "http://$HUE_BRIDGE_IP/api/$HUE_BRIDGE_USER/lights/$HUE_LIGHT_ID/state"
    );

    $curl_request->setOption(CURLOPT_RETURNTRANSFER, true);
    $curl_request->setOption(CURLOPT_CUSTOMREQUEST, "PUT");
    $curl_request->setOption(CURLOPT_HTTPHEADER, [
        "Content-Type:application/json",
    ]);

    return $curl_request;
}

?>
