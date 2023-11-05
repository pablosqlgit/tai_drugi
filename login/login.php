<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/tai_drugi/conn.php';

    $username = $_POST['login'];
    $password = $_POST['pass'];
    
    $userQ = "SELECT login FROM users WHERE login = '$username'";
    $passQ = "SELECT pass FROM users WHERE login = '$username'";

    $userRes = mysqli_query($conn,$userQ);
    $passRes = mysqli_query($conn,$passQ);


    if (mysqli_num_rows($userRes) == 1) {
        $passCheck = mysqli_fetch_assoc($passRes);
        if (password_verify($password, $passCheck['pass'])){
            header("Location:../main/index.html");
        }elseif($password == $passCheck['pass']){
            header("Location:../main/index.html");
        }
    }elseif (mysqli_num_rows($userRes) == 0) {
        echo "such a user does not exists";
    }
?>