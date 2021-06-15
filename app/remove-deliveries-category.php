<?php
    session_start();
    if( isset($_POST['categoryID']) && isset($_POST['deliveryID']) && isset($_SESSION['id']) ) {
        require('../db/db_conn.php');
        $categoryId = $_POST['categoryID'];
        $deliveryId = $_POST['deliveryID'];
        
        if(empty($categoryId) || empty($deliveryId)) {
            header("Location: ../b.php");
        }

        $stmt = $conn->prepare('DELETE FROM category_delivery WHERE category_ID=? AND delivery_ID=?');
        $res = $stmt->execute([$categoryId, $deliveryId]);
        if($res) {
            echo 1;
        }
        else {
            echo 0;
        }

        $conn = null;
        exit();

    }
    else {
        echo 0;
    }

?>