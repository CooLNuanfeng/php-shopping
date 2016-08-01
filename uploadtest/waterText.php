<?php

    $filename = 'blog.png';
    $fileInfo = getimagesize($filename);
    $mime = $fileInfo['mime'];

    $createFun = str_replace('/','createfrom',$mime);
    $outFun = str_replace('/','',$mime);

    $image = $createFun($filename);

    $color = imagecolorallocatealpha($image,255,0,0,50);
    $fontfile = '../fonts/kartika.ttf';
    $text = 'imooc.com';
    imagettftext($image,16,0,0,16,$color,$fontfile,$text);
    header('content-type:'.$mime);
    $outFun($image);
    imagedestroy($image);

/*
    function waterText($filename,$path='.',$text="imooc.com",$font='kartika.ttf'){
        $fileInfo = getimagesize($filename);
        $mime = $fileInfo['mime'];

        $createFun = str_replace('/','createfrom',$mime);
        $outFun = str_replace('/','',$mime);

        $image = $createFun($filename);

        $color = imagecolorallocatealpha($image,255,0,0,50);
        $fontfile = '../fonts/{$font}';
        imagettftext($image,16,0,0,16,$color,$fontfile,$text);
        header('content-type:'.$mime);
        $outFun($image,$path.'/'.$filename);
        imagedestroy($image);
    }
*/
 ?>
