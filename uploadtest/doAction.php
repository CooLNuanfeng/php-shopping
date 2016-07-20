<?php
    require_once "../include.php";
    //$_FILES;
    header('content-type:text/html;chartset=utf-8');
    //print_r($_FILES);

    echo '<br>';
    $arr = uploadfiles($_FILES['myfile']);   //多个上传

    var_dump($arr);
    echo '<br>';
    $mes = uploadfile($_FILES['myfile1']); //单个上传
    echo $mes;

/*

    @$filename = $_FILES['myfile']['name'];
    @$type = $_FILES['myfile']['type'];
    @$tmp_name = $_FILES['myfile']['tmp_name']; //临时文件名
    @$error = $_FILES['myfile']['error'];
    @$size = $_FILES['myfile']['size'];
    $allowExt = array('jpeg','jpg','gif','png','wbmp');
    $maxSize = 1024*1024/2;   //最大500kb
    $imgflag = true; //必须为真正的图片类型

    if($error == UPLOAD_ERR_OK){
        //生成唯一名称的文件
        $ext = getExt($filename);
        $filename = getUniName($filename).'.'.$ext;

        if(!in_array($ext,$allowExt)){
            $mes = '文件类型不合法';
            echo $mes;
            exit;
        }

        if($imgflag){
            $imgInfo = getimagesize($tmp_name);
            //var_dump($imgInfo);
            if(!$imgInfo){
                exit('不是真正的图片类型');
            }
        }

        if($size>$maxSize){
            $mes = '文件过大';
            echo $mes;
            exit;
        }

        $uploadfile = 'uploads';
        if(!file_exists($uploadfile)){
            mkdir($uploadfile,0777,true);
        }
        //判断文件是否是通过 http post 方式上传上来的
        $destination = $uploadfile.'/'.$filename;
        if(is_uploaded_file($tmp_name)){
            if(move_uploaded_file($tmp_name,$destination)){
                $mes = '文件上传成功';
            }else{
                $mes = '文件移动失败';
            }
        }else{
            $mes = '文件不是通过 http post 方式上传上来的';
        }
    }else{
        switch ($error){
            case 1:
                $mes = '超过了配置文件上传的大小限制';
                break;
            case 2:
                $mes = '超过了表单设置上传文件的大小';
                break;
            case 3:
                $mes = '文件部分被上传';
                break;
            case 4:
                $mes = '没有文件被上传';
                break;
            case 6:
                $mes = '没有找到临时目录';
                break;
            case 7:
                $mes = '文件不可写';
                break;
            case 8:
                $mes = '由于PHP的扩展程序中断了上传文件';
                break;
        }
    }

    echo $mes;


*/
 ?>
