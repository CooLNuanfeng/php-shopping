<?php

    require_once "../include.php";
    echo thumb('blog.png','uploads/image_50',50,50);
    /*
    //生成缩略图   参数  文件名  生成的目标目录  生成的目标图片宽高   是否保留原始图片 缩放比例
    function thumb($filename,$disfile=null,$des_w=null,$des_h=null,$isReservedSource=true,$scale=0.5){
        list($src_w,$src_h,$imagetype) = getimagesize($filename);
        $imagemine = image_type_to_mime_type($imagetype);

        $createFun = str_replace('/','createfrom',$imagemine);
        $outFun = str_replace('/','',$imagemine);

        //$scale = 0.5;
        if(is_null($des_w) || is_null($des_h)){
            $des_w = ceil($scale*$src_w);
            $des_h = ceil($scale*$src_h);
        }

        $src_image = $createFun($filename);

        $des_image = imagecreatetruecolor($des_w,$des_h);
        imagecopyresampled($des_image,$src_image,0,0,0,0,$des_w,$des_h,$src_w,$src_h);

        if($disfile && !file_exists($disfile)){ //目标文件目录是否存在
            mkdir($disfile);
        }
        //如果为指定目标目录，则随机生成文件名称
        $disFilename = $disfile==null?getUniName().'.'.getExt($filename):$disfile.'/'.$filename;
        $outFun($des_image,$disFilename);
        imagedestroy($des_image);
        imagedestroy($src_image);

        if(!$isReservedSource){ //是否保留原文件
            unlink($filename);
        }

        return $disFilename;
    }

    */

    /*

    $filename = 'blog.png';

    list($src_w,$src_h,$imagetype) = getimagesize($filename);
    $imagemine = image_type_to_mime_type($imagetype);  //获取图片类型
    //echo $imgmine
    $createFun = str_replace('/','createfrom',$imagemine);
    $outFun = str_replace('/','',$imagemine);

    $src_image = $createFun($filename);

    $des_50_image = imagecreatetruecolor(50,50);
    $des_220_image = imagecreatetruecolor(220,220);

    imagecopyresampled($des_50_image,$src_image,0,0,0,0,50,50,$src_w,$src_h);
    imagecopyresampled($des_220_image,$src_image,0,0,0,0,220,220,$src_w,$src_h);

    if(!file_exists('uploads/image_50')){
        mkdir('uploads/image_50');
    }
    if(!file_exists('uploads/image_220')){
        mkdir('uploads/image_220');
    }

    $outFun($des_50_image,'uploads/image_50/'.$filename);
    $outFun($des_220_image,'uploads/image_220/'.$filename);

    imagedestroy($src_image);
    imagedestroy($des_50_image);
    imagedestroy($des_220_image);
    */



    /*
    $filename = 'blog.png';

    $src_image = imagecreatefrompng($filename);  //原始图片资源
    list($src_w,$src_h) = getimagesize($filename); //获取原始图片的相关尺寸数据
    $scale = 0.5; //缩放比
    $des_w = ceil($src_w*$scale);
    $des_h = ceil($src_h*$scale);

    $des_image = imagecreatetruecolor($des_w,$des_h);  //新建画布资源
    $flag = imagecopyresampled($des_image,$src_image,0,0,0,0,$des_w,$des_h,$src_w,$src_h);
    header('content-type:image/png');
    imagepng($des_image,'uploads/'.$filename);
    imagedestroy($des_image);
    imagedestroy($src_image);
    */

 ?>
