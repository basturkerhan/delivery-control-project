<?php
session_start();
if (isset($_POST['delivery_id']) && isset($_POST['category_name']) && isset($_POST['new_title']) && isset($_SESSION['id'])) {
    require('../db/db_conn.php');

    $newTitle = trim($_POST['new_title']);
    $newSubTitle = trim($_POST['new_subtitle']);
    $deliveryId = $_POST['delivery_id'];
    $categoryName = $_POST['category_name'];
    $userId = $_SESSION['id'];

    
    $sth = $conn->prepare("SELECT ID FROM categories WHERE category_name=? AND user_ID=?");
    $isCategoryExist = $sth->execute([$categoryName,$userId]);
    $category = $sth->fetch(PDO::FETCH_ASSOC);

    if ($category) {
        // kategori mevcut
        $categoryId = $category['ID'];

        $stmt = $conn->prepare("UPDATE deliveries SET delivery_title=?, delivery_subtitle=? WHERE ID=?");
        $res = $stmt->execute([$newTitle,$newSubTitle,$deliveryId]);
        
        if($res) {
            $stmt = $conn->prepare('INSERT INTO category_delivery(category_ID, delivery_ID) VALUE(?,?)');
            $res = $stmt->execute([$categoryId, $deliveryId]);
            if($res) {
                header("Location: ../home.php");
            }
            else {
                header("Location: ../home.php?mess=not updated");
            }
        }
        else {
            header("Location: ../home.php?mess=not updated");
        }

        $conn = null;
        exit();

    } else {
        if ($categoryName == "Yeni Kategori Ekleme") {
            // kategori eklenmeden sadece ismi güncelle
            $stmt = $conn->prepare("UPDATE deliveries SET delivery_title=?, delivery_subtitle=? WHERE ID=?");
            $res = $stmt->execute([$newTitle,$newSubTitle,$deliveryId]);
            if($res) {
                header("Location: ../home.php");
            }
            else {
                header("Location: ../home.php?mess=not updated");
            }
            
            $conn = null;
            exit();

        } else {
            // eski sayfaya dön
            header("location:javascript://history.go(-1)");
            $conn = null;
            exit();
        }
    }
} else {
    header("Location: ../home.php");
}
