<?php
session_start();
if (isset($_SESSION["kullanici"])) {
    header("Location: cikis.php");
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Üye Kaydı</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: url('istanbul.jpg') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #333;
        }

        .form-container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
            width: 400px;
            text-align: center;
            box-sizing: border-box;
        }

        h1 {
            margin-bottom: 20px;
            color: #333;
            font-size: 24px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #FF7043; /* Turuncu Renk */
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #FF5722; /* Hover için daha koyu turuncu */
        }

        .login-link {
            margin-top: 15px;
            font-size: 14px;
            color: #333;
        }

        .login-link a {
            color: #FF7043; /* Turuncu renk */
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Üye Kaydı</h1>
        <form action="uyekayitkontrol.php" method="POST">
            <input type="text" name="ad" placeholder="Adınız" value="<?php echo isset($_SESSION["form"]["ad"]) ? $_SESSION["form"]["ad"] : ''; ?>" required>
            <input type="text" name="soyad" placeholder="Soyadınız" value="<?php echo isset($_SESSION["form"]["soyad"]) ? $_SESSION["form"]["soyad"] : ''; ?>" required>
            <input type="text" name="eposta" placeholder="E-posta adresiniz" value="<?php echo isset($_SESSION["form"]["eposta"]) ? $_SESSION["form"]["eposta"] : ''; ?>" required>
            <input type="text" name="kullanici" placeholder="Kullanıcı adı" value="<?php echo isset($_SESSION["form"]["kullanici"]) ? $_SESSION["form"]["kullanici"] : ''; ?>" required>
            <input type="password" name="sifre" placeholder="Şifreniz" required>
            <input type="password" name="sifre2" placeholder="Şifreniz Tekrar" required>
            <input type="submit" value="Kayıt Ol">
        </form>

        <p class="login-link">Zaten hesabınız var mı? <a href="uyegiris.php">Giriş Yap</a></p>
    </div>
</body>
</html>
