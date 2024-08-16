<?php
session_start();

if (isset($_SESSION["notext"]) && $_SESSION["notext"] === true) {
    header("Location: mail.php");
    exit();
}

if (isset($_SESSION["text"])) {
    $reciever = $_SESSION["reciever"];
    $subject = $_SESSION["subject"];
    $text = $_SESSION["text"];
} else {
    header("Location: mail.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Result</title>
        <link rel="icon" href="assets/icon.png" type="image/icon type">
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <div class="stars"></div>

        <div class="container-3">
            <div class="processed-email">
                <div class="color">
                    <form action="send.php" method="post" class="mail-content">
                        <?php
                        echo '<h2 class="subtitle">Reciever</h2>';
                        echo '<input id="reciever" name="reciever" type="text" value="' . $reciever . '">';

                        echo '<h2 class="subtitle">Subject</h2>';
                        echo '<input id="subject" name="subject" type="text" value="' . $subject . '">';

                        echo '<h2 class="subtitle">Content</h2>';
                        echo '<p id="text">' . $text . '</p>';
                        echo '<input name="text" type="hidden" value="' . $text . '">'
                        ?>

                        <div class="mail-options">
                            <a href="mail.php"><img src="assets/reset.png" alt="Reset"><p>Try again</p></a>
                            <button id="send" type="submit"><img src="assets/send.png" alt="Send"><p>Send</p></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>