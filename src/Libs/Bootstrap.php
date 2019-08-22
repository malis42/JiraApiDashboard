<?php

namespace SALESmanago\Libs;

use SALESmanago\Controllers\Index;
use SALESmanago\Controllers\FrontInit;
use SALESmanago\Controllers\Logout;
use SALESmanago\Controllers\Login;
use SALESmanago\Controllers\Refresh;
use SALESmanago\Controllers\AppError;
use SALESmanago\Controllers\Search;

session_start();

class Bootstrap
{
    public function __construct()
    {
        $url = parse_url(
            (
            isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'
                ? "https"
                : "http")
            . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}"
        );

        $path = ltrim(rtrim($url['path'], '/'), '/');
        $controllerPath = explode('/', $path);
        if (empty($controllerPath[5])) {
            $controller = new Index();
            return false;
        }
        $ctrlFile = '../src/Controllers/' . $controllerPath[5] . '.php';

        if (file_exists($ctrlFile)) {
            require $ctrlFile;
        } else {
            require_once '../src/Controllers/AppError.php';
            $controller = new AppError();
            return false;
            //throw new Exception("The file {$ctrlFile} does not exist!");
        }

        switch ($controllerPath[5]) {
            case "Index";
                $controller = new Index();
                break;
            case "Search";
                $controller = new Search();
                break;
            case "Refresh";
                $controller = new Refresh();
                break;
            case "Login";
                $controller = new Login();
                $controller->setEmail($_POST['email']);
                if ($controller->checkToken($_POST['token']) == 'true') {
                    $_SESSION['email'] = $_POST['email'];
                    header('Location: Search');
                } else {
                    header('Location: Index');
                }
                break;
            case "Logout";
                $controller = new Logout();
                header('Location: Index');
                break;
            default;
        }
    }
}
