<?php
class ListModel extends MasterModel{
    const TABLE ='list';
    public static function getAll()
    {
        return parent::get_all_from(self::TABLE);
    }

    
    public static function getList($id)
    {
        return parent::get_By_Id(self::TABLE,$id);
    }

    public function delete_by_id($id)
    {
        return parent::delete(self::TABLE, 'id', $id);
    }
    public static function getLimit($start,$limit){
        $db = mysqli_connect('127.0.0.1:3306', 'root', '1234567890', 'phpcore_pro');
        $query="SELECT * FROM list LIMIT $start, $limit";
        $sql=$db->query($query);
        return $sql;
    }
    public static function Add($name,$parent){
        $db=Database::connect();
        $sql="SELECT COUNT(*) AS BigNumber FROM list";
        $id=$db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        $id=(int)$id[0]['BigNumber']+1;
        
        $sql = "INSERT INTO list VALUES ('$id','$name','$parent')";
        return $db->query($sql);   
    }
    public static function update($id,$name,$parent){
        $db=Database::connect();
        $sql="UPDATE list SET name='$name',parent='$parent' WHERE id=$id";
        return $db->query($sql);
    }
    public static function updateNull($id,$name){
        $db=Database::connect();
        $sql="UPDATE list SET name='$name',parent=NULL WHERE id=$id";
        return $db->query($sql);
    }
    public static function search($keyword){
        $db=Database::connect();
        $query="SELECT * FROM list WHERE name LIKE '%$keyword%'";
        $sql=$db->query($query);
        return $sql;
    }
    public static function count(){
        $db=Database::connect();
        $query="SELECT COUNT(id) AS TOTAL FROM list";
        $sql=$db->query($query)->fetchAll(PDO::FETCH_ASSOC);
        return $sql[0]['TOTAL'];
    }
    
}