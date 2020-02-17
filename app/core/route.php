<?php

class Route {
    static function start() {
        $controllerName = 'Main';
        $actionName = 'index';

        $routes = explode('/', $_SERVER['REQUEST_URI']);

        if(!empty($routes[1])) {
            // cut http query
            $routes[1] = explode('?', $routes[1]);
            $controllerName = $routes[1][0];
        }

        if(!empty($routes[2])) {
            // cut http query
            $routes[2] = explode('?', $routes[2]);
            $actionName = $routes[2][0];
        }

        if(!empty($routes[3])) {
            // cut http query
            $routes[3] = explode('?', $routes[3]);
            $actionAttr = $routes[3][0];
        }

        if(!empty($routes[4])) {
            Route::pageNotFound();
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
            if($actionAttr) {
                $controller->$action($actionAttr);
            } else {
                $controller->$action();
            }
        } else {
            Route::pageNotFound();
        }
    }

    function pageNotFound() {
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        // header('HTTP/1.1 404 Not Found');
        // header('Status: 404 Not Found');
        header('Location: '.$host.'404');
        return;
    }
}

?>