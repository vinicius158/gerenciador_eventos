<?php       

session_start();       

$nome_imagem = "img_eventos/".$_SESSION["nome_imagem"];     

$localidade = $_FILES["imagem"]["tmp_name"];        

require("class.php");          

$usuario = new Usuario();         

$response = $usuario->upload($nome_imagem,$localidade);      

echo json_encode($response);       

?>   