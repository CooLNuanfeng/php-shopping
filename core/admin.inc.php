<?php
    //添加管理员
    function addAdmin(){
        $arr = $_POST;
        if(!$arr['username']||!$arr['email']||!$arr['password']){
            return $mes ="用户名密码邮箱都不为空<a href='addAdmin.php'>重新添加</a>";
        }
        $arr['password'] = md5($_POST['password']);
        $id = insert('imooc_admin',$arr);
        if($id){
            $mes="添加成功!<br/><a href='addAdmin.php'>继续添加</a>|<a href='listAdmin.php'>查看管理员列表</a>";
    	}else{
    		$mes="添加失败!<br/><a href='addAdmin.php'>重新添加</a>";
    	}
        return $mes;
    }

    //查看管理员
    function getAdminByPage($page,$pageSize=2){
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
?>
