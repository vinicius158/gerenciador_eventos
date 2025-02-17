<?php    

header("Content-Type: application/json");  

session_start();   

$id_usuario = $_SESSION["id_usuario"];        
    
require("conector.php");   
    
require("class.php");    
    
$usuario = new Usuario();     

if($_POST["data"]){
    
$response = $usuario->notification($id_usuario,$BD);   
    
echo json_encode($response);                

}        

?>     