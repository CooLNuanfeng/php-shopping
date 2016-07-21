<?php

require_once "string.func.php";

//生成缩略图   参数  文件名  生成的目标目录  生成的目标图片宽高   是否保留原始图片 缩放比例
function thumb($filename,$disfile=null,$des_w=null,$des_h=null,$path='.',$isReservedSource=true,$scale=0.5){

    list($src_w,$src_h,$imagetype) = getimagesize($path.'/'.$filename);
    $imagemine = image_type_to_mime_type($imagetype);

    $createFun = str_replace('/','createfrom',$imagemine);
    $outFun = str_replace('/','',$imagemine);

    //$scale = 0.5;
    if(is_null($des_w) || is_null($des_h)){
        $des_w = ceil($scale*$src_w);
        $des_h = ceil($scale*$src_h);
    }

    $src_image = $createFun($path.'/'.$filename);

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
        unlink($path.'/'.$filename);
    }

    return $disFilename;
}




//生成验证码
//参数说明 $sess_name session通信的字段名 $type 验证码类型 有 1，2，3，三种  $length 验证码长度  $pixel,$line 是否有点线干扰
function verifyImage($type=1,$length=4,$pixel=true,$line=true,$sess_name='verify'){

    //通过GD库做验证码
    //创建画布
    $width = 120;
    $height = 40;
    $image = imagecreatetruecolor($width,$height);
    //在画布中创建颜色
    $white = imagecolorallocate($image,255,255,255);
    $black = imagecolorallocate($image,0,0,0);

    //用填充矩形填充画布
    imagefilledrectangle($image,1,1,$width-2,$height-2,$white);

    $char = buildRandomString($type,$length);
    //session_start();  //include.php 中已经开启
    $_SESSION[$sess_name] = $char;

    //$fontArray = array('HARLOWSI.TTF','kartika.ttf','kartikab.ttf','msyh.ttf','myshbd.ttf','STCAIYUN.TTF','STHUPO.TTF');
    $fontArray = array('kartika.ttf','HARLOWSI.TTF','msyh.ttf');
    //echo $char;
    for($i=0;$i<$length;$i++){
        $size = mt_rand(18,24);  //字体大小
        $angle = mt_rand(-15,15); //字体角度
        $x = 10 + $i * $size;  //字体偏移量 x 方向
        $y = mt_rand(20,35);  //字体偏移量 y 方向
        $fontfile = '../fonts/'.$fontArray[mt_rand(0,count($fontArray)-1)];   //字体文件
        $color = imagecolorallocate($image,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
        $text = substr($char,$i,1); //验证码
        imagettftext($image,$size,$angle,$x,$y,$color,$fontfile,$text);
    }

    //干扰元素
    $pixel = true;
    if($pixel){
        for($i=0;$i<50;$i++){
            $randPixelColor = imagecolorallocate($image,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
            imagesetpixel($image,mt_rand(0,$width-1),mt_rand(0,$height-1),$randPixelColor);
        }
    }
    $line = true;
    if($line){
        for($i=0;$i<5;$i++){
            $randLineColor = imagecolorallocate($image,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
            imageline($image,mt_rand(0,$width-1),mt_rand(0,$height-1),mt_rand(0,$width-1),mt_rand(0,$height-1),$randLineColor);
        }
    }


    header('Content-Type: image/png');
    imagepng($image);
    imagedestroy($image);
}
 ?>
