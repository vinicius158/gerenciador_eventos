<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de login</title>   
    <link rel = "stylesheet" href = "css/estilo_login.css">    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">        
    <script src="https://kit.fontawesome.com/b9092d7591.js" crossorigin="anonymous"></script>         
    <script src="https://code.jquery.com/jquery-3.6.0.slim.js" integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>     
</head>       

<?php  

session_start();      

if(isset($_GET["sair"])){

unset($_SESSION["nome"]);       

}

?>    
<body>            
    <div class="content">

    <div class="form">          

    <div class="title"><p class = "title2">Login</p></div>

    <form id = "login">       
        
    <input type = "email" placeholder = "E-mail" id = "email">       
    <input type = "password" placeholder = "Senha" id = "senha">                   
    <input type = "submit" value = "Fazer login">          

    </form>       

    <div class="info"><div class="info1"><a href = "recuperando.php" id = "link">Esqueci minha senha</a></div><div class="info2"><p class = "cadastro"> Não possui conta ???? <a href = "cadastrar.php">Cadastre-se</a></p></div></div>                
     
    <div class="alert">                

    </div>     

    </div>            

    </div>      

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>              
    
    <script src = "js/login.js"></script>                   


</body>
</html>