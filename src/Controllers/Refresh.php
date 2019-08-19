<?php
namespace SALESmanago\Controllers;
use SALESmanago\Libs\ControllerCore;
use SALESmanago\Models\DbPushModel;

class Refresh extends ControllerCore
{
    private $pushModel;

    public function __construct()
    {
        parent::__construct();
        //$this->view->render('refresh');
        $this->pushModel = new DbPushModel();
        $this->pushModel->pushData();
        $this->pushModel->closeConn();
        return true;
    }
}