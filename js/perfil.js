$("#input").submit(function(e){

    e.preventDefault();           

});   


function listar(){

let pesquisa = $("#busca").val();    

$.ajax({
   
    url: "http://localhost/PHP/cadastro/listar.php",        
    method: "POST",       
    dataType: "json",    
    data:{pesquisa:pesquisa}         


}).done(function(response){  
    
    
    if(response != false){      

      if(response == "nenhum"){      
      
      $(".eventos").html("<h2 class = 'message'>Nenhum evento encontrado !!!</h2>");        
      
      $(".pages").css("display","none");    

      }else{    

      console.log(response);    

      $(".eventos").html(response["html"]); 

      $(".pages2").html(response["buttons"]);  

      $(".pages").css("display","flex");            
      
      }     


    }else{

       console.log("Erro ao carregar !!!");    

    }     
    
        

});  

}            

setInterval(listar, 1000);       


$(document).on("click",".excluir",function(){

let id = $(this).attr("data-id");      

let retorno = confirm("Deseja exluir esse evento ????");            

if(retorno){     
    
$.ajax({  

 url: "http://localhost/PHP/cadastro/excluir_evento.php",    
 method: "POST",       
 dataType: "json",     
 data: {id:id}

}).done(function(result){
    
    if(result){     

        alert("Evento excluído com sucesso !!!");     


    }else{

        alert("Erro ao excluir evento !!!");              

    }

});

}


});            

$(document).on("click",".editar",function(){

let id = $(this).attr("data-id"); 

window.location.href = "update_evento.php?id="+id;       

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
    
    $(document).on("click","#btn",function(){

    let pag = $(this).attr("data-id");          

    $.ajax({
     
    url:"http://localhost/PHP/cadastro/page.php",     
    method:"POST",   
    dataType:"json",    
    data:{pag:pag}
    
    }).done(function(response){

    console.log("A página é "+response);     

    });   



});






      