<?php
session_start();

if (isset($_SESSION["kullanici"])) {
    header("Location: cikis.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Üye Kayıt</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(180deg, #ff6b6b, #d66bff, #2e2f5e);
            height: 100vh;
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
        }

        .giris {
            width: 450px;
            height: auto;
            padding: 20px;
            display: grid;
            grid-template-columns: 1fr;
            grid-template-rows: repeat(7, auto) 50px;
            grid-template-areas:
                "yazı"
                "eposta"
                "sifre"
                "sifretekrar"
                "ad"
                "soyad"
                "bolgeler"
                "button"
                "pe";
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .giris h1 {
            grid-area: yazı;
            text-align: center;
            color: #333;
        }

        .giris input,
        .giris select,
        .giris button {
            width: 90%;
            padding: 10px;
            margin: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        .giris button {
            background-color: #d4a34f;
            color: white;
            border: none;
            cursor: pointer;
        }

        .giris button:hover {
            background-color: #9b4310;
        }

        .giris p {
            grid-area: pe;
            text-align: center;
        }

        .giris p a {
            text-decoration: none;
            color: #d4a34f;
        }

        .giris p a:hover {
            color: #9b4310;
        }
    </style>
</head>

<body>
    <div class="giris">
        <h1 class="yazı">Kayıt Ol</h1>
        <form action="uyekaydikontrol.php" method="POST">
            <?php if (isset($_SESSION["hata"]["mesaj"])) : ?>
                <p style="color: red; text-align: center;"><?php echo htmlspecialchars($_SESSION["hata"]["mesaj"]); ?></p>
            <?php endif; ?>

            <input type="text" name="eposta" class="eposta" placeholder="E-posta adresiniz" required 
                value="<?php echo isset($_SESSION["form"]["eposta"]) ? htmlspecialchars($_SESSION["form"]["eposta"]) : ''; ?>">

            <input type="password" name="sifre" class="sifre" placeholder="Şifreniz" required>

            <input type="password" name="sifretekrar" class="sifretekrar" placeholder="Şifreniz Tekrar" required>

            <input type="text" name="ad" class="ad" placeholder="Adınız" required 
                value="<?php echo isset($_SESSION["form"]["ad"]) ? htmlspecialchars($_SESSION["form"]["ad"]) : ''; ?>">

            <input type="text" name="soyad" class="soyad" placeholder="Soyadınız" required 
                value="<?php echo isset($_SESSION["form"]["soyad"]) ? htmlspecialchars($_SESSION["form"]["soyad"]) : ''; ?>">

            <select name="bolgeler" id="bolgeler" class="bolgeler" required>
                <option value="">En Çok Seyehat Etmek İstediğiniz Bölge</option>
                <option value="İcanadolu" <?php echo isset($_SESSION["form"]["bolgeler"]) && $_SESSION["form"]["bolgeler"] === "İcanadolu" ? 'selected' : ''; ?>>İç Anadolu Bölgesi</option>
                <option value="Doguanadolu" <?php echo isset($_SESSION["form"]["bolgeler"]) && $_SESSION["form"]["bolgeler"] === "Doguanadolu" ? 'selected' : ''; ?>>Doğu Anadolu Bölgesi</option>
                <option value="Guneydoguanadolu" <?php echo isset($_SESSION["form"]["bolgeler"]) && $_SESSION["form"]["bolgeler"] === "Guneydoguanadolu" ? 'selected' : ''; ?>>Güney Doğu Anadolu Bölgesi</option>
                <option value="Karadeniz" <?php echo isset($_SESSION["form"]["bolgeler"]) && $_SESSION["form"]["bolgeler"] === "Karadeniz" ? 'selected' : ''; ?>>Karadeniz Bölgesi</option>
                <option value="Ege" <?php echo isset($_SESSION["form"]["bolgeler"]) && $_SESSION["form"]["bolgeler"] === "Ege" ? 'selected' : ''; ?>>Ege Bölgesi</option>
                <option value="Marmara" <?php echo isset($_SESSION["form"]["bolgeler"]) && $_SESSION["form"]["bolgeler"] === "Marmara" ? 'selected' : ''; ?>>Marmara Bölgesi</option>
                <option value="Akdeniz" <?php echo isset($_SESSION["form"]["bolgeler"]) && $_SESSION["form"]["bolgeler"] === "Akdeniz" ? 'selected' : ''; ?>>Akdeniz Bölgesi</option>
            </select>

            <button type="submit" class="buton">Kayıt Ol</button>
        </form>
        <p class="pe"> Zaten Hesabınız var mı? <a href="uyegiris.php">Giriş</a></p>
    </div>
</body>

</html>
