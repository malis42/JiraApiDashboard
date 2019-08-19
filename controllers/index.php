<?php
namespace controllers;
use libs\controllerCore;

class index extends controllerCore {
    function __construct()
    {
        parent::__construct();
        $this->view->render('index');
    }
}