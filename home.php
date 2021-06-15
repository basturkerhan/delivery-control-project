<?php
session_start();
require('./db/db_conn.php');

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) { ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sayfam | Delivery-Control</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link href="./docs/bootstrap.min.css" rel="stylesheet">

    </head>

    <body>
        <div class="delivery-system-home">
            <div>
                <?php include('./components/app-header.php') ?>
            </div>
            <div class="mt-2 container">
                <?php include('./components/app-deliveries-area.php') ?>
            </div>

        </div>

        <div class="right-buttons">
            <button type="button" class="hide-add-buttons-button fas fa-eye"></button>

            <div class="add-buttons" show="1">
                <button type="button" class="remove-category-button fas fa-tags" data-bs-toggle="modal" data-bs-target="#removeCategory"></button>
                <button type="button" class="add-category fas fa-tags" data-bs-toggle="modal" data-bs-target="#addCategory"></button>
                <button type="button" class="add-delivery fas fa-plus" data-bs-toggle="modal" data-bs-target="#addDelivery"></button>
            </div>
        </div>



        <!-- REMOVE CATEGORY MODAL -->

        <div class="modal fade" id="removeCategory" tabindex="-1" aria-labelledby="removeCategoryLabel" aria-hidden="true">
            <?php
            $userId = $_SESSION['id'];
            $allCategories = $conn->query(" SELECT category_name FROM categories WHERE user_ID='$userId' ");
            ?>


            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="removeCategoryLabel">Bir kategoriyi sil</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="./app/delete-category.php" method="POST" class="category-remove-form">
                            <div class="form-group">
                                <select class="form-control" name="category_name">
                                    <option>Silinecek Kategori Seçiniz</option>
                                    <?php
                                    if ($allCategories->rowCount() > 0) {
                                        foreach ($allCategories as $category) {
                                    ?>
                                            <option><?php echo $category['category_name'] ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <br />
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-danger">Kategoriyi Sil</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <!-- CATEGORY MODAL -->

        <div class="modal fade" id="addCategory" tabindex="-1" aria-labelledby="addCategoryLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addCategoryLabel">Yeni kategori ekle</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="./app/add-category.php" method="POST" class="category-add-form">
                            <input type="text" class="form-control" name="category_name" placeholder="kategori ismini giriniz..."></input>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Kategori Ekle</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- DELIVERY MODAL -->

        <div class="modal fade" id="addDelivery" tabindex="-1" aria-labelledby="addDeliveryLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addDeliveryLabel">Yeni teslimat bilgisi ekle</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="./app/add.php" method="POST" class="delivery-add-form">
                            <label>Başlık (Zorunlu)</label>
                            <input type="text" class="form-control" name="title" placeholder="lütfen teslimat başlığı giriniz..."></input>
                            <br />
                            <label>Alt Başlık (Opsiyonel)</label>
                            <input type="text" class="form-control" name="subtitle" placeholder="isterseniz detay ekleyebilirsiniz..."></input>
                            
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Teslimat Ekle</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/a0a0a22776.js" crossorigin="anonymous"></script>
        <script src="js/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                $('.remove-delivery').click(function() {
                    const id = $(this).attr('id');
                    $.post('app/remove.php', {
                            id: id
                        },
                        (data) => {
                            if (data) {
                                $(this).parent().parent().hide(600);
                            }
                        }
                    );
                })

                $(".check-box").click(function() {
                    const id = $(this).attr('data-delivery-id');
                    $.post('app/check.php', {
                        id: id
                    }, (data) => {
                        if (data != "error") {
                            const deliveryCard = $(this).parent();
                            if (data === '1') {
                                deliveryCard.removeClass('delivery-checked');
                            } else {
                                deliveryCard.addClass('delivery-checked');
                            }
                        }
                    });
                })

                $(".hide-add-buttons-button").click(function() {
                    const buttonsList = $(this).next();
                    let isShow = buttonsList.attr('show');
                    if (isShow == "1") {
                        buttonsList.attr('show', '0');
                        buttonsList.hide(600);
                        $(this).removeClass('fa-eye');
                        $(this).addClass('fa-eye-slash');
                    }
                    else {
                        buttonsList.attr('show', '1');
                        buttonsList.show(600);
                        $(this).removeClass('fa-eye-slash');
                        $(this).addClass('fa-eye');
                    }
                })
            })
        </script>
    </body>
    </html>
<?php
    $conn = null;
} else {
    header("Location: login.php");
}
?>