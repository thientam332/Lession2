<?php
$ControllerName="${controller}Controller";
require_once "controllers/$ControllerName.php";
switch($controller){
    case 'list':
        $controllerObject=new ListController();
        require_once 'models/ListModel.php';
        $controllerObject->{$action}();
        break;
    default:
        $controllerObject=new ListController();
        require_once 'models/ListModel.php';
        $controllerObject->{$action}();
        break;
}