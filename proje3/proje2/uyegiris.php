
<?php
session_start(); // her sayfanın başında olacak<!DOCTYPE html>
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Üye Giriş Sayfası</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-image: url('istanbul.jpg');
            background-size: cover; /* Resmin boyutlarını sayfaya göre ayarlar */
            background-position: center; /* Resmin sayfanın ortasına yerleşmesini sağlar */
            background-attachment: fixed; /* Sayfa kaydırıldığında arka planın sabit kalmasını sağlar */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .giris {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 100%;
            max-width: 400px;
        }
        .giris h1 {
            font-size: 2rem;
            margin-bottom: 20px;
            color: #4e0404;
        }
        .giris input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
        }
        .giris button {
            width: 100%;
            padding: 10px;
            background: #d66a49db;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
          
        }
        .giris button:hover {
            background: #1e7956;
        }
        .giris p {
            font-size: 0.9rem;
            color: #666;
            margin-top: 15px;
        }  
        .giris a {
            color: #2575fc;
            text-decoration: none;
            font-weight: bold;
        }
        .giris a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="giris">
        <h1>Tekrar Hoşgeldiniz!</h1>
        <form action="uyegiriskontrol.php" method="POST">
            <input type="text" name="eposta" placeholder="E-posta adresiniz">
            <input type="password" name="sifre" placeholder="Şifreniz">
            <button type="submit">Giriş Yap</button>
        </form>
        <p>Hesabınız yok mu? <a href="uyekayit.php">Kayıt Ol</a></p>
    </div>
</body>
</html>