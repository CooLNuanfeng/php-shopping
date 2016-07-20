<?php

//产生 随机字符串
function buildRandomString($type=1,$length=4){
    switch ($type) {
        case 1:
            @$char = join('',range(0,9));
            break;
        case 2:
            @$char = join('',array_merge(range(a,z),range(A,Z)));
            break;
        case 3:
            @$char = join('',array_merge(range(a,z),range(A,Z),range(0,9)));
            break;
    }
    if($length > strlen($char)){
        exit('字符串长度不够');
    }
    $char = str_shuffle($char);
    return substr($char,0,$length);
}


//生成唯一字符串
function getUniName(){
    return md5(uniqid(microtime(true),true));
}


//获取文件扩展名
function getExt($filename){
    return strtolower(end(explode(".",$filename)));
}

 ?>
