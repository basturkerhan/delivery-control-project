<?php
session_start();
if (isset($_POST['delivery_id']) && isset($_POST['category_name']) && isset($_POST['new_title']) && isset($_SESSION['id'])) {
    require('../db/db_conn.php');

    $newTitle = trim($_POST['new_title']);
    $newSubTitle = trim($_POST['new_subtitle']);
    $deliveryId = $_POST['delivery_id'];
    $categoryName = trim($_POST['category_name']);
    $userId = $_SESSION['id'];

    $isCategoryExist = $conn->query("SELECT ID FROM categories WHERE category_name='$categoryName' AND user_ID='$userId'");
    if ($isCategoryExist->rowCount() > 0) {
        // kategori mevcut
        $category = $isCategoryExist->fetch();
        $categoryId = $category['ID'];

        $conn->query("UPDATE deliveries SET delivery_title='$newTitle', delivery_subtitle='$newSubTitle' WHERE ID='$deliveryId'");
        $stmt = $conn->prepare('INSERT INTO category_delivery(category_ID, delivery_ID) VALUE(?,?)');
        $res = $stmt->execute([$categoryId, $deliveryId]);

        if ($res) {
            header("Location: ../home.php?succ=Teslimat bilgisi kartı başarıyla güncellendi");
        } else {
            header("Location: ../home.php?mess=505 Teslimat bilgisi kartı güncelleme hatası");
        }

        $conn = null;
        exit();

    } else {
        if ($categoryName == "Yeni Kategori Ekleme") {
            // kategori eklenmeden sadece ismi güncelle
            $conn->query("UPDATE deliveries SET delivery_title='$newTitle', delivery_subtitle='$newSubTitle' WHERE ID='$deliveryId'");
            header("Location: ../home.php");
            $conn = null;
            exit();

        } else {
            // sonraki sayfaya gidiyor ama bir de ?mess=böyle bir kategori yok ekle
            header("location:javascript://history.go(-1)");
            $conn = null;
            exit();
        }
    }
} else {
    header("Location: ../home.php");
}
