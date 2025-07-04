<?php
session_start(); // her sayfanın başında olacak

// Form öğelerini al

$kullanici = $_POST["kullanici"];
$sifre = $_POST["sifre"];

// Veri tabanına bağlan
include 'veritabani/veritabani.php';

  // kullanıcı adı var mı kontrol et
$sql ="select * from uye WHERE kullanici = :kullanici";
$ifade = $vt->prepare($sql);
$ifade->execute([":kullanici" => $kullanici]);

$kayit = $ifade->fetch(PDO::FETCH_ASSOC);

if ($kayit == false) {
    echo "Kullanıcı adı veya şifre hatalı!";
    exit;
}

if (!password_verify($sifre, $kayit["sifre"])) {
    echo "Kullanıcı adı veya şifre hatalı!";
    exit;
    }

    echo "buraya gelen şifreyi ve kullanıcı adını doğru girmiştir!";

    echo "<br>";

    $_SESSION["kullanici"] = $kayit["kullanici"];
    $_SESSION["kod"] = $kayit["kod"];
    $_SESSION["ad"] = $kayit["ad"];
    $_SESSION["soyad"] = $kayit["soyad"];
     echo htmlentities($_SESSION["ad"]);
    echo htmlentities($_SESSION["soyad"]);
    var_dump($_SESSION);
  



$vt = null;

header("Location: anasayfa.php");
?>

<a href="anasayfa.php">Ana Sayfa</a>
