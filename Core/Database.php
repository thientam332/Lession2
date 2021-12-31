<?php
class Database{
    // Thông tin database
    private static $dsn='mysql:host=127.0.0.1:3306;dbname=phpcore_pro';
    private static $connect=null;
    private static $username='root';
    private static $pass='1234567890';
    public static $db;
    // Kết nối database
    public static function connect(){
        if(!isset(self::$db)){
            try{
                self::$db=new PDO(self::$dsn, self::$username, self::$pass);
                self::$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
            return self::$db;
        }
    }
}