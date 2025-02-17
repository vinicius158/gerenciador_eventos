
function atualizar(){

let url = window.location.href;      

let url2 = new URL(url);   

let id = url2.searchParams.get("id");       

$.ajax({

url:"http://localhost/PHP/cadastro/consulta_evento.php",   
method: "POST",   
dataType: "json",     
data: {id:id}      

}).done(function(response){          
    
  $("#nome").attr("placeholder","Nome: "+response["nome"]);         
  
  $("#data").attr("placeholder","Data: "+response["data"]);        
  
  $("#hora").attr("placeholder","Hora: "+response["hora"]);  
  
 /* $("#frame").attr("src","img_eventos/"+response["imagem"]); */     
  
});          

}         

setInterval(atualizar, 1000);         

$("#form").submit(function(e){

e.preventDefault();         

let nome = $("#nome").val();     

let data = $("#data").val();    

let hora = $("#hora").val();     

let imagem = document.getElementById("imagem");         

if(nome.length === 0 && data.length === 0 && hora.length === 0 && imagem.files.length === 0){       

$(".alert").html("<p class = 'alert'>Preencha algum campo !!!</p>");

}else{

if(imagem.files.length > 0){

   if(imagem.files[0].type != "image/png"){
    
    $(".alert").html("<p class = 'alert'>Esse arquivo não é formato png !!!</p>");

   }else{  
    
    if(data.length > 0){
    
    if(new Date(data) > new Date()){

    let form = document.querySelector("#form");     

    let dados = new FormData(form);    
     
    $.ajax({
    
    type: "POST",      
    url: "http://localhost/PHP/cadastro/editar_evento.php",         
    data:dados,             
    contentType:false,     
    processData: false,    
    success:function(e){
     
    if(e){

    $(".alert").html("<p class = 'alert'>Atualização feita com sucesso !!!</p>");

    }else{

      $(".alert").html("<p class = 'alert'>Erro de atualização !!!</p>");

    }

      }


    });      
    
  }else{

    $(".alert").html("<p class = 'alert'>A data não pode estar no passado !!!</p>");

  }  

} else{
  
    let form = document.querySelector("#form");     

    let dados = new FormData(form);    
     
    $.ajax({
    
    type: "POST",      
    url: "http://localhost/PHP/cadastro/editar_evento.php",         
    data:dados,             
    contentType:false,     
    processData: false,    
    success:function(e){
     
      if(e){

        $(".alert").html("<p class = 'alert'>Atualização feita com sucesso !!!</p>");
    
        }else{
    
          $(".alert").html("<p class = 'alert'>Erro de atualização !!!</p>");
    
        }

      }


    }); 

}    
      

   }

}else{    
    
    if(data.length === 0){
     
      let form = document.querySelector("#form");     

      let dados = new FormData(form); 
  
      $.ajax({
      
      type: "POST",      
      url: "http://localhost/PHP/cadastro/editar_evento.php",         
      data:dados,             
      contentType:false,     
      processData: false,    
      success:function(e){
       
        if(e){
  
          $(".alert").html("<p class = 'alert'>Atualização feita com sucesso !!!</p>");
      
          }else{
      
            $(".alert").html("<p class = 'alert'>Erro de atualização !!!</p>");
      
          }    
  
      }
  
  
      }); 

    }else{
       
      if(new Date(data) > new Date()){

        let form = document.querySelector("#form");     

        let dados = new FormData(form); 
    
        $.ajax({
        
        type: "POST",      
        url: "http://localhost/PHP/cadastro/editar_evento.php",         
        data:dados,             
        contentType:false,     
        processData: false,    
        success:function(e){
         
          if(e){
    
            $(".alert").html("<p class = 'alert'>Atualização feita com sucesso !!!</p>");
        
            }else{
        
              $(".alert").html("<p class = 'alert'>Erro de atualização !!!</p>");
        
            }    
    
        }
    
    
        }); 


      }else{

        $(".alert").html("<p class = 'alert'>A data não pode estar no passado !!! </p>");       

      }

      
    }    


}

}

});  

    

