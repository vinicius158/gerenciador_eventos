$("#form").submit(function(e){

    e.preventDefault();   
    
    let email = $("#email").val();    

    let email2 = $("#email2").val();      

    if(email.length === 0 || email2.length === 0){

    $(".alert").html("<p class = 'alert'>Preencha todos os campos !!! </p>");  

    }else{

       if(email == email2){      

     if($("#email").validate()){
    
     $.ajax({
       
        url:"http://localhost/PHP/cadastro/enviando.php",            
        method: "POST",    
        dataType: "json",   
        data: {email:email}       

    }).done(function(response){
         
       if(response == "sucesso"){

         $(".alert").html("<p class = 'alert'>Email de recuperação enviado !!!</p>");       

       }else{

         $(".alert").html("<p class = 'alert'>Dados inválidos !!!</p>");             

       }

          
    });     
       }

       }else{

        $(".alert").html("<p class = 'alert'>O email não foi repetido !!! </p>");      


       }


    }


});   
