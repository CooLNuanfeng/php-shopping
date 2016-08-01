<?php


    //添加用户
    function addUser(){
        $arr = $_POST;

        if(!$arr['username'] || !$arr['password'] || !$arr['email']){
            return $mes = "用户名密码邮箱都不为空<a href='addAdmin.php'>重新添加</a>";
        }

        $arr['password'] = md5($_POST['password']);

        $imgInfo = uploadfile($_FILES['userImg'],'../admin/uploads/userImg');
        $arr['userImg'] = '../admin/uploads/userImg/'.$imgInfo['info']['name'];
        /*
        var_dump($_FILES);
        echo '<br>';
        var_dump($imgInfo);
        echo '<br>';
        var_dump($_P OST);
        exit;
        */

        $id = insert('imooc_user',$arr);
        if($id){
            $mes = "添加成功!<br/><a href='addUser.php'>继续添加</a>|<a href='listUser.php'>查看用户列表</a>";
    	}else{
    		$mes = "添加失败!<br/><a href='addUser.php'>重新添加</a>";
            unlink('../admin/uploads/userImg/'.$imgInfo['info']['name']);
    	}
        return $mes;
    }


    //查看用户
    function getUserByPage($page,$pageSize=5){
        $sql = "select * from imooc_user";
        global $totalRows;
        $totalRows = getResultNum($sql);
        global $totalPage;
        $totalPage = ceil($totalRows/$pageSize);
        if($page<1||$page==null||!is_numeric($page)){
            $page = 1;
        }
        if($page>=$totalPage)$page=$totalPage;
        $nowOffset = ($page-1)*$pageSize;
        $sql ="select id,username,email from imooc_user limit {$nowOffset},{$pageSize}";
        $rows = fetchAll($sql);
        return $rows;
    }

    //编辑用户
    function editUser($id){
        $arr = $_POST;
        $arr['password'] = md5($_POST['password']);

        $sql = "select userImg from imooc_user where id={$id}";
        $row = fetchOne($sql);
        $img = $row['userImg'];
        //echo $img;
        if(file_exists($img)){
            unlink($img);
        }
        $imgInfo = uploadfile($_FILES['userImg'],'../admin/uploads/userImg');
        $arr['userImg'] = '../admin/uploads/userImg/'.$imgInfo['info']['name'];
        if(update('imooc_user',$arr,"id={$id}")){
            $mes = '修改成功<br><a href="listUser.php">查看用户列表</a>';
        }else{
            $mes = "修改失败<br><a href='listUser.php'>重新修改</a>";
        }
        return $mes;
    }

    //删除用户
    function delUser($id){
        $sql = "select userImg from imooc_user where id={$id}";
        $row = fetchOne($sql);
        $img = $row['userImg'];
        //echo $img;
        if(file_exists($img)){
            unlink($img);
        }
        $imgInfo = uploadfile($_FILES['userImg'],'../admin/uploads/userImg');
        $arr['userImg'] = '../admin/uploads/userImg/'.$imgInfo['info']['name'];

        if(delete('imooc_user',"id={$id}")){
            $mes = "删除成功<br><a href='listUser.php'>查看用户列表</a>";
        }else{
            $mes = "删除失败<br><a href='listUser.php'>重新修改</a>";
        }

        return $mes;
    }

?>
