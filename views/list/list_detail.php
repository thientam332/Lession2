<?php

if(isset($_GET['Id'])){
 $id = $_GET['Id'];

 foreach($list as $row2){
     if($id==$row2['id']){
         $id=$row2;
         break;
     }
 }

 $response = "<table border='0' width='100%'>";

 $response .= "<tr>";
 $response .= "<td>ID : </td><td>{$id['id']}</td>";
 $response .= "</tr>";
 
 $response .= "<tr>";
 $response .= "<td>Name : </td><td>{$id['name']}</td>";
 $response .= "</tr>";
 
 $response .= "<tr>";
 $response .= "<td>Parent : </td><td>{$id['parent']}</td>";
 $response .= "</tr>";
 }
 $response .= "</table>";
 
 echo $response;
 ;

?>