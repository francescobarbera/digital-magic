<?php
header("Content-Type:application/json");

require "./usecases/manipulate-bulb.php";
require "./external-dependencies/hue.php";

$desiredState = $_GET["state"];

$lightsManager = new LightsManager();

$bulbState = "";
if ($desiredState == "on") {
    $bulbState = turnOn($lightsManager);
} else {
    $bulbState = turnOff($lightsManager);
}

response(200, $bulbState);

function response($response_code, $response_desc)
{
    $response["response_code"] = $response_code;
    $response["response_desc"] = $response_desc;

    $json_response = json_encode($response);
    echo $json_response;
}
?>
