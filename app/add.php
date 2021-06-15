<?php
    session_start();
    require('../db/db_conn.php');

    if( isset($_POST['title']) && isset($_SESSION['id']) ) {
        $userId = $_SESSION['id'];
        $title = $_POST['title'];

        if( empty($title) || empty($userId) ) {
            header("Location: ../home.php?mess=Başlık ya da kullanıcı boş bırakılamaz");
        }
        else {
            $subTitle = $_POST['subtitle'] ? $_POST['subtitle'] : "";
            $stmt = $conn->prepare("INSERT INTO deliveries(delivery_title, delivery_subtitle, user_ID) VALUE(?,?,?)");
            $res = $stmt->execute([$title,$subTitle,$userId]);
            
            if($res) {
                header("Location: ../home.php?mess=Teslimat bilgisi kartı başarıyla eklendi");
            }
            else {
                header("Location: ../home.php?mess=Teslimat bilgisi kartı eklenemedi");
            }
            $conn = null;
            exit();
        }
    }
    else {
        header("Location: ../home.php");
    }
?>