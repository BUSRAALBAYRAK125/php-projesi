<?php
session_start();
if (isset($_POST["cikis"])){
    // Eğer oturum yoksa, kullanıcıyı giriş sayfasına yönlendir
    session_unset();
    session_destroy();
    header("Location:uyegiris.php ");
    exit();
}
?>