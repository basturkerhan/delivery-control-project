<?php 
    session_start();
    if( isset($_SESSION['id']) && isset($_SESSION['user_name']) ) {
        header('Location: home.php');
        exit();
    }
?>

<html>

<head>
    <title>Giriş Yap | Delivery Control</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>

<body>
    <div class="login-page">

        <div class="go-index-page-button"><a href="index.php">Delivery-Control</a></div>

        <form action="app/login-check.php" method="post">
            <?php
            if (isset($_GET['mess'])) { ?>
                <div class="alert alert-danger">
                    <?php echo $_GET['mess'] ?>
                </div>
            <?php } else if (isset($_GET['succ'])) { ?>
                <div class="alert alert-success">
                    <?php echo $_GET['succ'] ?>
                </div>
            <?php } ?>
            <div class="form-group">
                <label>Kullanıcı Adı</label>
                <input type="text" class="form-control" name="uname" placeholder="kullanıcı adı">
            </div>
            <br />
            <div class="form-group">
                <label>Şifre</label>
                <input type="password" class="form-control" name="password" placeholder="şifre">
            </div>
            <br />
            <div class="auth-button-area">
                <a href="register.php" class="ca">Hesap oluştur</a>
                <button type="submit" class="btn btn-primary w-50">Giriş Yap</button>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>