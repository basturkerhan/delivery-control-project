<?php
session_start();
require('../db/db_conn.php');

if (isset($_POST['id']) && isset($_SESSION['id'])) {
    $id = $_POST['id'];
    $userId = $_SESSION['id'];

    if( empty($id) || empty($userId) ) {
        echo "error";
    } else {
        $deliveries = $conn->prepare('SELECT ID,delivery_checked FROM deliveries WHERE ID=? AND user_ID=?');
        $deliveries->execute([$id, $userId]);

        $delivery = $deliveries->fetch();
        $deliveryId = $delivery['ID'];
        $checked = $delivery['delivery_checked'];
        $uChecked = $checked ? 0 : 1;

        $res = $conn->query("UPDATE deliveries SET delivery_checked=$uChecked WHERE ID=$deliveryId AND user_ID=$userId");

        if ($res) {
            echo $checked;
        } else {
            echo "error";
        }

        $conn = null;
        exit();
    }
} else {
    header("Location: ../home.php");
}
