<?php
namespace libs;
use libs\view;

class controllerCore
{
    public function __construct()
    {
        $this->view = new view();
    }
}