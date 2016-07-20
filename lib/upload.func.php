<?php

//多个文件 <input type="file" name="myfile[]" multiple="multiple"/>
function uploadfiles($files){
    $statusArr = array();
    $fileArray = reArrayFiles($files);
    foreach ($fileArray as $key => $value) {
        $mes = uploadfile($value);
        array_push($statusArr,$mes);
    }
    return $statusArr;
}


//单个文件上传 <input type="file" name="myfile" />
function uploadfile($fileInfo,$uploadfile='uploads',$allowExt=array('jpeg','jpg','gif','png','wbmp'),$maxSize=512000,$imgflag=true){
    //$allowExt = array('jpeg','jpg','gif','png','wbmp');
    //$maxSize = 1024*1024/2;   //最大500kb
    //$imgflag = true; //必须为真正的图片类型

    if($fileInfo['error'] == UPLOAD_ERR_OK){
        //生成唯一名称的文件
        $ext = getExt($fileInfo['name']);
        $filename = getUniName($fileInfo['name']).'.'.$ext;

        if(!in_array($ext,$allowExt)){
            $mes = '文件类型不合法';
            return $mes;
            exit;
        }

        if($imgflag){
            $imgInfo = getimagesize($fileInfo['tmp_name']);
            //var_dump($imgInfo);
            if(!$imgInfo){
                exit('不是真正的图片类型');
            }
        }

        if($fileInfo['size']>$maxSize){
            $mes = '文件过大';
            return $mes;
            exit;
        }

        //$uploadfile = 'uploads';
        if(!file_exists($uploadfile)){
            mkdir($uploadfile,0777,true);
        }
        //判断文件是否是通过 http post 方式上传上来的
        $destination = $uploadfile.'/'.$filename;
        if(is_uploaded_file($fileInfo['tmp_name'])){
            if(move_uploaded_file($fileInfo['tmp_name'],$destination)){
                $mes = '文件上传成功';
            }else{
                $mes = '文件移动失败';
            }
        }else{
            $mes = '文件不是通过 http post 方式上传上来的';
        }
    }else{
        switch ($fileInfo['error']){
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

    return $mes;
}
//组装上传数据信息
function reArrayFiles($file){
    $file_ary = array();
    $file_count = count($file['name']);
    $file_key = array_keys($file);

    for($i=0;$i<$file_count;$i++){
        foreach($file_key as $val){
            $file_ary[$i][$val] = $file[$val][$i];
        }
    }
    return $file_ary;
}



 ?>
