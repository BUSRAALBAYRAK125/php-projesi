<?php
session_start(); // her sayfanın başında olacak

// Form öğelerini al
$eposta = $_POST["eposta"];
$sifre = $_POST["sifre"];


// Veri tabanına bağlan
include 'veritabani/veritabani.php';

  // kullanıcı adı var mı kontrol et
$sql ="select * from uye WHERE eposta = :eposta";
$ifade = $vt->prepare($sql);
$ifade->execute([":eposta" => $eposta]);

$kayit = $ifade->fetch(PDO::FETCH_ASSOC);

var_dump($kayit);

if ($kayit == false) {
    echo "Kullanıcı adı veya şifre hatalı!";
    exit;
}
// şifreler aynı mı kontrol et

if (!password_verify($sifre, $kayit["sifre"])) {
    echo "Kullanıcı adı veya şifre hatalı!";
    exit;
    }
    echo "buraya gelen şifreyi ve kullanıcı adını doğru girmiştir!";
    
// Giriş doğruysa 
    // Oturum aç
    // yönlendir

// Giriş bilgileri doğru değilse forma yönlendir
 // Session değişkenlerini ayarla
 $_SESSION["kod"] = $kayit["kod"]; 
 $_SESSION["eposta"] = $kayit["eposta"];  // E-posta bilgisi
 $_SESSION["ad"] = $kayit["ad"];          // Ad bilgisi
 $_SESSION["soyad"] = $kayit["soyad"];    // Soyad bilgisi
 $_SESSION["sehir"] = $kayit["sehir"];    // Şehir bilgisi



$vt = null;
header("Location:anasayfa.php");
?>

<a href="anasayfa.php">Ana Sayfa</a>
