<?php       

header("Content-Type: application/json");     

session_start();             

$id_usuario = $_SESSION["id_usuario"];          

$email = $_POST["email"];      

$password = password_hash($_POST["senha"], PASSWORD_DEFAULT);          

require("conector.php");   

require("class.php");  

$usuario = new Usuario();          

$response = $usuario->update_senha2($BD,$email,$password,$id_usuario); 

if($response){

echo json_encode("sucesso");   

}else{

if($response == false){

echo json_encode("erro");   

}else{

echo json_encode("senha");       

}

}


?>   