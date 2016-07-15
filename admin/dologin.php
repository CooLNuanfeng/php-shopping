<?php
    include_once "../include.php";

    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $verify = $_POST['verify'];
    $autoflag = @$_POST['autoFlag'];

    if(strtolower($verify) == strtolower($_SESSION['verify'])){
        $sql = "select * from imooc_admin where username='{$username}' and password='{$password}'";
        $row = checkAdmin($sql);
        if($row){
            if($autoflag){
                setcookie('username',$row['username'],time()+7*24*3600);
                setcookie('adminId',$row['id'],time()+7*24*3600);
            }
            $_SESSION['username'] = $row['username'];
            $_SESSION['adminId'] = $row['id'];
            header('location:index.php');
        }else{
            alertMeg('登录失败，请重试','login.php');
        }
    }else{
        alertMeg('验证码错误','login.php');
    }
 ?>
