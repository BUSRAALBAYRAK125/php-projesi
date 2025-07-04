<?php
session_start();

// Kullanıcı oturumunun kontrol edilmesi
if (!isset($_SESSION["eposta"])) {
    // Eğer oturum açılmamışsa ana sayfaya yönlendir
    header("Location:anasayfa.php");
    exit;
}
// Eğer POST verisi boşsa dosya boyutunun fazla olduğu anlamına gelir
if (empty($_POST)) {
    echo "Yüklemeye çalıştığınız dosya çok büyük boyutta, lütfen en fazla 2MB yükleyiniz";
    echo "<a href='anasayfa.php'> Ana Sayfa </a>";
    exit;
}

// Dosya hatalarının kontrolü
if ($_FILES["yuklenenDosya"]["error"] != 0) {
    echo "Yüklemeye çalıştığınız dosya büyük boyutta, lütfen en fazla 2MB yükleyiniz";
    echo "<a href='anasayfa.php'> Ana Sayfa </a>";
    exit;
}

// Yalnızca belirli dosya türlerinin yüklenmesine izin verilmesi (JPEG, PNG, GIF)
if ($_FILES["yuklenenDosya"]["type"] != 'image/jpeg' && 
    $_FILES["yuklenenDosya"]["type"] != 'image/png' && 
    $_FILES["yuklenenDosya"]["type"] != 'image/gif') {
    echo "Sadece resim dosyası (JPEG, PNG, GIF) yükleyiniz!";
    echo "<a href='anasayfa.php'> Ana Sayfa </a>";
    exit;
}

// Yüklenen dosyaların saklanacağı klasörün var olup olmadığının kontrolü, yoksa oluşturulması
if (!file_exists('yuklenenler')) {
    mkdir('yuklenenler', 0777, true); // true parametresi alt klasörlerin oluşturulmasını sağlar
}

// Dosya ismi çakışmasını önlemek için zaman damgası eklenmesi
$hedefKlasor = "yuklenenler/" . time() . basename($_FILES['yuklenenDosya']['name']); 

// Dosyanın sunucuya kaydedilmesi
if (move_uploaded_file($_FILES["yuklenenDosya"]['tmp_name'], $hedefKlasor)) { 
    echo basename($_FILES['yuklenenDosya']['name']) . " ismindeki dosya başarıyla yüklendi.";
} else { 
    echo "Bir hata oluştu!";
    exit;
}

// Veritabanı bağlantısı
include 'veritabani/veritabani.php'; // Veritabanı bağlantısı sağlanıyor

// Veritabanına resim bilgilerini eklemek için SQL sorgusunun hazırlanması
$sql = "INSERT INTO resim (kod, resim_adi, tarih) VALUES (:kod, :resim_adi, NOW())";
$ifade = $vt->prepare($sql);

// Veritabanına veri eklemek için execute metodunu kullanıyoruz
$ifade->execute(Array(
    ":kod" => $_SESSION["kod"], // Oturumdaki e-posta bilgisi
    ":resim_adi" => $hedefKlasor,     // Yüklenen resmin yolu
));

// Bağlantıyı kapatma
$vt = null;

// Yükleme işlemi tamamlandığında ana sayfaya yönlendirme
header("Location:anasayfa.php");
exit;
?>
