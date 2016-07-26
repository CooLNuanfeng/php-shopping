<?php
    //require_once '../include.php';

    //添加商品
    function addPro(){
        $proInfo = $_POST;
        $proInfo['pubTime'] = time();

        /*
        var_dump($_POST);
        echo '<br>';
        echo '<br>';
        echo '<br>';
        var_dump($_FILES);
        echo '<br>';
        echo '<br>';
        echo '<br>';
        */

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

    //编辑商品
    function editPro($id){
        $proInfo = $_POST;

        $fileArr = uploadfiles($_FILES['thumbs'],'../admin/uploads/images');

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
        }

        //将 产品信息存入表中
        $where = "id={$id}";
        $insertId = update('imooc_pro',$proInfo,$where);
        $pid = $id;
        if($insertId){ //产品信息成功存入数据库
            foreach ($fileArr as $key => $value) {
                //上传成功 将图片信息存入表中
                if($value['status']){
                    $albumInfo['pid'] = $id;
                    $albumInfo['albumPath'] = $value['info']['name'];
                    addAlbum($albumInfo);
                }
            }
            $mes = '<p>修改成功</p><a href="listPro.php">查看商品列表</a>';
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
            $mes = '<p>修改失败</p><a href="listPro.php">查看商品列表</a>';
            return $mes;
        }

    }

    //删除商品
    function delPro($id){
        $proImgs = getAllImgByProId($id);
        /*
        var_dump($proImgs);
        echo '<br>';
        foreach ($proImgs as $key => $value) {
            echo '<br>';
            echo $value['albumPath'];
            echo '<br>';
        }
        exit;
        */
        $where = "id = {$id}";
        $res = delete('imooc_pro',$where);
        if($proImgs&&is_array($proImgs)){
            foreach ($proImgs as $key => $value) {
                if(file_exists('../admin/uploads/images/'.$value['albumPath'])){
                    unlink('../admin/uploads/images/'.$value['albumPath']);
                }
                if(file_exists('../admin/uploads/images_200/'.$value['albumPath'])){
                    unlink('../admin/uploads/images_200/'.$value['albumPath']);
                }
            }
        }
        $where1 = "pid={$id}";
        $res1 = delete('imooc_album',$where1);
        if($res&&$res1){
            $mes = '<p>删除成功</p><a href="listPro.php">查看商品列表</a>';
        }else{
            $mes = '<p>删除失败</p><a href="listPro.php">重新删除</a>';
        }

        return $mes;
    }



    //获取图片
    function getAllImgByProId($id){
        $sql = "select a.albumPath from imooc_album a where pid={$id}";
        $rows = fetchAll($sql);
        return $rows;
    }


    //获取指定商品信息
    function getProById($id){
        $sql="select p.id,p.pName,p.pSn,p.pNum,p.mPrice,p.iPrice,p.pDesc,p.pubTime,p.isShow,p.isHot,c.cName,p.cId from imooc_pro as p join imooc_cate c on p.cId=c.id where p.id={$id}";
		$row=fetchOne($sql);
		return $row;
    }

    //检查某分类下产品是否存在
    function checkProExist($cid){
        $sql = "select * from imooc_pro where cId={$cid}";
        $rows = fetchAll($sql);
        return $rows;
    }


    //得到所有商品
    function getAllPros(){
        $sql = "select p.id,p.pName,p.pSn,p.pNum,p.mPrice,p.iPrice,p.pDesc,p.pubTime,p.isShow,p.isHot,c.cName,p.cId from imooc_pro as p join imooc_cate c on p.cId=c.Id";
        $rows = fetchAll($sql);
        return $rows;
    }

    //根据分类id 获取 该分类下的 4条数据 $flag true 上方 false 下方
    function getProsByCid($cid,$flag){
        if($flag){
            $sql = "select p.id,p.pName,p.pSn,p.pNum,p.mPrice,p.iPrice,p.pDesc,p.pubTime,p.isShow,p.isHot,c.cName,p.cId from imooc_pro as p join imooc_cate c on p.cId=c.Id where p.cId={$cid} limit 4";
        }else{
            $sql = "select p.id,p.pName,p.pSn,p.pNum,p.mPrice,p.iPrice,p.pDesc,p.pubTime,p.isShow,p.isHot,c.cName,p.cId from imooc_pro as p join imooc_cate c on p.cId=c.Id where p.cId={$cid} limit 4,4";
        }

        $rows = fetchAll($sql);
        return $rows;
    }



 ?>
