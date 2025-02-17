<?php   

header("Content-Type: application/json");     

require("conector.php");    

require("class.php");       

$id = $_POST["id"];     

$usuario = new Usuario();        

$response = $usuario->consultar_evento($id,$BD);        

echo json_encode($response);   

?>  