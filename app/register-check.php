<?php
    session_start();
    require('../db/db_conn.php');
    if( isset($_POST['uname']) && isset($_POST['password']) && isset($_POST['name']) && isset($_POST['re-password']) ) {
        function validate($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        $uname = validate($_POST['uname']);
        $pass = validate($_POST['password']);
        $repass = validate($_POST['re-password']);
        $name = validate($_POST['name']);

        if($pass !== $repass) {
            header("Location: ../register.php?mess=Şifre alanları eşleşmiyor");
            exit();
        }

        if(empty($uname) || empty($name) || empty($pass) || empty($repass) ) {
            header("Location: ../register.php?mess=Lütfen tüm alanları eksiksiz doldurunuz");
        }
        else {
            // echo "Valid input";
            $result = $conn->query("SELECT * FROM users WHERE user_name='$uname' LIMIT 1");
            $user = $result->fetch();

            if($result->rowCount()>0) {
                // same nickname
                header("Location: ../register.php?mess=Bu kullanıcı adı alınmış");
                exit();
            }
            else {
                // not used nickname
                $pass = md5($pass);
                $stmt = $conn->prepare('INSERT INTO users(user_name, password, name) VALUE(?,?,?)');
                $res = $stmt->execute([$uname, $pass, $name]);

                if($res) {
                    header("Location: ../login.php?succ=Kayıt işlemi başarıyla tamamlandı");
                }
                else {
                    header("Location: ../register.php?mess=505 Kayıt olma hatası");
                }
            }
        }

    }
    else {
        header("Location: ../register.php?mess=Fill in all fields");
    }

    $conn = null;
    exit();
?>