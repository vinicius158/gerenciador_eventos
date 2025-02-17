
$("#form2").submit(function(e){

    e.preventDefault();         
    
    let nome = $("#nome").val();            

    let data = $("#data").val();  
    
    console.log(data);    

    let horario = $("#horario").val();  
    
    let imagem = document.getElementById("imagem");     
    
    if(nome.length === 0 || data.length === 0 || horario.length === 0 || imagem.files.length == 0){

    $(".alert").html("<p class = 'alert'>Prencha todos os campos !!! </p>");            

    }else{
    
    if(imagem.files[0].type != "image/png"){

    $(".alert").html("<p class = 'alert'>O arquivo não é formato png !!!</p>");             

    }else{        
        
    let data_atual = new Date();    

    data_atual.setHours(0, 0, 0, 0);     
    
    let data_fornecida = new Date(data+'T00:00:00');     
    
    console.log("Data atual: "+data_atual);   

    console.log("Data fornecida: "+data_fornecida); 
        
    if(data_fornecida > data_atual){

    let nome_imagem = imagem.files[0].name;          

    $.ajax({
     
    url:"http://localhost/PHP/cadastro/adicionar_evento.php",             
    method:"POST",          
    dataType:"json",         
    data: {nome:nome,data:data,horario:horario,nome_imagem:nome_imagem}          

    }).done(function(response){           
    
    if(response == false){

        $(".alert").html("<p class = 'alert'>Erro ao cadastrar !!! </p>");             

    }else{       

        $(".alert").html("<p class = 'alert'>Evento adicionado com sucesso !!! </p>");        

        enviar_arquivo();               

    }

    });  
         
}else{

    $(".alert").html("<p class = 'alert'>A data do evento não está no futuro !!!</p>"); 

 }

    }          

}      

    function enviar_arquivo(){          

    let form = document.getElementById("form2");        

    let arquivo = new FormData(form);                    

    $.ajax({
     
        type:"POST",     
        url:"http://localhost/PHP/cadastro/upload.php",    
        data:arquivo, 
        processData: false, 
        contentType: false,      
        success:function(response){

        console.log(response);     

        }

    });          

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
