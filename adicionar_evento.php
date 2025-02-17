<?php  

header("Content-Type: application/json");   

session_start();            

require("conector.php");     

require("class.php");   

date_default_timezone_set("America/Sao_Paulo");        

$nome = $_POST["nome"];     
$data = $_POST["data"];
$data_aviso = date("Y-m-d", strtotime($data."-1 days"));      
$horario = $_POST["horario"];     
$nome_imagem = md5($_POST["nome_imagem"].date("d/m/Y H:i:s")).".png";          
$id_usuario = $_SESSION["id_usuario"];         

$usuario = new Usuario();      

$response = $usuario->adicionar_evento($nome,$data,$data_aviso,$horario,$nome_imagem,$id_usuario,$BD);       

$_SESSION["nome_imagem"] = $nome_imagem;        

echo json_encode($response);       

/*    
Formatação de data  

$data_format = DateTime::createFromFormat("d/m/Y",$data);            
$data_final = $data_format->format("Y-m-d");  */ 




?>   