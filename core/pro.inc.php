<?php
    require_once '../include.php';

    //添加商品
    function addPro(){
        $proInfo = $_POST;
        $proInfo['pubTime'] = time();

        var_dump($_POST);
        echo '<br>';
        echo '<br>';
        echo '<br>';
        var_dump($_FILES);
        echo '<br>';
        echo '<br>';
        echo '<br>';

        $fileArr = uploadfiles($_FILES['thumbs'],'../admin/uploads/images');
        var_dump($fileArr);


        if(is_array($fileArr)&&$fileArr){
            foreach ($fileArr as $key => $value) {
                //上传成功生成缩略图
                if($value['status']){
                    $path = '../admin/uploads/images';
                    thumb($value['info']['name'],'../admin/uploads/images_200',200,200,$path);
                }else{
                    //没有上传成的文件  提示那些文件上传失败
                }
            }
            //将 产品信息存入表中
            $insertId = insert('imooc_pro',$proInfo);

            if($insertId){ //产品信息成功存入数据库
                foreach ($fileArr as $key => $value) {
                    //上传成功 将图片信息存入表中
                    if($value['status']){
                        $albumInfo['pid'] = $insertId;
                        $albumInfo['albumPath'] = $value['info']['name'];
                        addAlbum($albumInfo);
                    }
                }
                $mes = '<p>添加成功</p><a href="addPro.php">继续添加</a>|<a href="listPro.php">查看商品列表</a>';
                return $mes;
            }else{ //产品信息没有成功存入数据库，要将上传的文件删除掉
                foreach ($fileArr as $key => $value) {
                    if($value['status']){
                        if(file_exists('../admin/uploads/images_200/'.$value['info']['name'])){
                            unlink('../admin/uploads/images_200/'.$value['info']['name']);
                        }
                        if(file_exists('../admin/uploads/images/'.$value['info']['name'])){
                            unlink('../admin/uploads/images/'.$value['info']['name']);
                        }
                    }
                }
                $mes = '<p>添加失败</p><a href="addPro.php">重新添加</a>|<a href="listPro.php">查看商品列表</a>';
                return $mes;
            }


        }

    }




 ?>
