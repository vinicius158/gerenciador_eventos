<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de cadastro</title>   
    <link rel = "stylesheet" href = "css/estilo_cadastro.css">    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">        
    <script src="https://kit.fontawesome.com/b9092d7591.js" crossorigin="anonymous"></script>         
    <script src="https://code.jquery.com/jquery-3.6.0.slim.js" integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>    
</head>    
<body>      
    <?php           

    if(isset($_GET["id_link"]) && isset($_GET["id_usuario"])){        

    session_start();  

    require("conector.php");               

    $id_link = addslashes($_GET["id_link"]);        
    
    $id_usuario = addslashes($_GET["id_usuario"]);        
    
    $sql = "SELECT status FROM link WHERE id_link = :id_link and fk_id_usuario = :id_usuario";          
    
    $comand = $BD->prepare($sql);      

    $comand->bindValue(":id_link", $id_link);           

    $comand->bindValue(":id_usuario", $id_usuario);      

    $comand->execute();     

    if($comand->rowCount() > 0){
    
    $response = $comand->fetch(PDO::FETCH_ASSOC);  
    
    $_SESSION["id_usuario"] = $id_usuario;     

    if($response["status"] == "desativada"){ 

        header("Location:recuperando.php");  
        
        $_SESSION["msg"] = "Seu link expirou, solicite novamente !!!";        

    }else{

     require("class.php");           

     $usuario = new Usuario();       

     $usuario->link_status($BD,$id_link);            

    }    

}else{
 
       header("Location:recuperando.php");    

  }

}
   
    
    ?>   
    <div class="content">

    <div class="form">          

    <div class="title"><p class = "title2">Atualização de senha</p></div>

    <form id = "dados">                

    <input type = "email" placeholder = "E-mail" maxlenght = "15" id = "email">       
    <input type = "password" placeholder = "Nova senha" id = "senha">            
    <input type = "password" placeholder = "Digite novamente" id = "senha2">                   
    <input type = "submit" value = "Atualizar senha">          

    </form>         
    
    <a href = "login.php" class = "link">Página de login</a>    


    <div class="alert">    
        
    

    </div>  

    </div>   

    </div>    
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>     

    <script src="http://jqueryvalidation.org/files/dist/jquery.validate.js"></script> 

    <script src = "js/recuperar_senha.js"></script>                         


</body>
</html>     
