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
        $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
        $url = parse_url($actual_link);
        //var_dump($url);
        $path = rtrim($url['path'], '/');
        $path = ltrim($url['path'], '/');
        $path = explode('/', $path);
        //var_dump($path);
        if(empty($path[1])){
            $controller = new Index();
            return false;
        }
        $ctrlFile = '../src/Controllers/' . $path[1] . '.php';
        if (file_exists($ctrlFile)) {
            require $ctrlFile;
        } else {
            require_once '../src/Controllers/AppError.php';
            $controller = new AppError();
            return false;
            //throw new Exception("The file {$ctrlFile} does not exist!");
        }

        if($path[1] == 'Index'){
            $controller = new Index();
        } else if ($path[1] == 'Search'){
            $controller = new Search();
        } else if ($path[1] == 'Refresh'){
            $controller = new Refresh();
        } else if ($path[1] == 'Login'){
            $controller = new Login();
            $controller->setEmail($_POST['email']);
            if($controller->checkToken($_POST['token']) == 'true'){
                $_SESSION['email'] = $_POST['email'];
                header('Location: Search');
            } else {
                header('Location: Index');
            }
        } else if ($path[1] == 'Logout'){
            $controller = new Logout();
            header('Location: Index');
        }
    }
}