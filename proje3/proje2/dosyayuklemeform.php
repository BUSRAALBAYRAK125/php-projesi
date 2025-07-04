<?php
session_start();
// giriş yapmış mı 
if (isset($_SESSION["eposta"])) {
    echo "Merhaba ";
    echo $_SESSION["ad"];
    echo " ";
    echo $_SESSION["soyad"];
} else {
    header("Location:uyegiris.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form enctype="multipart/form-data" action="yukle.php?gordu=1" method="POST">
        <input type="text" name="konum" placeholder="resmin konumu"><br><br>
        <input type="text" name="açıklama" placeholder="açıklama"> <br><br>
        <input name="yuklenenDosya" type="file"><br><br>
        <input type="submit" value=Yükle>
    </form>
</body>
</html>