<?php
    //检查是否有管理员
    function checkAdmin($sql){
        return fetchOne($sql);
    }

    //检查是否登录
    function checkLogined(){
        if(!@$_SESSION['adminId'] && !@$_COOKIE['adminId']){
            header('location:login.php');
        }
    }

    //退出登录态
    function logout(){
        $_SESSION = array();
        if(isset($_COOKIE[session_name()])){
            setcookie(session_name(),'',time()-1);
        }

        if(isset($_COOKIE['adminId'])){
            setcookie('adminId','',time()-1);
        }

        if(isset($_COOKIE['username'])){
            setcookie('username','',time()-1);
        }

        session_destroy();
        header('location:login.php');
    }


    //添加管理员
    function addAdmin(){
        $arr = $_POST;

        if(!$arr['username'] || !$arr['password'] || !$arr['email']){
            return $mes = "用户名密码邮箱都不为空<a href='addAdmin.php'>重新添加</a>";
        }

        $arr['password'] = md5($_POST['password']);
        $id = insert('imooc_admin',$arr);
        if($id){
            $mes = "添加成功!<br/><a href='addAdmin.php'>继续添加</a>|<a href='listAdmin.php'>查看管理员列表</a>";
    	}else{
    		$mes = "添加失败!<br/><a href='addAdmin.php'>重新添加</a>";
    	}
        return $mes;
    }

    //查看管理员
    function getAdminByPage($page,$pageSize=5){
        $sql = "select * from imooc_admin";
        global $totalRows;
        $totalRows = getResultNum($sql);
        global $totalPage;
        $totalPage = ceil($totalRows/$pageSize);
        if($page<1||$page==null||!is_numeric($page)){
            $page = 1;
        }
        if($page>=$totalPage)$page=$totalPage;
        $nowOffset = ($page-1)*$pageSize;
        $sql ="select id,username,email from imooc_admin limit {$nowOffset},{$pageSize}";
        $rows = fetchAll($sql);
        return $rows;
    }


    //编辑管理员
    function editAdmin($id){
        $arr = $_POST;
        $arr['password'] = md5($_POST['password']);
        if(update('imooc_admin',$arr,"id={$id}")){
            $mes = '修改成功<br><a href="listAdmin.php">查看管理员列表</a>';
        }else{
            $mes = "修改失败<br><a href='listAdmin.php'>重新修改</a>";
        }
        return $mes;
    }

    //删除管理员
    function deleteAdmin($id){
        if(delete('imooc_admin',"id={$id}")){
            $mes = "删除成功<br><a href='listAdmin.php'>查看管理员列表</a>";
        }else{
            $mes = "删除失败<br><a href='listAdmin.php'>重新修改</a>";
        }

        return $mes;
    }
?>
