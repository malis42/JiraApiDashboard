<?php
namespace SALESmanago\Controllers;
use SALESmanago\Libs\ControllerCore;

class Search extends ControllerCore {
    function __construct()
    {
        parent::__construct();
        $this->view->render('search');
    }


}