<?php
namespace Core;

use Controllers;
use Controllers\IndexController;

class Router {

    private $routes;

    public function __construct(){

        //Підключаємо маршрути
        $routesPath = ROOT . '/Resources/routes.php';
        $this->routes = include($routesPath);
    }

    public function getUri(){
        if(!empty($_SERVER['REQUEST_URI'])){
            $uri = trim($_SERVER['REQUEST_URI'], '/');
        }
        return $uri;
    }

    public function start(){

        $uri = $this->getUri();


        foreach($this->routes as $uriPatter => $path){

            if(preg_match("~$uriPatter~", $uri)){

                $internalRoute = preg_replace("~$uriPatter~", $path, $uri);

                $segments = explode('/', $internalRoute);

                $controllerName = array_shift($segments);
                $controllerName = ucfirst($controllerName);
                $actionName = array_shift($segments);

                $parameters = $segments;

                $controllerPath = ROOT . '/controllers/' . $controllerName . '.php';

                if(file_exists($controllerPath)){
                    include_once($controllerPath);
                }

                $controllerName = '\Controllers\\' . $controllerName;

                $controllerObject = new $controllerName;

                $result = call_user_func_array(array($controllerObject, $actionName), $parameters);

                if($result != null){
                    break;
                }
            }
        }


        return true;
    }


}