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
    <div class="content">

    <div class="form">          

    <div class="title"><p class = "title2">Cadastro</p></div>

    <form id = "dados">                

    <input type = "text" placeholder = "Nome" maxlenght = "15" id = "nome"> 
    <input type = "email" placeholder = "E-mail" id = "email">       
    <input type = "password" placeholder = "Senha" id = "senha">              
    <input type = "submit" value = "Cadastrar">          

    </form>         
    
    <a href = "login.php" class = "link">Página de login</a>


    <div class="alert">     

<!--<p class = "alert">Cadastro feito com sucesso !!!</p>   -->        

</div>  

    </div>   

    </div>    
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>        

    <script src="http://jqueryvalidation.org/files/dist/jquery.validate.js"></script> 

    <script src = "js/cadastro.js"></script>                  


</body>
</html>   
