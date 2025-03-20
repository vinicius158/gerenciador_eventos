$("#form").submit(function(e){

e.preventDefault();                

let email = $("#email").val();           

let senha = $("#senha").val();      

let senha2 = $("#senha2").val();     

if(email.length === 0 || senha.length === 0 || senha2.length === 0){

    $(".alert").html("<p class = 'alert'>Preencha todos os campos !!! </p>");  

}else{  

if(senha2.length < 6){
   
    $(".alert").html("<p class = 'alert'>A senha precisa ter no mínimo 6 caracteres !!! </p>");          

}else{     
    
    if(senha != senha2){    

        if($("#email").validate()){

$.ajax({       

    url : "http://localhost/PHP/cadastro/alterar_senha.php",      
    method: "POST",       
    dataType: "json",     
    data: {email: email, senha: senha, senha2: senha2}      

}).done(function(response){

    console.log(response);      

    if(response){

        $(".alert").html("<p class = 'alert'>Senha atualizada com sucesso !!! </p>");     

    }else{

        $(".alert").html("<p class = 'alert'>Dados inválidos !!!</p>");       

    }

});         

        }

}else{

    $(".alert").html("<p class = 'alert'>A nova senha não pode ser igual a atual !!!</p>");           


}

}    

}      

});    

function notification(){     

    let data = "id";   
    
    $.ajax({
    
    url:"http://localhost/PHP/cadastro/aviso.php",   
    method:"POST",   
    dataType:"json",    
    data:{data:data}
    
    }).done(function(response){
    
    $("#number").html("Notificações "+response);         

    $("#number2").html("Notificações "+response);         
    
    });    
    
    }     
    
    setInterval(notification,1000);            
