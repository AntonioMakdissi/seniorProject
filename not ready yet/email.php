<?php
// $to = "52030108@studentsw.liu.edu.lb";
// $subject = "Test Email";
// $message = "This is a test email sent from PHP.";
// $headers = "From: antoniomakdissi1@gmail.com";

// if(mail($to, $subject, $message, $headers)) {
//   echo "Email sent successfully.";
// } else {
//   echo "Email sending failed.";
// }


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load PHPMailer dependencies
require 'vendor/autoload.php';

//Create an instance of PHPMailer class
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'your_email@gmail.com';                  //SMTP username
    $mail->Password   = 'your_email_password';                   //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('your_email@gmail.com', 'Your Name');
    $mail->addAddress('recipient@example.com', 'Recipient Name');     //Add a recipient

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Test Email';
    $mail->Body    = '<h1>This is a test email sent using PHPMailer library.</h1>';

    $mail->send();
    echo 'Email has been sent';
} catch (Exception $e) {
    echo "Email sending failed: {$mail->ErrorInfo}";
}

?>