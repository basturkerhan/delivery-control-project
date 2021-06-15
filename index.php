<?php 
    session_start();
    if( isset($_SESSION['id']) && isset($_SESSION['user_name']) ) {
        header('Location: home.php');
        exit();
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Control</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

</head>

<body>
    <div class="landing">
        <?php include('./components/header.php') ?>
        <div class="landing-content">
            <div class="header-box">
                <h1>MySQL(PDO) ve PHP Destekli Sipariş Kontrol Sistemi</h1>
            </div>
            <hr />
            <div class="detail-box w-75">
                <p>
Hala bazı esnaf ve marketler, veritabanları olmadığı için teslimat yapacakları yerlerin adreslerini ve içeriğini kağıtlara yazarak tutmakta, kağıt israfının yanı sıra bu kağıtlar kaybolduğu takdirde teslimatta sıkıntılar çıkabilmektedir. Bilgisayar diskindeki kayıtlara ise dağıtım anında erişilemektedir. Tüm bu sorunlara yeni bir çözüm getirmek için; kayıt ol/giriş yap, ücretsiz kullan...
                </p>
                
            </div>

            <div class="row w-75">
                <div class="col-lg-6">
                    <ul class="attr-list">
                        <li><strong>Üyelik Sistemi</strong></li>
                        <li><strong>PHP&PDO Bağlantısı</strong></li>
                        <li><strong>Tamamen Cihaz Uyumlu (Responsive) Tasarım</strong></li>
                        <li><strong>Teslimat Kartları için Kategori Sistemi</strong> <small>( bir teslimat kartı birden fazla kategoriye sahip olabilir)</small></li>
                        <li><strong>ve çok daha fazlası...</strong></li>
                    </ul>
                </div>
                <div class="col-lg-6">
                    <center><img src="./assets/responsive.png" class="img-fluid w-75" alt="responsive" />
                </center></div>
            </div>
            
        </div>
    </div>

    <script src="https://kit.fontawesome.com/a0a0a22776.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>