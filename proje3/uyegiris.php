<!DOCTYPE html>
<html lang="tr">

<head>
    <title>İstanbul'da Gezi</title>
    <meta charset="UTF-8">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: url('istanbul.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #333;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .form-kapsayici {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
            width: 400px;
            text-align: center;
        }

        .form-kapsayici h1 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        .form-kapsayici label {
            display: block;
            text-align: left;
            margin: 10px 0 5px 0;
            font-size: 16px;
        }

        .form-kapsayici input[type="text"],
        .form-kapsayici input[type="password"],
        .form-kapsayici input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .form-kapsayici input[type="submit"] {
            background-color: rgb(167, 73, 29);
            color: white;
            border: none;
            cursor: pointer;
            font-weight: bold;
        }

        .form-kapsayici input[type="submit"]:hover {
            background-color: rgb(177, 63, 63);
        }

        .form-kapsayici input::placeholder {
            color: #999;
        }

        .form-kapsayici .kaydol-link {
            margin-top: 10px;
            font-size: 14px;
            color: rgb(167, 73, 29);
            text-decoration: none;
            display: inline-block;
        }

        .form-kapsayici .kaydol-link:hover {
            color: rgb(177, 63, 63);
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="form-kapsayici">
        <h1>Giriş Sayfası</h1>
        <form action="uyegiriskontrol.php" method="post">
            <label for="kullanici">Kullanıcı Adı:</label>
            <input type="text" name="kullanici" id="kullanici" placeholder="Kullanıcı adınızı giriniz" required>
            <label for="sifre">Şifreniz:</label>
            <input type="password" name="sifre" id="sifre" placeholder="Şifrenizi giriniz" required>
            <input type="submit" value="Giriş">
        </form>
        <a href="uyekayit.php" class="kaydol-link">Hesabınız yok mu? Kayıt ol</a>
    </div>
</body>

</html>
