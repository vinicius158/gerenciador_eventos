<?php  

$usuario = "root";   
$senha = "";      

try{  

$BD = new PDO("mysql:host=localhost;dbname=sistema",$usuario,$senha);        

$BD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    

}catch(PDOException $e){

    echo "Error:".$e->getMessage();    

}



?>   