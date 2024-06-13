<?php
// Load Composer's autoloader
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $search = htmlspecialchars(trim($_POST['search']));
    $country = htmlspecialchars(trim($_POST['country']));
    $options = htmlspecialchars(trim($_POST['options']));
    $activeties = htmlspecialchars($_POST['activeties']);
    $times = htmlspecialchars($_POST['times']);
    $num = htmlspecialchars($_POST['num']);
    $child = htmlspecialchars($_POST['child']);
    $from = htmlspecialchars($_POST['from']);
    $to = htmlspecialchars($_POST['to']);

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'sandbox.smtp.mailtrap.io';                     // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = '72d2f7518d0f7c';               // SMTP username
        $mail->Password   = 'bec11c9679945d';               // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
        $mail->Port       = 587;       
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        //Recipients
        $mail->setFrom('from@example.com', 'Mailer');
        $mail->addAddress($email, $name);     // Add a recipient

             
        $mail->isHTML(true);                                  
        $mail->Body = "
        <html>
        <head>
            <title>Test</title>
        </head>
        <body>
            <h2>Contact Form Submission</h2>
            <p><strong>Name:</strong> $name</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>search:</strong> $search</p>
            <p><strong>country:</strong></p>
            <p>$country</p>
            <p><strong>options:</strong> $options</p>
            <p><strong>activeties:</strong> $activeties</p>
            <p><strong>times:</strong> $times</p>
            <p><strong>num:</strong> $num</p>
            <p><strong>child:</strong> $child</p>
            <p><strong>from:</strong> $from</p>
            <p><strong>to:</strong> $to</p>
        </body>
        </html>
        ";
        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
