<?php              

class Usuario {

    private $nome;  
    private $email;   
    private $senha;       
    private $status;           

    public function cadastrar($BD,$nome,$email,$password){
        $this->nome = $nome;    
        $this->email = $email; 
        $this->senha = $password;     
        $this->status = "desativada";                                  

        // Verifica se o email já existe no banco
        $query = "SELECT * FROM usuario WHERE email = :email";        
        $comand = $BD->prepare($query);        
        $comand->bindValue(":email", $this->email);          

        if ($comand->execute()) {         
            if ($comand->rowCount() == 0) {
                // Insere o novo usuário
                $sql = "INSERT INTO usuario(nome, email, senha, status) VALUES(:nome, :email, :senha, :status)";          
                $cmd = $BD->prepare($sql);        
                $cmd->bindValue(":nome", $this->nome);
                $cmd->bindValue(":email", $this->email);
                $cmd->bindValue(":senha", $this->senha);          
                $cmd->bindValue(":status", $this->status);         

                if ($cmd->execute()) {   
                    // Obtém o ID do novo usuário
                    $sql = "SELECT id_usuario FROM usuario WHERE email = :email";           
                    $comand = $BD->prepare($sql);      
                    $comand->bindValue(":email", $this->email);             
                    $comand->execute();           
                    $result = $comand->fetch(PDO::FETCH_ASSOC);         
                    $id_usuario = $result["id_usuario"];          

                    // Envia o email de ativação
                    require "email/PHPMailer/PHPMailer/php-mailer/PHPMailerAutoload.php";             
                    $senha2 = "********"; 

                    $mail = new PHPMailer();    
                    $body = "";   
                    $address = $email;       
                    $subject = utf8_decode("Confirmação de email");     
                    $link = "http://localhost/PHP/cadastro/perfil.php?id_usuario=$id_usuario";      
                    $body .= utf8_decode("<b>Ative sua conta</b><br><br><i>");     
                    $body .= utf8_decode("<a href='$link'>Clique aqui</a></i>"); 

                    $mail->isSMTP();
                    $mail->SMTPOptions = array(
                        'ssl' => array(
                            'verify_peer' => false, 
                            'verify_peer_name' => false, 
                            'allow_self_signed' => true
                        )
                    );
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->SMTPSecure = 'tls';
                    $mail->Username = 'vinicius.bispo013@gmail.com';
                    $mail->Password = $senha2;
                    $mail->setFrom('vinicius.bispo013@gmail.com', "Gerenciador de eventos");     
                    $mail->addAddress($this->email, 'Contato');
                    $mail->Port = 587;    
                    $mail->isHTML(true);
                    $mail->Subject = $subject;
                    $mail->Body = $body;         
                    $mail->send();      

                    return "sucesso";            
                          
                } else {
                    return "erro";     
                }    
            } else {
                return "existe";       
            }
        } else {
            return "erro";           
        }
    }      

    public function verificar($BD, $id_usuario) {
        $sql = "SELECT status FROM usuario WHERE id_usuario = :id_usuario";          
        $comand = $BD->prepare($sql);          
        $comand->bindValue(":id_usuario", $id_usuario);      

        if ($comand->execute()) {
            $response = $comand->fetch(PDO::FETCH_ASSOC);        

            if ($response["status"] == "desativada") {
                $sql = "UPDATE usuario SET status = 'ativada' WHERE id_usuario = :id_usuario";        
                $comand = $BD->prepare($sql);              
                $comand->bindValue(":id_usuario", $id_usuario);   

                if ($comand->execute()) {
                    return "ativo";    
                } else {
                    return "erro";   
                }
            } else {
                return "url";                 
            }
        } else {
            return "erro";    
        }
    }            

    public function login($BD, $email, $senha){           

        
        $sql = "SELECT * FROM usuario WHERE email = :email";         
        $comand = $BD->prepare($sql);      
        $comand->bindValue(":email", $email);         
        $comand->execute();        

        if ($comand->rowCount() > 0) {
            // Obtém a senha criptografada
            $sql = "SELECT senha FROM usuario WHERE email = :email";        
            $comand = $BD->prepare($sql);       
            $comand->bindValue(":email", $email);          
            $comand->execute();       
            $response = $comand->fetch(PDO::FETCH_ASSOC);      
            $cripto = $response["senha"];         

            // Verifica a senha com password_verify()
            if (password_verify($senha, $cripto)) {          
                $sql = "SELECT nome, id_usuario, status FROM usuario WHERE email = :email";      
                $comand = $BD->prepare($sql);      
                $comand->bindValue(":email", $email);       
                $comand->execute();     
                $response = $comand->fetch(PDO::FETCH_ASSOC);  

                if ($response["status"] == "ativada") {
                    session_start();         
                    $_SESSION["pag"] = intval(1);        
                    $_SESSION["itens_pagina"] = 6;      
                    $_SESSION["nome"] = $response["nome"];   
                    $_SESSION["id_usuario"] = $response["id_usuario"];      
                    return "sucesso";        
                    
                } else {
                    return "inativa";       
                }
            } else {
                return "invalido1";     
            }
        } else {
            return "invalido";       
        }
    }       
    
    public function update_senha($BD,$email,$password,$password2){      

    session_start();           

    $id_usuario = $_SESSION["id_usuario"];       

    $sql = "SELECT * FROM usuario WHERE email = :email and id_usuario = :id_usuario";         
    
    $comand = $BD->prepare($sql);    

    $comand->bindValue(":email",$email);       
    
    $comand->bindValue(":id_usuario",$id_usuario);          

    $comand->execute();           

    if($comand->rowCount() > 0){
      
    $query = "SELECT senha FROM usuario WHERE email = :email";  
    
    $cmd = $BD->prepare($query);                 

    $cmd->bindValue(":email", $email);          
    
    $cmd->execute();           

    $response = $cmd->fetch(PDO::FETCH_ASSOC);                         

    if(password_verify($password,$response["senha"])){

    $sql = "UPDATE usuario SET senha = :senha WHERE email = :email";        

    $comand = $BD->prepare($sql);         

    $comand->bindValue(":senha",$password2);     

    $comand->bindValue(":email",$email);             
    
    if($comand->execute()){

     return true;          

    }     

    }else{

    return false;     

    }

    } else{

    return false;          

    }

            
    }       
    
    public function update_senha2($BD,$email,$password,$id_usuario){
    
    $sql = "SELECT * FROM usuario WHERE id_usuario = :id_usuario and email = :email";              
    
    $comand = $BD->prepare($sql);       

    $comand->bindValue(":id_usuario",$id_usuario);               

    $comand->bindValue(":email",$email);     

    $comand->execute();       

    if($comand->rowCount() > 0){          

    $sql = "SELECT senha FROM usuario WHERE email = :email";      
    
    $comand = $BD->prepare($sql);        

    $comand->bindValue(":email",$email);           

    $comand->execute();     

    $response = $comand->fetch(PDO::FETCH_ASSOC);     

    if(!password_verify($password,$response["senha"])){

    $sql = "UPDATE usuario SET senha = :senha WHERE email = :email and id_usuario = :id_usuario";       
    
    $comand = $BD->prepare($sql);       

    $comand->bindValue(":senha",$password);        

    $comand->bindValue(":email",$email);      

    $comand->bindValue(":id_usuario", $id_usuario);        
    
    if($comand->execute()){

    return true;    

    }else{

    return false;      

    }          

}else{

   return "senha";       

}

     }else{
     
    return false;    

     }

    }

    public function gerar_link($BD,$email){

    session_start();       
    
    $id_link = md5($email.date("H:i:s d/m/Y"));     

    $sql = "SELECT id_usuario FROM usuario WHERE email = :email";      

    $comand = $BD->prepare($sql);               

    $comand->bindValue(":email",$email);         

    $comand->execute();    
    
    if($comand->rowCount() > 0){       

    $result = $comand->fetch(PDO::FETCH_ASSOC);        

    $id_usuario = $result["id_usuario"];          
     
    $sql = "INSERT INTO link(id_link,fk_id_usuario,status) VALUES(:id_link,:id_usuario,:status)";            

    $comand = $BD->prepare($sql);       

    $comand->bindValue(":id_link", $id_link);          
    
    $comand->bindValue(":id_usuario",$id_usuario);           

    $comand->bindValue(":status","ativada");            

    if($comand->execute()){

    /** Realizar o envio do email de recuperação*/         
    
    $this->enviar_link($email,$id_usuario,$id_link);        
    
    return true;                 

    }else{

    return false;    

    }

    } else{

    return false;     


       }
           
    }     

    private function enviar_link($email,$id_usuario,$id_link){
     
    require "email/PHPMailer/PHPMailer/php-mailer/PHPMailerAutoload.php";            

                    $senha2 = "*******"; 

                    $mail = new PHPMailer();    
                    $body = "";   
                    $address = $email;       
                    $subject = utf8_decode("Recuperação de senha");              
                    $link = "http://localhost/PHP/cadastro/recuperar_senha.php?id_usuario=$id_usuario&id_link=$id_link";         
                    /*$body .= utf8_decode("<b>Ative sua conta</b><br><br><i>");*/        
                    $body .= utf8_decode("<a href='$link'>Clique aqui</a></i>"); 

                    $mail->isSMTP();
                    $mail->SMTPOptions = array(
                        'ssl' => array(
                            'verify_peer' => false, 
                            'verify_peer_name' => false, 
                            'allow_self_signed' => true
                        )
                    );
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->SMTPSecure = 'tls';
                    $mail->Username = 'vinicius.bispo013@gmail.com';
                    $mail->Password = $senha2;
                    $mail->setFrom('vinicius.bispo013@gmail.com', "Gerenciador de eventos");     
                    $mail->addAddress($email, 'Contato');   
                    $mail->Port = 587;    
                    $mail->isHTML(true);
                    $mail->Subject = $subject;
                    $mail->Body = $body;         
                    $mail->send(); 


    }

    public function link_status($BD,$id_link){

    $sql = "UPDATE link SET status = :status WHERE id_link =:id_link";      
    
    $comand = $BD->prepare($sql);     

    $comand->bindValue(":status","desativada");         
    
    $comand->bindValue(":id_link",$id_link);       
    
    $comand->execute();    

    }     

    public function adicionar_evento($nome,$data,$data_aviso,$horario,$nome_imagem,$id_usuario,$BD){
    
        $sql = "INSERT INTO evento(nome,fk_usuario,data,data_aviso,hora,imagem) VALUES(:nome,:fk_usuario,:data,:data_aviso,:hora,:imagem)";      

        $comand = $BD->prepare($sql);      

        $comand->bindValue(":nome",$nome);      
        $comand->bindValue(":fk_usuario",$id_usuario);        
        $comand->bindValue(":data",$data);     
        $comand->bindValue(":data_aviso",$data_aviso);     
        $comand->bindValue(":hora",$horario);          
        $comand->bindValue(":imagem",$nome_imagem);       

        if($comand->execute()){    
            
            $query = "SELECT MAX(id_evento) as id_evento FROM evento WHERE fk_usuario = '$id_usuario'";         

            $retorno = $BD->prepare($query);         

            $retorno->execute();            

            $response = $retorno->fetch(PDO::FETCH_ASSOC);      

            $id_evento = $response["id_evento"];    

            $sql = "INSERT INTO notification(id_usuario,id_evento,nome_evento,data_evento,data_aviso,hora,status) 
            VALUES(:id_usuario,:id_evento,:nome_evento,:data_evento,:data_aviso,:hora,:status)";    
            
            $comand = $BD->prepare($sql);        

            $comand->bindValue(":id_usuario",$id_usuario);   
            $comand->bindValue(":id_evento",$id_evento);        
            $comand->bindValue(":nome_evento",$nome);     
            $comand->bindValue(":data_evento",$data);     
            $comand->bindValue(":data_aviso",$data_aviso);     
            $comand->bindValue(":hora",$horario);         
            $comand->bindValue(":status",1);         

            $comand->execute();   

            return true;     

        }else{

           return false;       

        }
    

    }      

    public function upload($nome_imagem,$localidade){   

    if(move_uploaded_file($localidade,$nome_imagem)){
     
    return true;  

    }else{

    return false;        

    }

    }    

    public function listar($pesquisa,$BD){

    session_start();      

    $vetor["html"] = "";     
    
    $pag = intval($_SESSION["pag"]);  
    
    $offset = ($pag - 1) * 6;

    $id_usuario = $_SESSION["id_usuario"];       

    $sql = "SELECT nome,DATE_FORMAT(data,'%d/%m/%Y') as data,DATE_FORMAT(hora,'%H:%i') as hora,imagem,id_evento FROM evento WHERE nome LIKE '%$pesquisa%' and fk_usuario = $id_usuario LIMIT 6 OFFSET $offset";       
    
    $comand = $BD->prepare($sql);      

    if($comand->execute()){ 
        
    if($comand->rowCount() > 0){
        
   /* $vetor["total"] = $comand->rowCount();*/     

    while($response = $comand->fetch(PDO::FETCH_ASSOC)){     

    $imagem = $response["imagem"];       

    $nome = $response["nome"];      

    $data = $response["data"];      
    
    $hora = $response["hora"];   
    
    $id_evento = $response["id_evento"];   
    

    $vetor["html"] .="         
    
    <div class='item'><img class='foto' src = 'img_eventos/$imagem'>   

<p class = 'nome' id = 'nome'> <b>$nome</b> </p>  

<p class = 'nome'> <b>Data : $data</b> </p>      

<p class = 'nome'> <b>Hora - $hora</b> </p>        

<button class = 'editar' data-id = '$id_evento'>   
    
<i class='fa-solid fa-pen-to-square' style = 'font-size:20px;'></i>     
    
</button>

<button class = 'excluir' data-id = '$id_evento' >    
<i class='fa fa-trash' aria-hidden='true' style = 'font-size:20px;'></i>    
</button>      

</div> 
    
    
    ";      

    }     
    
    
$sql = "SELECT * FROM evento WHERE fk_usuario = $id_usuario";       

$comand = $BD->prepare($sql);       

$comand->execute();          

$total_eventos = $comand->rowCount(); 

$total_pages = ceil($total_eventos / 6);   

$vetor["total_pages"] = $total_pages;  

$vetor["page_select"] = $pag;         

$pag_interval = 3;     

$pag_init = max($pag - $pag_interval, 1);         

$pag_final = min($total_pages, $pag + $pag_interval);    

$vetor["buttons"] = "";       

for($p = $pag_init; $p <= $pag_final; $p++){

$vetor["buttons"] .= "<div class='item2' data-id = '$p' id = 'btn'>$p</div>"; 

}   

return $vetor;   
    
}else{

return "nenhum";   

}   
    
}else{

$vetor["html"] = false;    

  }              

}        

public function notification($id_usuario,$BD){

    date_default_timezone_set("America/Sao_Paulo");  
     
    $data_atual = date("Y-m-d");    

// Consultando as notificações na tabela 'notification'

$sql = "SELECT * FROM notification WHERE data_aviso = :data_atual AND id_usuario = :id_usuario";       
$comand = $BD->prepare($sql);
$comand->bindParam(':data_atual', $data_atual, PDO::PARAM_STR);
$comand->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
$comand->execute();

if ($comand->rowCount() > 0) {
    // Processando as notificações
    while ($response = $comand->fetch(PDO::FETCH_ASSOC)){     
        $id_notification = $response["id_notification"];

        // Verificando se a notificação já existe na tabela 'notification2'
        $sql2 = "SELECT * FROM notification2 WHERE id_notification = :id_notification AND id_usuario = :id_usuario";
        $comand2 = $BD->prepare($sql2);
        $comand2->bindParam(':id_notification', $id_notification, PDO::PARAM_INT);
        $comand2->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $comand2->execute();

        if ($comand2->rowCount() == 0) {
            // Inserindo a notificação na tabela 'notification2' (caso ainda não tenha sido inserida)
            $id_evento = $response["id_evento"];
            $nome_evento = $response["nome_evento"];
            $data_evento = $response["data_evento"];
            $data_aviso = $response["data_aviso"];
            $hora = $response["hora"];
            $status = $response["status"];

            $sql3 = "INSERT INTO notification2 (id_notification, id_usuario, id_evento, nome_evento, data_evento, data_aviso, hora, status)
                     VALUES (:id_notification, :id_usuario, :id_evento, :nome_evento, :data_evento, :data_aviso, :hora, :status)";
            $comand3 = $BD->prepare($sql3);
            $comand3->bindParam(':id_notification', $id_notification, PDO::PARAM_INT);
            $comand3->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $comand3->bindParam(':id_evento', $id_evento, PDO::PARAM_INT);
            $comand3->bindParam(':nome_evento', $nome_evento, PDO::PARAM_STR);
            $comand3->bindParam(':data_evento', $data_evento, PDO::PARAM_STR);
            $comand3->bindParam(':data_aviso', $data_aviso, PDO::PARAM_STR);
            $comand3->bindParam(':hora', $hora, PDO::PARAM_STR);
            $comand3->bindParam(':status', $status, PDO::PARAM_INT);
            $comand3->execute();
        }
    }

    // Verificando o número de notificações com status = 1 na tabela 'notification2'
    $query = "SELECT * FROM notification2 WHERE id_usuario = :id_usuario AND status = 1";
    $comand4 = $BD->prepare($query);
    $comand4->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
    $comand4->execute();         

    $number = $comand4->rowCount();      

} else {    

    $query = "SELECT * FROM notification2 WHERE id_usuario = :id_usuario AND status = 1";
    $comand4 = $BD->prepare($query);
    $comand4->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
    $comand4->execute();         

    $number = $comand4->rowCount();       

    return $number;     
}

return $number;   

}

public function excluir_evento($id,$BD){

$sql = "DELETE FROM evento WHERE id_evento = :id_evento";       

$comand = $BD->prepare($sql);      

$comand->bindValue(":id_evento",$id);        

if($comand->execute()){         

$sql = "DELETE FROM notification WHERE id_evento = :id_evento";       

$comand = $BD->prepare($sql);      
    
$comand->bindValue(":id_evento",$id);   

 if($comand->execute()){

 return true;      

 }else{

return false;        

 }  

}else{

return false; 

}

}    

public function consultar_evento($id,$BD){

$sql = "SELECT nome,DATE_FORMAT(data,'%d/%m/%Y') as data,hora,imagem FROM evento WHERE id_evento = :id_evento";           

$comand = $BD->prepare($sql);    

$comand->bindValue(":id_evento",$id);            

if($comand->execute()){

$response = $comand->fetch(PDO::FETCH_ASSOC);    

$vetor = [
    
"nome" => $response["nome"],   
"data" => $response["data"],   
"hora" => $response["hora"],     
"imagem" => $response["imagem"]

];     

return $vetor;   

}

}    

public function update_evento($id_evento,$nome,$data,$hora,$imagem,$localidade,$BD){

if(!empty($nome)){

$sql = "UPDATE evento SET nome = :nome WHERE id_evento = :id_evento";      

$comand = $BD->prepare($sql);          

$comand->bindValue(":id_evento",$id_evento);      

$comand->bindValue(":nome",$nome);          

$comand->execute();    

}     

if(!empty($data)){

    $sql = "UPDATE evento SET data = :data WHERE id_evento = :id_evento";      

    $comand = $BD->prepare($sql);          
    
    $comand->bindValue(":id_evento",$id_evento);      
    
    $comand->bindValue(":data",$data);          
    
    $comand->execute();  

}     

if(!empty($hora)){     

    $sql = "UPDATE evento SET hora = :hora WHERE id_evento = :id_evento";      

    $comand = $BD->prepare($sql);          
    
    $comand->bindValue(":id_evento",$id_evento);      
    
    $comand->bindValue(":hora",$hora);          
    
    $comand->execute();  


}       

if(!empty($imagem)){

    $sql = "UPDATE evento SET imagem = :imagem WHERE id_evento = :id_evento";      

    $comand = $BD->prepare($sql);          
    
    $comand->bindValue(":id_evento",$id_evento);      
    
    $comand->bindValue(":imagem",$imagem);          
    
    $comand->execute();     
    
    move_uploaded_file($localidade,"img_eventos/".$imagem);      

}       

return true;     

}      

public function listar_avisos($id_usuario,$BD){         

$sql = "SELECT nome_evento,DATE_FORMAT(data_evento,'%d/%m/%Y') as data_evento,DATE_FORMAT(hora,'%H:%i') as hora,status,id_notification FROM notification2 WHERE id_usuario = :id_usuario ORDER BY id_notification DESC";     

$comand = $BD->prepare($sql);            

$comand->bindValue(":id_usuario",$id_usuario);       

$comand->execute();    

$html = "";    

if($comand->rowCount() > 0){

while($response = $comand->fetch(PDO::FETCH_ASSOC)){

$nome = $response["nome_evento"];     

$data = $response["data_evento"];  

$hora = $response["hora"];    

$id_notification = $response["id_notification"];    

if($response["status"] == 1){

$html .= "

<tr>  
<td><b>$nome</b></td>      
<td><b>$data</b></td>      
<td><b>$hora</d></td>      
<td><i class='fa fa-check-circle' id = 'ok1' style = 'font-size:30px; color:#228B22' data-id = '$id_notification'></i></td>       
</tr> 


";

}else{

   $html  .= "<tr>  
    <td><b>$nome</b></td>      
    <td><b>$data</b></td>      
    <td><b>$hora</d></td>      
    <td><i class='fa fa-check-circle' id = 'ok2' style = 'font-size:30px; color:#A9A9A9;'></i></td>       
    </tr>";


}

}     

return $html;     

}else{

$html .= "<h2>Nenhuma notificação !!!</h2>";     

return $html;    


}

}     

public function update_status($id_usuario,$id_notification,$BD){

$sql = "UPDATE notification2 SET status = 2 WHERE id_usuario = :id_usuario AND id_notification = :id_notification";    

$comand = $BD->prepare($sql);         

$comand->bindValue(":id_usuario",$id_usuario);       
$comand->bindValue(":id_notification",$id_notification);           

if($comand->execute()){

return true;         

}else{

return false;      

}

}

}

?>
      
