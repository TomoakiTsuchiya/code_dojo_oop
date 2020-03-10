<?php
class User
{
    public $name;
    public $isMinority;

    function __construct($name, $isMinority = false)
    {
        $this->name = $name;
        $this->isMinority = $isMinority;
    }
}
