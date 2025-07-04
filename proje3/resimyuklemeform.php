<?php
session_start();
// giriş yapmış mı 
if (isset($_SESSION["kullanici"])) {
    echo "<div class='hosgeldin'>";
    echo "Merhaba ";
    $temizad=htmlentities($_SESSION["ad"]);
    echo $temizad." ";
    $temizsoyad=htmlentities($_SESSION["soyad"]);
    echo $temizsoyad;
    echo "</div>";
} else {
    header("Location: uyegiris.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dosya Yükleme</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(180deg, #ff6b6b, #d66bff, #2e2f5e);
            color: #333;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hosgeldin {
            position: absolute;
            top: 10px;
            left: 10px;
            font-size: 18px;
            font-weight: bold;
            color: white;
        }

        .form-kapsayici {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            width: 400px;
            text-align: center;
        }

        .form-kapsayici h1 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        .form-kapsayici input[type="text"],
        .form-kapsayici input[type="file"],
        .form-kapsayici input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .form-kapsayici input[type="submit"] {
            background-color: #d4a34f;
            color: white;
            border: none;
            cursor: pointer;
            font-weight: bold;
        }

        .form-kapsayici input[type="submit"]:hover {
            background-color: #9b4310;
        }

        .form-kapsayici input::placeholder {
            color: #999;
        }
    </style>
</head>

<body>
    <div class="form-kapsayici">
        <h1>Dosya Yükleme</h1>
        <form enctype="multipart/form-data" action="yukle.php?gordu=1" method="POST">
            <input type="text" name="aciklama" placeholder="Açıklama"><br>
            <input type="text" name="konum" placeholder="Konumu"><br>
            <input name="yuklenenDosya" type="file"><br>
            <input type="submit" value="Yükle">
        </form>
    </div>
</body>

</html>
