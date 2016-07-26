<?php
//添加分类
function addCate(){
    $arr = $_POST;
    $id = insert('imooc_cate',$arr);
    if($id){
        $mes = '添加成功！<br> <a href="addCate.php">继续添加</a>|<a href="listCate.php">查看列表</a>';
    }else{
        $mes = '添加失败！<br> <a href="addCate.php">重新添加</a>|<a href="listCate.php">查看列表</a>';
    }
    return $mes;
}

//修改分类
function editCate($id){
    $arr = $_POST;

    if(update('imooc_cate',$arr,"id=$id")){
        $mes =  '修改成功！<br> <a href="listCate.php">查看列表</a>';
    }else{
        $mes =  '修改失败！<br> <a href="listCate.php">重新修改</a>';
    }
    return $mes;
}

//删除分类
function deleteCate($id){
    //检查该分类下是否还有产品
    $rows = checkProExist($id);
    if(!$rows){
        if(delete('imooc_cate',"id=$id")){
            $mes = '删除成功！<br> <a href="listCate.php">查看列表</a>';
        }else{
            $mes = '删除失败！<br> <a href="listCate.php">重新修改</a>';
        }
        return $mes;
    }else{
        alertMeg('该分类下有产品，请先删除产品','listPro.php');
    }

}


//获取所有分类
function getAllCate(){
    $sql = 'select id,cName from imooc_cate';
    $rows = fetchAll($sql);
    return $rows;
}


 ?>
