<?php

namespace SALESmanago\Controllers;

use SALESmanago\Libs\ControllerCore;

class AppError extends ControllerCore
{
    public function __construct()
    {
        parent::__construct();
        $this->view->render('appError');
    }
}
