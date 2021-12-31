<?php
class ListController{
    public function __construct()
    {
        require_once 'models/ListModel.php';
    }
    public static function view(){

        $list= ListModel::getAll();
        return require('views/list/list_view.php');
    }
    public static function popup(){
        $list=ListModel::getAll();
        return require_once ('views/list/list_detail.php');
    }
    public static function search(){
        $keyword=$_POST['search'];
        $key=ListModel::search($keyword);
        return require_once ('views/list/search.php');
    }
    public static function add(){
        return require_once ('views/list/add.php');
    }
    public static function store(){
        if (isset($_POST['submit'])){
            $name = $_POST['name'];
            $parent = $_POST['parent'];
            $name = strip_tags($name);
            $name = addslashes($name);
            $parent = strip_tags($parent);
            $parent = addslashes($parent);
            if (empty($name)||strlen($name)>100){
                echo "Tên không được rỗng và lớn hơn 100";
            } 
            else {
                ListModel::add($name, $parent);
            }
            return require header('location:?controller=list&action=splitpage'); 
        }
         else {
            header('location:.');
        }
    }
    public function update(){
        $id=$_GET['id'];
        $list =ListModel::getList($id);
        require 'views/list/update.php';
    }
    public function edit(){
        if (isset($_POST['submit'])){
            $id=$_GET['id'];
            $name = $_POST['name'];
            $parent = $_POST['parent'];
            $name = strip_tags($name);
            $name = addslashes($name);
            $parent = strip_tags($parent);
            $parent = addslashes($parent);
            if($parent=='')
            {
                ListModel::updateNULL( $id,$name);
            }
            else{ListModel::update( $id,$name, $parent);}
            header('location: ?controller=list&action=splitpage');
        } else {
            header('location:.');
            ;}
    }
    public function splitpage(){
        $total=ListModel::count();
        $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
        $level = isset($_GET['level']) ? $_GET['level'] : 1;
        $limit = 11;
        $total_page = ceil($total/ $limit);
        if ($current_page > $total_page){
            $current_page = $total_page;
        }
        else if ($current_page < 1){
            $current_page = 1;
        }
        $start = ($current_page - 1) * $limit;
        $list=ListModel::getLimit($start,$limit);
        return require_once 'views/list/list_view.php';
    }
    public function loadpage(){
        $start=$_GET['start'];
        $limit=$_GET['limit'];
        $list=ListModel::getLimit($start,$limit);
        return require_once 'views/list/list_table.php';
    }
}