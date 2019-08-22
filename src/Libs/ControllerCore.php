<?php

namespace SALESmanago\Libs;

class ControllerCore
{
    public $view;

    public function __construct()
    {
        $this->view = new View();
    }
}
