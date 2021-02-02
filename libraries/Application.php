<?php

class Application{

public static function Process()
{

    $controllerName = "Article";
    $task = "index";

    $controllerName = "\controllers\\". $controllerName;
    $controller = new $controllerName;
    $controller->$task();

}


}