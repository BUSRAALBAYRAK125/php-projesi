<?php
session_start();
if (isset($_GET["gordu"])) {

} else {
    header("Location: index.php");
    exit;
}

if (empty($_POST)) {
    echo "Yüklemeye çalıştığınız dosya çok büyük boyutta, lütfen en fazla 2MB yükleyiniz";
    echo "<a href='anasayfa.php'> Ana Sayfa </a>";
    exit;
} 

if ($_FILES["yuklenenDosya"]["error"] <> 0) {
    echo "Yüklemeye çalıştığınız dosya büyük boyutta, lütfen en fazla 2MB yükleyiniz";
    echo "<a href='index.php'> Ana Sayfa </a>";
    exit;  
}

if (!in_array($_FILES["yuklenenDosya"]["type"], ['image/jpeg', 'image/png', 'image/gif', 'image/bmp', 'image/webp'])) {
    echo "Sadece JPEG, PNG, GIF, BMP veya WEBP formatında resim dosyası yükleyebilirsiniz!";
    echo "<a href='index.php'> Ana Sayfa </a>";
    exit;
}

if (!file_exists('yuklenenler')) {
    mkdir('yuklenenler', 0777, false);
}

// Kullanıcının daha önce resim yükleyip yüklemediğini kontrol etmeden devam et
$hedefKlasor = "yuklenenler/".time(); 
$hedefKlasor = $hedefKlasor.basename($_FILES['yuklenenDosya']['name']); 

if (move_uploaded_file($_FILES["yuklenenDosya"]['tmp_name'], $hedefKlasor)) { 
    echo basename($_FILES['yuklenenDosya']['name'])." ismindeki dosya başarı ile yüklendi."; 
} else { 
    echo "Bir hata oluştu!"; 
}

include 'veritabani/veritabani.php';
$sql = "INSERT INTO dosya (yol, aciklama, konum, yukleyen) VALUES (:yol, :aciklama, :konum, :yukleyen)";
$ifade = $vt->prepare($sql);
$ifade->execute(
    Array(
        ":yol"=>$hedefKlasor, 
        ":aciklama"=>$_POST["aciklama"], 
        ":konum"=>$_POST["konum"], 
        ":yukleyen"=>$_SESSION["kod"]
    )
);
$vt = null;

header("Location: anasayfa.php");
?>

