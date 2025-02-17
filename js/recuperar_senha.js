$("#dados").submit(function(e){

e.preventDefault();          

let email = $("#email").val();     

let password = $("#senha").val();     

let password2 = $("#senha2").val();          

if(email.length === 0 || password.length === 0 || password2.length === 0){

$(".alert").html("<p class = 'alert'>Preencha todos os campos !!!!</p>");           

}else{

if(password == password2){

   if(password.length < 6){

    $(".alert").html("<p class = 'alert'>A senha não pode ter menos de 6 caracteres !!!</p>");    

   }else{

   $.ajax({
     
    url:"http://localhost/PHP/cadastro/recuperar_senha2.php",    
    method: "POST",     
    dataType: "json",         
    data: {email:email,senha:password}     
   }).done(function(response){     
    
      
    if(response == "sucesso"){

        $(".alert").html("<p class = 'alert'>Senha atualizada com sucesso !!!</p>");    

    }else{

     if(response == "erro"){

        $(".alert").html("<p class = 'alert'>Dados inválidos !!!</p>"); 

     }else{

        $(".alert").html("<p class = 'alert'>A nova senha não pode ser igual a atual !!!</p>");       

     } 

    }

   });          


   }

}else{

    $(".alert").html("<p class = 'alert'>A senha não foi repetida !!!</p>"); 


}


}

});