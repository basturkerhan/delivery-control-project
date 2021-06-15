<?php
session_start();
require('./db/db_conn.php');
if (isset($_SESSION['id']) && isset($_GET['id'])) {
    $userId = $_SESSION['id'];
    $deliveryId = $_GET['id'];
    $isHasCategory = false;

    $allCategories = $conn->query("SELECT ID, category_name FROM categories WHERE user_ID='$userId'");

    $res = $conn->query("
        SELECT * FROM category_delivery WHERE delivery_ID='$deliveryId'
    ");

    if ($res->rowCount() === 0) {
        $infos = $conn->query("
            SELECT ID, delivery_title, delivery_subtitle, delivery_datetime, delivery_checked FROM deliveries WHERE deliveries.ID='$deliveryId' AND deliveries.user_ID='$userId'
        ");
    } else {
        $infos = $conn->query("
        SELECT deliveries.ID, c.category_name, c.ID as category_ID, delivery_title, delivery_subtitle, delivery_datetime, delivery_checked
        FROM ((deliveries
            INNER JOIN category_delivery cd on cd.delivery_ID=deliveries.ID)
            INNER JOIN categories c on cd.category_ID=c.ID)
        WHERE deliveries.ID='$deliveryId' AND deliveries.user_ID='$userId'
    ");
    }




?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Güncelle | Delivery-Control</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link href="./docs/bootstrap.min.css" rel="stylesheet">
    </head>

    <body>
        <div class="update-delivery">
            <div>
                <?php include('./components/app-header.php') ?>
            </div>
            <div class="mt-2 container update-delivery-form-area">

                <?php
                $yourCategories = array();
                $yourCategoryNames = array();
                if ($infos->rowCount() > 0) {
                    foreach ($infos as $info) {
                        $details = $info;
                        if (isset($info['category_ID'])) {
                            array_push($yourCategories, $info['category_ID']);
                            array_push($yourCategoryNames, $info['category_name']);
                        }
                    }
                }
                ?>

                <form action="app/update-delivery.php" method="POST">
                    <input name="delivery_id" class="hide" value="<?php echo $info['ID'] ?>" readonly/>

                    <div class="remove-deliveries-categories">
                        <label>Teslimat kartından kaldırmak istediğiniz kategorinin üzerine tıklayınız</label>
                        <div class="category-list">
                            <?php
                            $i = 0;
                            foreach ($yourCategoryNames as $cName) {
                            ?>
                                <h5><span id="<?php echo $yourCategories[$i] ?>" class="category badge bg-danger"><?php echo $cName ?></span></h5>
                            <?php
                                $i++;
                            }
                            ?>
                        </div>

                    </div>

                    <br />

                    <div class="form-group">
                        <label>Güncellenecek Teslimat Bilgisi Başlığı</label>
                        <input type="text" name="new_title" class="form-control" value="<?php echo $details['delivery_title'] ?>">
                    </div>

                    <br />

                    <div class="form-group">
                        <label>Güncellenecek Teslimat Bilgisi Alt Başlığı (Opsiyonel)</label>
                        <input type="text" name="new_subtitle" class="form-control" value="<?php echo $details['delivery_subtitle'] ?>">
                    </div>

                    <br />

                    <div class="form-group">
                        <label>Teslimat Bilgisi Kartı Kategorisi <small>(birden fazla kategoriye sahip olabilir, kategorileri tek tek ekleyin, listede kategori göremiyorsanız önce kategori oluşturun)</small> </label>
                        <select class="form-control" name="category_name">
                            <option>Yeni Kategori Ekleme</option>
                            <?php
                            if ($allCategories->rowCount() > 0) {
                                foreach ($allCategories as $category) {
                            ?>
                                    <option <?php echo in_array($category['ID'], $yourCategories) ? "disabled" : ""; ?> id="<?php echo $category['ID'] ?>"><?php echo $category['category_name'] ?></option>
                            <?php }
                            }
                            ?>
                        </select>
                    </div>
                    <br />

                    <button type="submit" class="btn btn-primary w-100">Teslimat Bilgisi Kartını Güncelle</button>
                </form>
            </div>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/a0a0a22776.js" crossorigin="anonymous"></script>
        <script src="js/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                $(".category").click(function() {
                    const categoryID = $(this).attr('id');
                    const deliveryID = $('.hide').attr('value');
                    $.post('app/remove-deliveries-category.php', {
                        categoryID,
                        deliveryID
                    }, (data) => {
                        if(data) {
                            location.reload();
                        }
                    });
                })
            })
        </script>
    </body>

    </html>
<?php } else {
    header("Location: login.php");
}
?>