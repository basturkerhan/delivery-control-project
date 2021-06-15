<?php
    $sName   = "";
    $uName   = "";
    $pass    = "";
    $db_name = "";

    try {
        $conn = new PDO("mysql:host=$sName;dbname=$db_name", $uName, $pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "Connection Success";
    }
    catch (PDOException $err) {
        echo "Connection Error: ".$err->getMessage();
    }

?>