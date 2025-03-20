<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>   
    <link rel = "stylesheet" href = "css/update_senha.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">        
    <script src="https://kit.fontawesome.com/b9092d7591.js" crossorigin="anonymous"></script>      
</head>
<body>      
<?php          

if(isset($_GET["id_usuario"])){         

session_start();     

require_once("class.php");        

require_once("conector.php");    

$id_usuario = addslashes($_GET["id_usuario"]);      

$obj = new Usuario;     

$response = $obj->verificar($BD,$id_usuario);            

if($response == "ativo"){            

$sql = "SELECT nome FROM usuario WHERE id_usuario = :id_usuario";         

$comand = $BD->prepare($sql);      

$comand->bindValue(":id_usuario",$id_usuario);      

$comand->execute();             

$count = $comand->rowCount();      

if($count > 0){

$response2 = $comand->fetch(PDO::FETCH_ASSOC);        

$_SESSION["nome"] = $response2["nome"];            

$_SESSION["id_usuario"] = $id_usuario;              

echo "<script>alert('Sua conta foi ativada !!!')</script>";       

}else{

header("Location:login.php"); 

}

} 

else    

if($response == "erro"){

header("Location:login.php");    

}     

else 

if($response == "url"){

header("Location:login.php");     

}

}else{  

 session_start();    
 
 if(!isset($_SESSION["nome"])){

  header("Location:login.php");                      

 }


}       



?>        
    <header>
    <div class="topo"> 
        <div class="user">
        <i class="fa fa-user" style = "color:white; font-size:100px;"></i>       
        <p class="txt1">Seja Bem-vindo </p>    
        <p class="txt2"><?php  echo $_SESSION["nome"];?></p>
        </div>   
    </div>          
    <div class="menu">
            <div class="toggle"><i class="fa fa-bars" onclick = "clicou()" id = "toggle" style = "position:relative; margin-left:14px; color:white; margin-top:15px; font-size:25px;"></i></div>
            <ul class = "list1">  
                <li><a href = "perfil.php">Início</a></li>
                    <li><a href = "login.php?sair=1">Sair</a></li>
                        <li><a href = "adicionar.php">Novo evento</a></li>    
                        <li><a href = "notification.php" id = "number">Notificações</a></li>   
                        <li><a href = "update_senha.php">Alterar senha</a></li>   
                  </ul>   
                  
           </form>
            </div>
            </div>             
            <div class="menu2">
<ul class = "list3">  
<li><a href = "perfil.php">Início</a></li>
                    <li><a href = "login.php?sair=1">Sair</a></li>
                        <li><a href = "adicionar.php">Novo evento</a></li>    
                        <li><a href = "notification.php" id = "number2">Notificações</a></li>   
                        <li><a href = "update_senha.php">Alterar senha</a></li>      
                  </ul>   
          </div>  
</header>       


<div class="content">    

<div class="form">          

    <div class="title"><p class = "title2">Alteração de senha</p></div> 

    <form id = "form">           

    <input type = "email" placeholder = "Digite seu email" maxlenght = "256" id = "email">       
    <input type = "password" placeholder = "Senha atual" id = "senha">           
    <input type = "password" placeholder = "Nova senha" id = "senha2">         
    <input type = "submit" value = "Atualizar senha">          
    </form>         

<div class="alert">        
   
</div>  

    </div>   

</div>

<script src = "js/menu.js"></script>         

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>    

<script src="http://jqueryvalidation.org/files/dist/jquery.validate.js"></script> 

<script src = "js/update_senha.js"></script>         

</body>
</html>
