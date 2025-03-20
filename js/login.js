$("#login").submit(function(e){

e.preventDefault();      

let email = $("#email").val();       

let senha = $("#senha").val();         

if(email.length === 0 || senha.length === 0 ){

$(".alert").html("<p class = 'alert'>Preencha todos os campos !!! </p>");    


}else{        

   if($("#email").validate()){

$.ajax({
   
    url:"http://localhost/PHP/cadastro/entrar.php",   
    method: "POST",    
    dataType: "json",      
    data: {email: email, senha: senha}   

}).done(function(response){    


if(response == "sucesso"){

window.location.href = "http://localhost/PHP/cadastro/perfil.php";       

}else{

if(response == "invalido"){      

$(".alert").html("<p class = 'alert'>Email não encontrado !!!</p>");  

 } 
else 

if(response == "invalido1"){

$(".alert").html("<p class = 'alert'>Senha incorreta !!! </p>");    

}   

else   

if(response == "inativa"){

$(".alert").html("<p class = 'alert'>Essa conta não foi verificada !!!</p>");  

}

} 

});     

}


}

});      
