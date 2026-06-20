<?php 
$servername ="localhost"; // 127.0.0.1 
$database="todolist";
$username="root";
$password="";
date_default_timezone_set('Atlantic/Cape_Verde');

try{
    $conexion= new PDO("mysql:host=$servername;dbname=$database",$username,$password);
}catch(Exception $ex){
    echo $ex->getMessage();
}

?>