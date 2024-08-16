<?php
session_start();

if (isset($_SESSION["notext"]) && $_SESSION["notext"] === true) {
    $writeable_waring = true;

    $reciever = $_SESSION["reciever"];
    $subject = $_SESSION["subject"];
} else {
    $writeable_waring = false;
}

session_destroy();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Mail</title>
        <link rel="icon" href="assets/icon.png" type="image/icon type">
        <link rel="stylesheet" href="styles.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    </head>
    <body>
        <div class="stars"></div>

        <div class="container-2">
            <div class="mail" style="height: 80vh;">
                <form action="loading.php" method="post" id="mailForm">
                    <h2 class="parameter">To</h2>
                    <input type="text" name="reciever" id="reciever" value="<?php if (isset($reciever)) { echo $reciever; }?>">

                    <h2 class="parameter">Subject</h2>
                    <input type="text" name="subject" id="subject" value="<?php if (isset($subject)) { echo $subject; }?>">

                    <h2 class="parameter">Content</h2>
                    <?php
                    if ($writeable_waring) {
                        echo '<div id="warning" class="writeable"></div>';
                    } else {
                        echo '<div class="writeable"></div>';
                    }
                    ?>
                    <input type="hidden" name="content" id="content">

                    <div class="options">
                        <button type="button" onclick="removeDots()"><img src="assets/trash.png" alt="Trash"><p>Clear</p></button>
                        <button type="button" onclick="addSpace()"><img src="assets/plus.png" alt="Plus"><p>More space</p></button>

                        <div class="switch-container">
                            <p>AI Enhance</p>
                            <label class="switch">
                                <input type="hidden" id="enhance" name="enhance" value="1">
                                <input type="checkbox" id="switch" onchange="changeSwitch()" checked>
                                <span class="slider"></span>
                            </label>
                        </div>

                        <button class="process" type="button" onclick="sendForm()"><img src="assets/process.png" alt="Process"><p>Process</p></button>
                    </div>
                </form>
                
            </div>
        </div>

        <script src="js/script.js"></script>
    </body>
</html>