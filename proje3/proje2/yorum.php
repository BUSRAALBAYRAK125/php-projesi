<?php
 session_start();
 echo $_SESSION["kod"];
 $yorum=$_POST["yorum"];
 $kullanici=$_SESSION["kod"];
 if ($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'veritabani/veritabani.php';
    $sql = "INSERT INTO yorum (yazan,metin) VALUES (:yazan, :metin)";
    $ifade = $vt->prepare($sql);
    // Parametreleri veritabanına ekleyin
     $ifade->execute([
        ':yazan' => $kullanici,
        ':metin' => $yorum,
        
      ]);

 }
 else{
    header("Location:anasayfa.php ");
    exit();
 }






?>