<?php

    //添加图片数据
    function addAlbum($arr){
        $id = insert('imooc_album',$arr);
        return $id;
    }


 ?>
