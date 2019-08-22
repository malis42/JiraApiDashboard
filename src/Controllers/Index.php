<?php

namespace SALESmanago\Controllers;

use SALESmanago\Libs\ControllerCore;

class Index extends ControllerCore
{
    function __construct()
    {
        parent::__construct();
        $this->view->render('index');
    }
}
