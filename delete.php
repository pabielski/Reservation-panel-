<?php 
$mysqli = require __DIR__ . "/database.php";

if(isset($_GET['deleteid'])){
    $id=$_GET['deleteid'];

    $sql="delete from clients where id=$id";
    $result = $mysqli->query($sql);
    if($result){
        echo"Usunięto";
    }
}