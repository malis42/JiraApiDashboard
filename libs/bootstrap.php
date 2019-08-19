<?php
namespace libs;

use controllers\index;
use controllers\appError;
use controllers\login;
use controllers\search;
use controllers\refresh;
use controllers\logout;

session_start();

class bootstrap
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
            $controller = new index();
            return false;
        }
        $ctrlFile = '../controllers/' . $path[1] . '.php';
        if (file_exists($ctrlFile)) {
            require $ctrlFile;
        } else {
            require_once '../controllers/appError.php';
            $controller = new appError();
            return false;
            //throw new Exception("The file {$ctrlFile} does not exist!");
        }

        if($path[1] == 'index'){
            $controller = new index();
        } else if ($path[1] == 'search'){
            $controller = new search();
        } else if ($path[1] == 'refresh'){
            $controller = new refresh();
        } else if ($path[1] == 'login'){
            $controller = new login();
            $controller->setEmail($_POST['email']);
            if($controller->checkToken($_POST['token']) == 'true'){
                $_SESSION['email'] = $_POST['email'];
                header('Location: search');
            } else {
                header('Location: index');
            }
        } else if ($path[1] == 'logout'){
            $controller = new logout();
            header('Location: index');
        }
    }
}