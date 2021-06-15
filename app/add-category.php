<?php
    session_start();
    require('../db/db_conn.php');

    if( isset($_SESSION['id']) && isset($_POST['category_name']) ) {
        $categoryName = $_POST['category_name'];
        $userId = $_SESSION['id'];

        if( empty($categoryName) || empty($userId) ) {
            header('Location: ../home.php?err=Geçersiz kategori ismi girildi');
        }
        else {
            $stmt = $conn->prepare('INSERT INTO categories(category_name,user_ID) VALUE(?,?)');
            $res = $stmt->execute([$categoryName,$userId]);
            
            if($res) header('Location: ../home.php');
            else     header('Location: ../home.php?err=Kategori eklenirken hata oluştu');
            $conn = null;
            exit();
        }

    }
    else {
        header('Location: ../home.php');
    }
?>