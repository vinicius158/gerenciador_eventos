<?php         

header("Content-Type: application/json");       

require "conector.php";        

require "class.php";            

$email = $_POST["email"];     
$password = $_POST["senha"];      
$password2 = password_hash($_POST["senha2"],PASSWORD_DEFAULT);        

$usuario = new Usuario();       

$response = $usuario->update_senha($BD,$email,$password,$password2);           

echo json_encode($response);               


?>        