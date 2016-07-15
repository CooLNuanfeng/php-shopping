<?php

    //错误提示函数
    function alertMeg($mesg,$url){
        echo "<script>alert('".$mesg."')</script>";
        echo "<script>window.location = '".$url."';</script>";
    }

 ?>
