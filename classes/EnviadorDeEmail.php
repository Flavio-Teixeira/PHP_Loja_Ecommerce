<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once(__DIR__ . '/../PHPMailer/src/PHPMailer.php');
require_once(__DIR__ . '/../PHPMailer/src/SMTP.php');
require_once(__DIR__ . '/../PHPMailer/src/Exception.php');

class EnviadorDeEmail
{
    public function envia($mensagem)
    {
        $mail = new PHPMailer(true);

        try 
        {
            $mail->isSMTP();

            $mail->Host       = 'smtp.mailgun.org';                    
            $mail->SMTPAuth   = true;                                   
            $mail->Username   = 'postmaster@sandboxe25d4322f11647d59ccfbc20ad263d53.mailgun.org';                     
            $mail->Password   = '1bd4210a32f5b324d231f5f55d7418e1';                               
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         
            $mail->Port       = 587;                                    

            $mail->setFrom('postmaster@sandboxe25d4322f11647d59ccfbc20ad263d53.mailgun.org', 'Loja');
            $mail->addAddress('wandersonmaced@gmail.com', 'Flávio Teixeira');
            $mail->Subject = 'Novo Produto Cadastrado';
            $mail->Body = $mensagem;

            $mail->send();

            return true;
            
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

        return false;
    }
}