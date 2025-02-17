<?php   

header("Content-Type: application/json");   

$email = $_POST["email"];         

require("conector.php");

require("class.php");          

$usuario = new Usuario();        

$response = $usuario->gerar_link($BD,$email);   

if($response){

echo json_encode("sucesso");     

}else{

echo json_encode("erro");        

}




?>      