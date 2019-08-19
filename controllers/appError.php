<?php
namespace controllers;
use libs\controllerCore;

class appError extends controllerCore {
    public function __construct()
    {
        parent::__construct();
        $this->view->render('appError');
    }
}