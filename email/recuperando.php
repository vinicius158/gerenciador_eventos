<?php        

    require "PHPMailer\PHPMailer\php-mailer\PHPMailerAutoload.php";      

    $senha2 = "axtbztdkuemphpll"; 
    
    $mail = new PHPMailer();    
    
    $address = $email;       
    $subject = utf8_decode("Email de teste");     
    $link = "https://localhost/Loja/Update_senha2.php?email=".$email;     
    $body .= utf8_decode("<b>Atualize sua senha</b><br><br><i>");     
    $body .=utf8_decode("<a href = ".$link.">Clique aqui</a></i>"); 
    
    $mail->isSMTP();
    $mail->SMTPOptions = array( 'ssl' => array( 'verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true ) );
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';
    $mail->Username = 'vinicius.bispo013@gmail.com';
    $mail->Password = $senha2;
    $mail->setFrom('vinicius.bispo013@gmail.com',"Loja013");
    $mail->addAddress("tecweb013@gmail.com", 'Contato');
    $mail->Port = 587;    
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $body;  
    

    if($mail->send()){

    echo "Email enviado com sucesso !!!!";     

    }
    
    else{

    echo "Erro !!!";      


    }  



?>