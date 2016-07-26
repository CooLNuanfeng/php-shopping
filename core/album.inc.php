<?php

    //添加图片数据
    function addAlbum($arr){
        $id = insert('imooc_album',$arr);
        return $id;
    }

    //根据商品 id 获取一张图片
    function getProImgById($id){
        $sql = "select albumPath from imooc_album where pid={$id} limit 1";
        $row = fetchOne($sql);
        return $row;
    }


 ?>
