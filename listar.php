<?php       

header("Content-Type: application/json");       

require("conector.php");          

require("class.php");           

$pesquisa = $_POST["pesquisa"];    

$usuario = new Usuario();       

$response = $usuario->listar($pesquisa,$BD); 

echo json_encode($response);    


?>   