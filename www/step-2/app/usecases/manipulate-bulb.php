<?php
require "./entities/bulb.php";

function turnOn($lightsManager)
{
    $bulb = new Bulb(10);

    $bulb->turnOn();

    $lightsManager->turnOn($bulb->getId());

    return $bulb->getState();
}

function turnOff($lightsManager)
{
    $bulb = new Bulb(10);

    $bulb->turnOff();

    $lightsManager->turnOff($bulb->getId());

    return $bulb->getState();
}
?>
