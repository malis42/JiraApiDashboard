<?php

namespace SALESmanago\Controllers;

use SALESmanago\Libs\ControllerCore;

class Logout extends ControllerCore
{
    public function __construct()
    {
        parent::__construct();
        session_destroy();
    }
}
