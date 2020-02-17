<?php

class Route {
    static function start() {
        $controllerName = 'Main';
        $actionName = 'index';

        $routes = explode('/', $_SERVER['REQUEST_URI']);

        if(!empty($routes[1])) {
            $controllerName = $routes[1];
        }

        if(!empty($routes[2])) {
            $actionName = $routes[2];
        }
        
        $modelName = 'model_'.$controllerName;
        $controllerName = 'controller_'.$controllerName;
        $actionName = 'action_'.$actionName;

        $modelFile = strtolower($modelName).'.php';
        $modelPath = "app/models/$modelFile";
        if(file_exists($modelPath)) {
            include "app/models/$modelFile";
        }

        $controllerFile = strtolower($controllerName).'.php';
        $controllerPath = "app/controllers/$controllerFile";
        if(file_exists($controllerPath)) {
            include "app/controllers/$controllerFile";
        } else {
            Route::pageNotFound();
        }

        $controller = new $controllerName;
        $action = $actionName;

        if(method_exists($controller, $action)) {
            $controller->$action();
        } else {
            Route::pageNotFound();
        }
    }

    function pageNotFound() {
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
        header('Status: 404 Not Found');
        header('Location: '.$host.'404');
    }
}

?>