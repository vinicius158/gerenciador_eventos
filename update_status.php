<?php   

header("Content-Type: application/json");       

require("conector.php");        

require("class.php");     

session_start();              

$id_usuario = $_SESSION["id_usuario"];    

$id_notification = $_POST["id"];    

$usuario = new Usuario();          

$response = $usuario->update_status($id_usuario,$id_notification,$BD);       

echo json_encode($response);      



?>   