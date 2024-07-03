<?php
require 'vendor_email/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $mail = new PHPMailer(true);

    // try {
    //     // Config SMTP
    //     $mail->SMTPDebug = 2; // Enable verbose debug output
    //     $mail->isSMTP(); // Set mailer to use SMTP
    //     $mail->Host       = 'smtp.example.com'; // Host SMTP Gmail
    //     $mail->SMTPAuth   = true;
    //     $mail->Username   = 'naoefal.arters0@gmail.com';
    //     $mail->Password   = 'ecrdcrurcqdgbqvm';
    //     $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    //     $mail->Port       = 587;

    //     // To
    //     $mail->setFrom('naoefal.arters0@gmail.com', 'Nanzy');
    //     $mail->addAddress('naufalamajid@gmail.com', 'Naufal');

    //     // Content
    //     $otp = rand(100000, 999999); // Generate 6-digit OTP
    //     $mail->isHTML(true);
    //     $mail->Subject = 'Your OTP Code';
    //     $mail->Body    = 'Your OTP code is: <b>' . $otp . '</b>';
    //     $mail->AltBody = 'Your OTP code is: ' . $otp;

    //     $mail->send();
    //     echo 'Message has been sent';
    // } catch (Exception $e) {
    //     echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    // }

    try {
        //Server settings
        $mail->SMTPDebug = 2; // Enable verbose debug output
        $mail->isSMTP(); // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->Username = 'naoefal.arters0@gmail.com'; // SMTP username
        $mail->Password = 'ecrdcrurcqdgbqvm'; // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption, `PHPMailer::ENCRYPTION_SMTPS` also accepted
        $mail->Port = 587; // TCP port to connect to
    
        //Recipients
        $mail->setFrom('naoefal.arters0@gmail.com', 'Nanzy');
        $mail->addAddress('naufalamajid@gmail.com', 'Naufal'); // Add a recipient
        // Name is optional
    
        // Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = 'Here is the subject';
        $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Try Send Mail</title>
</head>

<body>
    <form action="test.php" method="post">
        <button type="submit">Send</button>
    </form>
</body>

</html>