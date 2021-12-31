<?php
class MasterModel{
    public static function get_By_Id ($table, $id){
        $db= Database::connect();
        $sql= "SELECT * FROM $table WHERE id=$id"; 
        $stmt = $db->prepare($sql);
        $stmt->execute();     
        $result =$stmt->fetchAll(PDO:: FETCH_ASSOC);
        $stmt->closeCursor();
        return $result;
    }


    public static function delete ($table, $column, $value){
        $db= Database::connect();
        $sql= "DELETE FROM $table WHERE $column = :value";
        $stmt = $db->prepare($sql);
        $stmt -> bindParam(':value', $values);
        $stmt->execute();
        $stmt->closeCursor();
    }
    
    public static function get_all_from($table){
        $db=Database::connect();
        $sql="SELECT * FROM $table";
        $stmt=$db->prepare($sql);
        $stmt->execute();
        $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $result;
    }
    public static function get_from($table,$start,$limit){
        $db=Database::connect();
        $sql="SELECT * FROM $table LIMIT :start, :limit";
        $stmt=$db->prepare($sql);
        $stmt -> bindParam($start,$limit);
        $stmt->execute();
        $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $result;
    }
}