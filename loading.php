<?php
if (!empty($_POST["content"]) && !empty($_POST["reciever"]) && !empty($_POST["subject"]) && isset($_POST["enhance"])) {
    $content = $_POST["content"];
    $reciever = $_POST["reciever"];
    $subject = $_POST["subject"];
    $enhance = $_POST["enhance"];
} else {
    header("Location: mail.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Loading</title>
        <link rel="icon" href="assets/icon.png" type="image/icon type">
        <link rel="stylesheet" href="styles.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    </head>
    <body>
        <div class="white"></div>
        <div class="loader-container">
            <h1>Loading</h1>

            <div class="loader"></div>
        </div>

        <div class="hidden" style="display: none;">
            <?php
            echo '<h1 id="reciever">' . $reciever . '</h1>';
            echo '<h1 id="subject">' . $subject . '</h1>';
            echo '<h1 id="content">' . $content . '</h1>';
            echo '<h1 id="enhance">' . $enhance . '</h1>';
            ?>
        </div>

        <script src="js/loading.js"></script>
    </body>
</html>