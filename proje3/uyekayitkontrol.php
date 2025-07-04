<?php
session_start();
//Kontroller
// direkt gelenleri engellemek lazım
// boş bırakılamasın
// hep boşluk tıklarlarsa
// Kullanıcı adı ve eposta daha önce kullanılmış mı?

$_SESSION["form"]["ad"] = $_POST["ad"];
$_SESSION["form"]["soyad"] = $_POST["soyad"];
$_SESSION["form"]["eposta"] = $_POST["eposta"];
$_SESSION["form"]["kullanici"] = $_POST["kullanici"];
include 'veritabani/veritabani.php';

$sql ="select * from uye WHERE kullanici = :kullanici";
$ifade = $vt->prepare($sql);
$ifade->execute([":kullanici"=> $_POST["kullanici"] ]);
$kayit = $ifade->fetch(PDO::FETCH_ASSOC);
if ($kayit == false) {
  // kayda devam et
} else {
  $_SESSION["hata"]["mesaj"] = "Bu kullanıcı adı daha önce alınmış!";
  header('Location: uyekayitform.php');
  exit;
}
if (!isset($_POST["eposta"])) {
    echo "Lütfen epostayı giriniz!";
    exit;
  }
  $eposta = $_POST["eposta"];
  $eposta = trim($eposta);
  $eposta1=htmlentities($eposta);
  $guvenlieposta=htmlspecialchars($eposta1);
  if (filter_var($guvenlieposta, FILTER_VALIDATE_EMAIL)) {
    
  }
  else{
    echo "Lütfen geçerli bir eposta giriniz!";
  }
  $ad=htmlentities($_POST["ad"]);
  $guvenliad=htmlspecialchars($ad);
  $soyad=htmlentities($_POST["soyad"]);
  $guvenlisoyad=htmlspecialchars($soyad);
  $guvenlikullanici=htmlentities($_POST["kullanici"]);
  //Şifreler uyumlu mu
  $sifre = $_POST["sifre"];
  $sifre2 = $_POST["sifre2"];

  if ($sifre != $sifre2) {
    echo "Şifreler uyuşmuyor!";
    header('Location: uyekayit.php');
    exit;
   }
   $hash = password_hash($sifre, PASSWORD_DEFAULT);
   $sql = "insert into uye (ad, soyad, eposta, kullanici, sifre) values (:ad, :soyad, :eposta, :kullanici, :sifre)";
$ifade = $vt->prepare($sql);
$ifade->execute(Array(":ad"=>$_POST["ad"], ":soyad"=>$_POST["soyad"], ":eposta"=>$_POST["eposta"],":kullanici"=>$_POST["kullanici"], ":sifre"=>$hash));
//Bağlantıyı yok edelim...
$vt = null;

header('Location:uyegiris.php');

?>