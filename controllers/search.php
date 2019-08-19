<?php
namespace controllers;
use libs\controllerCore;

class search extends controllerCore {
    function __construct()
    {
        parent::__construct();
        $this->view->render('search');
    }


}