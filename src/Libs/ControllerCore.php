<?php
namespace SALESmanago\Libs;
use SALESmanago\Libs\View;

class ControllerCore
{
    public function __construct()
    {
        $this->view = new View();
    }
}