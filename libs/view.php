<?php
namespace libs;

class view
{
    public function render($viewName){
        require 'views/header.php';
        require 'views/' . $viewName . '.php';
        require  'views/footer.php';
    }
}