<?php

class Bulb
{
    private $id;
    private $state;

    public function __construct($id)
    {
        $this->id = $id;
        $this->state = "off";
    }

    public function getId()
    {
        return $this->id;
    }

    public function turnOn()
    {
        $this->state = "on";
    }

    public function turnOff()
    {
        $this->state = "off";
    }

    public function getState()
    {
        return "The buld with id $this->id is $this->state";
    }
}
?>
