<?php
session_start();
require('../db/db_conn.php');

if (isset($_SESSION['id']) && isset($_POST['category_name'])) {
    $categoryName = $_POST['category_name'];
    $userId = $_SESSION['id'];

    if($categoryName=='Silinecek Kategori Seçiniz') {
        header('Location: ../home.php');
        exit();
    }

    if (empty($categoryName)) {
        header('Location: ../home.php');
    } else {
        $category = $conn->query("SELECT ID FROM categories WHERE category_name='$categoryName' AND user_ID='$userId' LIMIT 1");
        if ($category->rowCount() > 0) {
            // böyle bir kategori var
            $category = $category->fetch();
            $categoryId = $category['ID'];

            $isCategoryHasDeliveries = $conn->query("SELECT ID FROM category_delivery WHERE category_ID='$categoryId' ");
            if ($isCategoryHasDeliveries->rowCount() > 0) {
                // kartlara sahip
                $stmt = $conn->prepare('DELETE FROM category_delivery WHERE category_ID=?');
                $silindi = $stmt->execute([$categoryId]);
                if ($silindi) {
                    $stmt = $conn->prepare('DELETE FROM categories WHERE ID=? AND user_ID=?');
                    $res = $stmt->execute([$categoryId, $userId]);
                    if ($res)
                        header("Location: ../home.php");
                    else
                        header("Location: ../home.php?err=Kategori silinemedi");
                }
            } else {
                // kartı yok
                $stmt = $conn->prepare('DELETE FROM categories WHERE ID=? AND user_ID=?');
                $res = $stmt->execute([$categoryId, $userId]);
                if ($res)
                    header("Location: ../home.php");
                else
                    header("Location: ../home.php?err=Kategori silinemedi");
            }
        }
        $conn = null;
        exit();
    }
} else {
    header('Location: ../home.php');
}
