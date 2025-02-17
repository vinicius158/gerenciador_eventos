<?php       

header("Content-Type: application/json");      

$nome = $_POST["nome"];      
$email = $_POST["email"];    
$password = password_hash($_POST["senha"], PASSWORD_DEFAULT);  

require "conector.php";   

require "class.php";   

$user = new Usuario();              

$response = $user->cadastrar($BD,$nome,$email,$password);                              

echo json_encode($response);                              




?>     