<?php
require 'Core/Database.php';
require_once 'models/MasterModel.php';
require_once 'models/ListModel.php';
if (isset($_GET['controller'], $_GET['action'])){
    $controller = $_GET['controller'];
    $action= $_GET['action'];}
    else {
        $controller ='list';
        $action='splitpage';
    }

require_once "views/routes.php";
