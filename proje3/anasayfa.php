<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gezi Rehberi</title>
    <style>
        /* Genel Stil Ayarları */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(180deg, #ff6b6b, #d66bff, #2e2f5e);
            color: #333;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h1 {
            font-size: 24px;
            color: #fff;
        }

        p {
            font-size: 18px;
            line-height: 1.5;
            color: #fff;
        }

        ul {
            list-style: none;
            padding: 0;
            margin: 20px 0;
            display: flex;
            gap: 10px;
        }

        ul li {
            background: #2e2f5e;
            padding: 10px 20px;
            border-radius: 8px;
            text-align: center;
        }

        ul li a {
            text-decoration: none;
            color: #fff;
            font-weight: bold;
        }

        ul li a:hover {
            color: #ff6b6b;
        }

        .icerik {
            width: 90%;
            max-width: 800px;
            background: #fff;
            padding: 20px;
            margin-top: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .kart {
            background: #f9f9f9;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .kart img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin-top: 10px;
        }

        .kart h1 {
            font-size: 20px;
            margin: 10px 0;
            color: #333;
        }

        .kart p {
            color: #555;
            font-size: 16px;
        }

        .kart hr {
            border: none;
            height: 1px;
            background: #ddd;
            margin: 10px 0;
        }

        footer {
            margin-top: auto;
            padding: 10px;
            text-align: center;
            color: #fff;
            background: #2e2f5e;
            width: 100%;
        }
    </style>
</head>

<body>
    <header>
        <h1>Gezi Rehberimize Hoş Geldiniz!</h1>
    </header>
    <nav>
        <ul>
            <?php if (isset($_SESSION["kullanici"])) : ?>
                <li><a href="resimyuklemeform.php"> Resim Yükle</a></li>
                <li><a href="cikis.php">Çıkış Yap</a></li>
            <?php else : ?>
                <li><a href="uyekayit.php">Üye Kaydı</a></li>
                <li><a href="uyegiris.php">Üye Girişi</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <div class="icerik">
        <?php
        include 'veritabani/veritabani.php';

        $sql = "SELECT dosya.*, uye.ad as uyead, uye.soyad FROM dosya, uye WHERE dosya.yukleyen = uye.kod ORDER BY zaman DESC";
        $ifade = $vt->prepare($sql);
        $ifade->execute();

        while ($kayit = $ifade->fetch(PDO::FETCH_ASSOC)) : ?>
            <div class="kart">
                <h1><?php echo htmlentities($kayit["konum"]); ?></h1>
                <p>Kullanıcının Açıklaması: <?php echo htmlentities($kayit["aciklama"]); ?></p>
                <p>Yükleyen: <?php echo htmlentities($kayit["uyead"]) . " " . htmlentities($kayit["soyad"]); ?></p>
                <p>Yükleme Zamanı: <?php echo $kayit["zaman"]; ?></p>

                <?php
                $resimYolu = htmlentities($kayit["yol"]);

                if (file_exists($resimYolu)) {
                    echo "<img src='" . $resimYolu . "' alt='Resim' />";
                } else {
                    echo "<p>Resim dosyası bulunamadı!</p>";
                }
                ?>
                <hr>
            </div>
        <?php endwhile; ?>
    </div>

    
</body>

</html>
