<?php

if (isset($_SESSION['id'])) {
    $userId = $_SESSION['id'];
    if (isset($_GET['category'])) {
        $cName = $_GET['category'];
        $mess  = "Şu kategoriye ait teslimat bilgisi kartları gösteriliyor: <strong>$cName</strong>";
        $deliveries = $conn->query(
            "SELECT d.ID, delivery_title, delivery_subtitle, delivery_datetime, delivery_checked, category_name, d.user_ID 
            FROM ((category_delivery cd
            INNER JOIN categories c on cd.category_ID=c.ID)
            INNER JOIN deliveries d on cd.delivery_ID=d.ID) 
            WHERE c.category_name='$cName' AND d.user_ID='$userId' 
            ORDER BY d.ID DESC"
        );
    } else if (isset($_GET['complete'])) {
        $complete = $_GET['complete'];
        $mess = $complete == 1 ? "tamamlanmış teslimat kartları listeleniyor" : "tamamlanmamış teslimat kartları listeleniyor";
        if ($complete == '0' || $complete == '1') {
            $deliveries = $conn->query("SELECT * FROM deliveries WHERE user_ID=$userId AND delivery_checked='$complete' ORDER BY ID DESC");
        } else {
            header("Location: home.php");
            exit();
        }
    } else {
        $mess = "Tüm teslimat bilgisi kartları listeleniyor";
        $deliveries = $conn->query("SELECT * FROM deliveries WHERE user_ID=$userId ORDER BY ID DESC");
    }


    if ($deliveries->rowCount() === 0) {
?>

        <div class="alert alert-info" role="info">
            <h4 class="alert-heading">Teslimat Bilgisi Kartı Bulunamadı</h4>
            <p>Herhangi bir teslimat bilgisi kartı bulamadık. Eğer belirli bir kategoriye ait kartları listelemeyi denediyseniz, o kategoride teslimat kartı bulunmuyor olabilir. Bir kartı sağ üstündeki kalem ikonuna tıklayıp güncellerek ona kolayca kategori(ler) ekleyebilirsiniz.</p>
            <hr>
            <p class="mb-0">Eğer henüz hiçbir kartınız yoksa, sayfanın sağ altındaki "+" butonuna tıklayarak kolayca teslimat bilgisi kartı ekleyebilir, üstündeki buton aracılığıyla da yeni bir kategori açabilirsiniz.</p>
        </div>

    <?php
    } else { ?>
        <div class="alert alert-primary" role="alert">
            <?php echo $mess ?>
        </div>
        <?php
        foreach ($deliveries as $delivery) {
            if ($delivery['delivery_checked']) { ?>
                <div class="delivery-item shadow-sm delivery-checked">
                    <input type="checkbox" class="check-box" checked data-delivery-id="<?php echo $delivery['ID'] ?>">
                <?php } else { ?>
                    <div class="delivery-item shadow-sm">
                        <input type="checkbox" class="check-box" data-delivery-id="<?php echo $delivery['ID'] ?>">
                    <?php } ?>
                    <h2><?php echo $delivery['delivery_title'] ?></h2>
                    <div class="delivery-card-buttons">
                        <a href="update.php?id=<?php echo $delivery['ID'] ?>"><button type="button" class="update-delivery-button fas fa-pencil-alt"></button></a>
                        <span id="<?php echo $delivery['ID'] ?>" class="remove-delivery fas fa-times"></span>
                    </div>

                    <?php
                    if (!empty($delivery['delivery_subtitle'])) {
                    ?>
                        <small><strong>Alt İçerik: </strong><?php echo $delivery['delivery_subtitle'] ?></small>
                    <?php
                    }
                    ?>
                    <br />
                    <small>Oluşturuldu: <?php echo $delivery['delivery_datetime'] ?></small>
                    <br />

                    <div class="categories-section">
                        <?php
                        $deliveryId = $delivery['ID'];
                        $categories = $conn->query("SELECT category_name FROM category_delivery INNER JOIN categories on categories.ID=category_delivery.category_ID WHERE category_delivery.delivery_ID='$deliveryId' ");
                        if ($categories->rowCount() > 0) {
                            foreach ($categories as $category) {
                        ?>
                                <h6><span class="badge bg-secondary"><?php echo $category['category_name'] ?></span></h6>
                        <?php
                            }
                        }
                        ?>
                    </div>

                    </div>
                <?php } ?>

        <?php }
}
        ?>