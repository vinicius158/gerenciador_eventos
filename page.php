<?php    

session_start();   

header("Content-Type:application/json");          

if($_POST["pag"]){      

$_SESSION["itens_pagina"] = 6;

$_SESSION["pag"] = intval($_POST["pag"]);    

echo json_encode($_SESSION["pag"]);       

}



?>      