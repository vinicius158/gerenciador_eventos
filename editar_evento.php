<?php        

require("conector.php");   

require("class.php");   

session_start();       

$id_evento = $_SESSION["id_evento"];    

$nome = $_POST["nome"];           

$data = $_POST["data"];      

$hora = $_POST["hora"];      

if(empty($_FILES["imagem"]["name"])){

$imagem = "";    
$localidade = "";        

}else{

$imagem = md5($_FILES["imagem"]["name"].date("H:i:s d/m/Y").".png");         

$localidade = $_FILES["imagem"]["tmp_name"];         

}    

$usuario = new Usuario();        

$response = $usuario->update_evento($id_evento,$nome,$data,$hora,$imagem,$localidade,$BD);     

echo $response;    


?>     