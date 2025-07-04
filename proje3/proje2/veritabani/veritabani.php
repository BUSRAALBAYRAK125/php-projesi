 <?php       
  try{
    // Veritabanına bağlanma
    $vt = new PDO('mysql:host=localhost;dbname=proje2;charset=utf8', 'root', '');
    $vt->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>