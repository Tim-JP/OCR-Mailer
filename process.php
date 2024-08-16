<?php
if (isset($_POST["content"])) {
    $imgData = $_POST["content"];
    
    $imgData = str_replace("data:image/png;base64,", "", $imgData);
    $imgData = str_replace(" ", "+", $imgData);

    $imgDecoded = base64_decode($imgData);

    $filePath = "temp/image.png";
    file_put_contents($filePath, $imgDecoded);

    include "config.php";

    $ocrKey = $apiKeys["ocr"];
    $ocrUrl = "https://api.ocr.space/parse/image";

    $data = array(
        "apikey" => $ocrKey,
        "language" => "eng",
        "base64Image" => "data:image/png;base64," . base64_encode($imgDecoded),
        "OCREngine" => 2,
        "scale" => "true"
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $ocrUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    $response = curl_exec($ch);
    curl_close($ch);

    $result = json_decode($response, true);
    $ocrText = $result["ParsedResults"][0]["ParsedText"];

    $reciever = $_POST["reciever"];
    $subject = $_POST["subject"];

    if (file_exists($filePath)) {
        unlink($filePath);
    }

    session_start();

    if ($ocrText === "") {
        $_SESSION["notext"] = true;
    } else {
        $enhance = $_POST["enhance"];
        if ($enhance !== "0") {
            $text = $ocrText;

            $data = [
                "text" => $text,
                "language" => "en-US",
            ];

            $ch = curl_init("https://api.languagetool.org/v2/check");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
            $response = curl_exec($ch);
            curl_close($ch);

            $result = json_decode($response, true);

            $correctedText = $text;
            if (isset($result["matches"])) {
                foreach (array_reverse($result["matches"]) as $match) {
                    $replacement = $match["replacements"][0]["value"] ?? "";
                    $offset = $match["offset"];
                    $length = $match["length"];
                    $correctedText = substr_replace($correctedText, $replacement, $offset, $length);
                }
            }

            $ocrText = $correctedText;
        }
    }

    $_SESSION["reciever"] = $reciever;
    $_SESSION["subject"] = $subject;
    $_SESSION["text"] = $ocrText;
} else {
    header("Location: mail.php");
    exit();
}
?>