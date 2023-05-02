<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once "vendor/autoload.php";
$mail = new PHPMailer(true);

//Enable SMTP debugging.
//$mail->SMTPDebug = 3;                               
//Set PHPMailer to use SMTP.
$mail->isSMTP();            
//Set SMTP host name                          
$mail->Host = "akoneseo.com";
//Set this to true if SMTP host requires authentication to send email
$mail->SMTPAuth = true;  
//$mail->SMTPDebug = 2;                        
//Provide username and password     
$mail->Username = "mailclass-FGDhjAEmAH@ipsupport.in";                 
$mail->Password = "019310Aakash";    
$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);                       
//If SMTP requires TLS encryption then set it
$mail->SMTPSecure = "no";                           
//Set TCP port to connect to
$mail->Port = 587;                                   
$mail->From = "info@ipsupport.in";
$mail->FromName = "test";
$mail->addAddress("developer@jigsaw.edu.in");
$mail->isHTML(true);
$mail->Subject = "Test Mail 28th Apirl";
$mail->Body = "<i>szxdfgbhnjmk,l;kjhgfdsdfghjkl;kjhgfdfghjkl;./lkjhgfMail body in HTML</i>";
$mail->AltBody = "This is the plain text version of the email content";
try {
    $mail->send();
    echo "Message has been sent successfully";
} catch (Exception $e) {
    echo "Mailer Error: " . $mail->ErrorInfo;
}