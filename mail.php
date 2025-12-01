<?php

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//required files
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

//Create an instance; passing `true` enables exceptions
if (isset($_POST['submit'])) {
    $mail = new PHPMailer(true);

    //Server settings
    $mail->isSMTP();                              //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';       //Set the SMTP server to send through
    $mail->SMTPAuth   = true;             //Enable SMTP authentication
    $mail->Username   = 'abdulrahmanabdullahismart@gmail.com';   //SMTP write your email
    $mail->Password   = 'tidgoxhiodevnfvu';      //SMTP password
    $mail->SMTPSecure = 'ssl';            //Enable implicit SSL encryption
    $mail->Port       = 465;

    //Recipients
    $mail->setFrom($_POST["email"], 'MyPortfolio'); // Sender Email and name
    $mail->addAddress('abdulrahmanabdullahismart@gmail.com');     //Add a recipient email  
    $mail->addReplyTo($_POST["email"], $_POST["name"]); // reply to sender email

    //Content
    // $mail->isHTML(true);               //Set email format to HTML
    // $mail->Subject = $_POST["subject"];   // email subject headings
    // $mail->Body    = $_POST["message"];; //email message

//Content
$mail->isHTML(true); //Set email format to HTML
$mail->Subject = $_POST["subject"]; // Email subject headings

// Styled HTML Email Body
$mail->Body = '
    <div style="background: linear-gradient(to right, #6a11cb, #2575fc); padding: 30px; font-family: Arial, sans-serif;">
        <div style="max-width: 600px; background: white; padding: 25px; margin: auto; border-radius: 12px; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);">
            
            <h2 style="color: #333; text-align: center; font-size: 24px; font-weight: bold;">📩 New Message from Your Portfolio</h2>
            
            <hr style="border: 1px solid #ddd; margin: 15px 0;">
            
            <p style="font-size: 16px; color: #444;">
                <strong style="color: #6a11cb;">Name:</strong> ' . htmlspecialchars($_POST["name"]) . '<br>
                <strong style="color: #6a11cb;">Email:</strong> ' . htmlspecialchars($_POST["email"]) . '<br>
                <strong style="color: #6a11cb;">Subject:</strong> ' . htmlspecialchars($_POST["subject"]) . '
            </p>

            <div style="background: #f4f4f4; padding: 20px; border-left: 5px solid #6a11cb; border-radius: 8px; margin: 20px 0;">
                <p style="font-size: 16px; color: #333;">' . nl2br(htmlspecialchars($_POST["message"])) . '</p>
            </div>

            <p style="text-align: center;">
                <a href="mailto:' . htmlspecialchars($_POST["email"]) . '" style="background: #6a11cb; color: white; padding: 12px 25px; text-decoration: none; border-radius: 6px; font-size: 16px; font-weight: bold; display: inline-block;">Reply to Sender</a>
            </p>
            
            <hr style="border: 1px solid #ddd; margin: 20px 0;">
            <p style="text-align: center; font-size: 14px; color: #777;">This message was sent from your portfolio contact form.</p>
        </div>
    </div>
';



    // Success sent message alert
    $mail->send();

    echo
    " 
    <script> 
     alert('Message was sent successfully!');
     document.location.href = 'index.php';
    </script>
    ";
}else {
    echo
    " 
    <script> 
     alert('An Error occur');
     document.location.href = 'index.php';
    </script>
    ";
}
