<?php
namespace controllers;

use libs\controllerCore;
use models\dbPushModel;

class refresh extends controllerCore
{
    private $pushModel;

    public function __construct()
    {
        parent::__construct();
        //$this->view->render('refresh');
        $this->pushModel = new dbPushModel();
        $this->pushModel->pushData();
        $this->pushModel->closeConn();
        return true;
    }
}