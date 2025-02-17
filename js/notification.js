
function notificar(){     

let id = "id";          

$.ajax({

url:"http://localhost/PHP/cadastro/listar_avisos.php",   
method:"POST",     
dataType:"json",     
data:{id:id}


}).done(function(response){
    
    $(".avisos").html(response);   

    console.log(response);   

});    


}    

setInterval(notificar,1000);   


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

$(document).on("click","#ok1",function(){

let id = $(this).attr("data-id");        

$.ajax({
   
url:"http://localhost/PHP/cadastro/update_status.php",   
method:"POST",    
dataType:"json",   
data:{id:id}
}).done(function(response){
    
   console.log(response);     

});        

});          