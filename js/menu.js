
var n = 0;   

function clicou(){

n++     

if(n == 1){

const v1 = document.querySelector("#toggle");     

v1.classList.add("fa-x");   

const v2 = document.querySelector(".menu2");          

v2.classList.add("clique");    

} else 

{

n = 0;  

const v1 = document.querySelector("#toggle");     

v1.classList.remove("fa-x");      

v1.classList.add("fa-bars");    

const v2 = document.querySelector(".menu2");          

v2.classList.remove("clique");  

   }

}            