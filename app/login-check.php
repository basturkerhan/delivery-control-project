<?php
    session_start();
    require('../db/db_conn.php');
    if( isset($_POST['uname']) && isset($_POST['password']) ) {
        function validate($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        $uname = validate($_POST['uname']);
        $pass = validate($_POST['password']);

        if(empty($uname)) {
            header("Location: ../login.php?mess=Kullanıcı adı boş bırakılamaz");
        }
        else if(empty($pass)) {
            header("Location: ../login.php?mess=Şifre boş bırakılamaz");
        }
        else {
            // echo "Valid input";
            $pass = md5($pass);
            $result = $conn->query("SELECT * FROM users WHERE user_name='$uname' AND password='$pass' LIMIT 1 ");
            $user = $result->fetch();

            if($result->rowCount()===1) {
                
                if($user['user_name']===$uname && $user['password']===$pass) {
                    //! logged
                    $_SESSION['user_name'] = $user['user_name'];
                    $_SESSION['name'] = $user['name'];
                    $_SESSION['id'] = $user['id'];
                    header("Location: ../home.php");
                }
                else {
                    header("Location: ../login.php?mess=Kullanıcı adı veya şifre hatalı");
                }
            }
            else {
                header("Location: ../login.php?mess=Kullanıcı adı ve/veya şifre hatalı");
            }
        }

    }
    else {
        header("Location: ../login.php?mess=Fill in all fields");
    }

    $conn = null;
    exit();
?>