<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resimler ve Yorumlar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .resim-container {
            margin-bottom: 30px;
        }

        .resim-container img {
            max-width: 150px;;
            height: auto;
            margin-bottom: 10px;
        }

        .yorumlar {
            margin-top: 10px;
            font-size: 14px;
        }

        .yorumlar p {
            margin: 5px 0;
        }

        .yorumlar input {
            margin-top: 10px;
            padding: 5px;
        }
    </style>
</head>
<body>
        
    <?php
    // Kullanıcı giriş kontrolü
       
    if (isset($_SESSION["eposta"])) {
        echo "<p>Hoşgeldin, " . $_SESSION["ad"] . " " . $_SESSION["soyad"] . "</p>";
        ?>
       <form action="cikis.php" method="post">
       <input type="submit" name="cikis" value="Çıkış Yap">
       </form>
       <ul>
       <li><a href="dosyayuklemeform.php">Resim Yükle</a></li>
       </ul>
        
    <?php
    } else {
    ?>
        <!-- Giriş yapmamış kullanıcılar için üye kaydı ve giriş linkleri -->
        <ul>
            <li><a href="uyekaydi.php">Üye Kaydı</a></li>
            <li><a href="uyegiris.php">Üye Girişi</a></li>
        </ul>
    <?php
    }
    ?>

    <?php
    // Veritabanı bağlantısı
    include 'veritabani/veritabani.php';

    // SQL sorgusu
    $sql = "SELECT resim_adi,tarih,id, uye.ad AS uyead, uye.soyad 
            FROM resim
            INNER JOIN uye ON resim.kod = uye.kod 
            ORDER BY resim.tarih DESC";

    $ifade = $vt->prepare($sql);
    $ifade->execute();

    // Verileri çekme ve görselleştirme
    while ($kayit = $ifade->fetch(PDO::FETCH_ASSOC)) {
        echo "<div class='resim-container'>";
        echo "<h2>" . htmlentities($kayit["resim_adi"]) . "</h2>";
        echo "<p> Yükleyen: " . htmlentities($kayit["uyead"]) . " " . htmlentities($kayit["soyad"]) . "</p>";
        // Yükleme tarihi
        echo "<p> Yükleme Tarihi: " . htmlentities($kayit["tarih"]) . "</p>";


        // Resmin yolunu oluşturuyoruz ve kontrol ediyoruz
        $resimYolu = '' . htmlentities($kayit["resim_adi"]);
        echo "<p> Resim Yolu: " . $resimYolu . "</p>";  // Debugging için ekledik


        // Resmin gerçekten yüklendiğini ve yolunun doğru olduğunu kontrol et
        if (file_exists($resimYolu)) {
            echo "<img src='" . $resimYolu . "' alt='Resim' />";
        } else {
            echo "<p> Resim dosyası bulunamadı!</p>";  // Eğer resim bulunamazsa uyarı veriyoruz
        }

        echo "</div>";
        if (isset($_SESSION["eposta"])){
            echo "<button>";
            echo" <a href='yorumyap.php'>Yorum Yap<a> ";
            echo "</button>";
        }
        if ($_SESSION["eposta"] == "admin" OR $_SESSION["kod"] == $kayit["kod"]) {

            echo "<a href='guncelle.php?kod=";
            echo $kayit["kod"];
            echo "'> Kaydı güncelle!</a>";
            ?>

        <?php
        } 
       
        echo "<hr>";
    }
    ?>

</body>

</html>
