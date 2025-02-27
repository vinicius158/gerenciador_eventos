<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>   
    <link rel = "stylesheet" href = "css/update_evento.css">     
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

         $_SESSION["id_evento"] = addslashes($_GET["id"]);       
    
    
        }  
    
    ?>   
    <header>
    <div class="topo"> 
        <div class="user">
        <i class="fa fa-user" style = "color:white; font-size:100px;"></i>       
        <p class="txt1">Seja Bem-vindo </p>    
        <p class="txt2"><?php echo $_SESSION["nome"];?></p>
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
<li><a href = "principal.php">Início</a></li>
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

    <div class="title"><p class = "title2">Atualização de Evento</p></div> 

    <form id = "form" enctype = "multipart/form-data">          

    <input type = "text" maxlenght = "15" id = "nome" name = "nome"> 
    <input type = "text" placeholder = "" onfocus="this.type='date'" onblur="if (!this.value) this.type='text'" id = "data" name = "data">       
    <input type = "text" placeholder = "" onfocus="this.type='time'" onblur="if (!this.value) this.type='text'" id = "hora" name = "hora">    
    <input type = "file" placeholder = "Escolha uma foto">     
    <label class = "upload" onchange = "preview()">
  
Escolha uma nova imagem <i class="fa-solid fa-image"></i><input type = "file" placeholder = "Escolha uma imagem" name = "imagem" id = "imagem" onchange = "selecionar(1)"></label>         
    <img id = "frame" class = "foto">     
    <input type = "submit" value = "Atualizar">       

    </form>         

<div class="alert">        
   
</div>  

    </div>   

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>          

<script src = "js/menu.js"></script>    

<script src = "js/preview.js"></script>                

<script src = "js/update_evento.js"></script>    

<script src = "js/notification.js"></script>

</body>
</html>
