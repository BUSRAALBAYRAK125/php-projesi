<?php
session_start();

// E-posta, ad, soyad ve şehir bilgilerini oturum değişkenine atama
if (isset($_POST["eposta"])) {
    $_SESSION["eposta"] = $_POST["eposta"];
}
if (isset($_POST["ad"])) {
    $_SESSION["ad"] = $_POST["ad"];
}
if (isset($_POST["soyad"])) {
    $_SESSION["soyad"] = $_POST["soyad"];
}
if (isset($_POST["bolgeler"])) {
    $_SESSION["sehir"] = $_POST["bolgeler"];
}

// E-posta kontrolü
if (!isset($_POST["eposta"]) || empty(trim($_POST["eposta"]))) {
    $_SESSION["hata"]["mesaj"] = "E-posta boş bırakılamaz!";
    header("Location: uyekayit.php");
    exit;
}

if (!filter_var($eposta, FILTER_VALIDATE_EMAIL)) {
    $_SESSION["hata"]["mesaj"] = "E-posta düzgün bir formatta girilmelidir!";
    header("Location: uyekayit.php");
    exit;
}

// Ad kontrolü
$ad = trim($_POST["ad"] ?? '');
if (strlen($ad) < 3) {
    $_SESSION["hata"]["mesaj"] = "Adınız en az üç karakterden oluşmalıdır!";
    header("Location: uyekayit.php");
    exit;
}

// Soyad kontrolü
$soyad = trim($_POST["soyad"] ?? '');
if (strlen($temizsoyad) < 5) {
    $_SESSION["hata"]["mesaj"] = "Soyadınız en az beş karakterden oluşmalıdır!";
    header("Location: uyekayit.php");
    exit;
}

// Şifre kontrolü
if (!isset($_POST["sifre"]) || empty($_POST["sifre"]) || !isset($_POST["sifretekrar"]) || empty($_POST["sifretekrar"])) {
    $_SESSION["hata"]["mesaj"] = "Şifre ve şifre tekrarı boş bırakılamaz!";
    header("Location: uyekayit.php");
    exit;
}
if ($_POST["sifre"] !== $_POST["sifretekrar"]) {
    $_SESSION["hata"]["mesaj"] = "Şifreler aynı olmalıdır!";
    header("Location: uyekayit.php");
    exit;
}
$sifre = password_hash($_POST["sifre"], PASSWORD_DEFAULT);

// Bölge seçimi kontrolü
if (!isset($_POST["bolgeler"]) || empty($_POST["bolgeler"])) {
    $_SESSION["hata"]["mesaj"] = "Lütfen bir bölge seçiniz!";
    header("Location: uyekayit.php");
    exit;
}

include 'veritabani/veritabani.php';

try {
    // Kullanıcı zaten var mı kontrolü
    $sql = "SELECT * FROM uye WHERE eposta = :eposta";
    $ifade = $vt->prepare($sql);
    $ifade->execute([":eposta" => $eposta]);
    $kayit = $ifade->fetch(PDO::FETCH_ASSOC);

    if ($kayit) {
        $_SESSION["hata"]["mesaj"] = "Bu e-posta adresi daha önce kullanılmış!";
        header("Location: uyekayit.php");
        exit;
    }

    // Yeni kullanıcı ekleme
    $sql = "INSERT INTO uye (eposta, ad, soyad, sifre, sehir) VALUES (:eposta, :ad, :soyad, :sifre, :sehir)";
    $ifade = $vt->prepare($sql);
    $ifade->execute([
        ":eposta" => $eposta,
        ":ad" => $ad,
        ":soyad" => $soyad,
        ":sifre" => $sifre,
        ":sehir" => $_POST["bolgeler"]
    ]);

    // Veritabanı bağlantısını kapatma
    $vt = null;

    // Başarılı kayıt mesajı
    $_SESSION["basari"] = "Üye kaydı başarıyla gerçekleştirildi!";
    header("Location: uyegiris.php");
    exit;
} catch (PDOException $e) {
    $_SESSION["hata"]["mesaj"] = "Bir hata oluştu: " . $e->getMessage();
    header("Location: uyekayit.php");
    exit;
}
?>
