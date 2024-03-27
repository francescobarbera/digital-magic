<?php

class bulb
{
    private $curlRequest;

    public function __construct($curlRequest)
    {
        $this->curlRequest = $curlRequest;
    }

    public function changeState($state)
    {
        $this->curlRequest->setOption(
            CURLOPT_POSTFIELDS,
            json_encode(["on" => $state == "on" ? true : false])
        );
        $response = $this->curlRequest->execute();

        return $response;
    }
}
?>
