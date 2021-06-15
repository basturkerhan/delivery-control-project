<?php
session_start();
if (isset($_POST['id']) && isset($_SESSION['id'])) {
    require('../db/db_conn.php');
    $id = $_POST['id'];
    $userId = $_SESSION['id'];

    if (empty($id)) {
        echo 0;
    } else {
        $isExist = $conn->query("SELECT * FROM category_delivery WHERE delivery_ID='$id'");
        if ($isExist->rowCount() > 0) {
            $stmt = $conn->prepare('DELETE FROM category_delivery WHERE delivery_ID=?');
            $silindi = $stmt->execute([$id]);
            if ($silindi) {
                $stmt = $conn->prepare('DELETE FROM deliveries WHERE ID=? AND user_ID=?');
                $res = $stmt->execute([$id, $userId]);

                if ($res) {
                    echo 1;
                } else {
                    echo 0;
                }
            }
        } else {
            $stmt = $conn->prepare('DELETE FROM deliveries WHERE ID=? AND user_ID=?');
            $res = $stmt->execute([$id, $userId]);

            if ($res) {
                echo 1;
            } else {
                echo 0;
            }
        }



        $conn = null;
        exit();
    }
} else {
    header("Location: ../home.php");
}
