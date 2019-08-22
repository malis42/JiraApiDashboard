<?php

namespace SALESmanago\Libs;

class View
{
    public function render($viewName)
    {
        require '../src/Views/header.php';
        require '../src/Views/' . $viewName . '.php';
        require '../src/Views/footer.php';
    }
}
