<?php
if (isset($_SESSION['id']) && isset($_SESSION['user_name']) && isset($_SESSION['name'])) {
    require('./db/db_conn.php');
    $name = $_SESSION['name'];
    $id = $_SESSION['id'];
    $categories = $conn->query("SELECT * from categories WHERE user_ID='$id'");
?>

    <nav class="app-navbar navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="home.php">Delivery Control</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span><i class="fas fa-bars"></i></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Kategorilerim
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php
                            foreach ($categories as $category) { ?>
                                <li><a class="dropdown-item" href="<?php echo "home.php?category=" . $category['category_name'] ?>"><?php echo $category['category_name'] ?></a></li>
                            <?php } ?>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="home.php?complete=1">
                            Tamamlanmış Teslimatlar
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="home.php?complete=0">
                            Tamamlanmamış Teslimatlar
                        </a>
                    </li>
                </ul>

                <div class="nav-right">
                            <a class="nav-link" href="logout.php"><?php echo $name ?><i class="fas fa-sign-out-alt exit-button"></i></a>
                    </div>

            </div>
        </div>
    </nav>

<?php
}
?>