<?php
namespace app\controllers;

class Route
{
    private $route = "page";
    private $actionDefault = "main";
    private $controllerDefault = "main";
    private $controllerSuffix = "Controller";
    private $actionPrefix = "action";



    public function callRoute (){
        if($_GET[$this->route]){
            $route = $_GET[$this->route];
        }else{
            $route = $this->controllerDefault;
        }

        if(empty($route)) return new Errors("Route $route is empty");
        $routePieces = explode('/',strtolower($route));
        $filter = explode("-", $routePieces[1]);
        $controller = "app\\controllers\\". ucfirst($routePieces[0]).$this->controllerSuffix;
        $action = $this->actionPrefix;

        if(count($filter) > 1){
            $action .= $filter[0];
        }else{
            for($i = 1; $i <= count($routePieces); $i++){
                if(count($routePieces) == 1){ // if only 'route=main' -> main page.
                    $action .= ucfirst($this->actionDefault);
                }else{
                    $action .= ucfirst(strtolower($routePieces[$i]));
                }
            }
        }

        if(!class_exists($controller)){
            if(!method_exists($controller, 'actionGetFile')){
                $controllerClass = new MainController();
                $controllerClass->actionGetFile($route);
                return;
            }else{
                return new Errors("Not found method $action");
            }
            return new Errors("Not found controller $controller");
        }else{
            $controllerClass = new $controller();
        }
        if(!method_exists($controller, $action)){
            return new Errors("Not found method $action");
        }else{
            $controllerClass->$action();
        }
    }


}