<?php
if (!isset($_POST["reciever"]) || !isset($_POST["subject"]) || !isset($_POST["text"])) {
    header("Location: mail.php");
    exit();
}

$reciever = $_POST["reciever"];
$subject = $_POST["subject"];
$text = $_POST["text"];

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "/srv/users/tim/PHPMailer/src/Exception.php";
require "/srv/users/tim/PHPMailer/src/PHPMailer.php";
require "/srv/users/tim/PHPMailer/src/SMTP.php";

include "config.php";

$mail = new PHPMailer(true);
try {
    //Server settings
    $mail->SMTPDebug = 0;
    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;
    $mail->Username = $phpmailer["email"];
    $mail->Password = $phpmailer["password"];
    $mail->SMTPSecure = "tls";
    $mail->Port = 587;

    //Recipients
    $mail->setFrom($phpmailer["email"], $phpmailer["name"]);
    $mail->addAddress($reciever);

    //Content
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $text;

    $mail->AltBody = $text;

    $mail->send();
} catch (Exception $e) {
    // Do nothing
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Send</title>
        <link rel="icon" href="assets/icon.png" type="image/icon type">
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <div class="stars"></div>

        <div class="container-4">
            <div class="success-box">
                <div class="success">
                    <img src="assets/success.png" alt="Success">
                </div>

                <h1>All done!</h1>
                <?php
                echo '<p>Email has been sent to<br>"' . $reciever . '"</p>'
                ?>

                <a href="mail.php" class="again"><p>Go again</p></a>
            </div>
        </div>
    </body>
</html>