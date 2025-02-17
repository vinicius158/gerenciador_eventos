<?php   

header("Content-Type: application/json");       

require("conector.php");    

require("class.php");     

session_start();    

$id_usuario = $_SESSION["id_usuario"];   

$usuario = new Usuario();      

$response = $usuario->listar_avisos($id_usuario,$BD);   

echo json_encode($response);    

?>  