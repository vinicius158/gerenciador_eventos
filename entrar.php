<?php        

header("Content-Type: application/json");    

require_once("conector.php"); 

require_once("class.php");     

$email = $_POST["email"];     

$senha = $_POST["senha"];          

$usuario = new Usuario();       

$response = $usuario->login($BD,$email,$senha);            

echo json_encode($response);        





?>      