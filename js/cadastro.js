
$("#dados").submit(function(e){

e.preventDefault();   

const nome = $("#nome").val();     

const email = $("#email").val();        

const senha = $("#senha").val();             

if(nome.length === 0 || email.length === 0 || senha.length === 0){

console.log("Preenche todos os campos !!!");  

$(".alert").html("<p class = 'alert'>Preencha todos os campos !!!! </p>");         

}else{              

if(senha.length < 6){

$(".alert").html("<p class = 'alert'>A senha precisa ter no mínimo 6 caracteres </p>");  

}else{      

    if($("#email").validate()){

$.ajax({

    url : "http://localhost/PHP/cadastro/inserir.php",        
    method : "POST",     
    dataType : "json",   
    data : {nome: nome, email: email, senha: senha}         

}).done(function(response){               
    
    console.log(response);       
    
    if(response == "sucesso"){     

        $(".alert").html("<p class = 'alert'>Cadastro feito com sucesso !!! </p>");     

    }  else{

    if(response == "existe"){       

        $(".alert").html("<p class = 'alert'>Email já existente !!! </p>");       

    } else{    

        $(".alert").html("<p class = 'alert'>Erro inesperado !!! </p>");         

    }


    }    


});         

}


}     

}  

});     

