<?php
    include_once '../include.php';
    $pageSize = 2;
    @$page = $_REQUEST['page']?(int)$_REQUEST['page']:1;

    $rows = getAdminByPage($page,$pageSize);
    if(!$rows){
        echo '你还没有添加管理员<a href="addAdmin.php">添加管理员</a>';
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="styles/backstage.css">
</head>
<body>
<div class="details">
    <div class="details_operation clearfix">
        <div class="bui_select">
            <input type="button" value="添&nbsp;&nbsp;加" class="add"  onclick="addAdmin()">
        </div>
    </div>
    <!--表格-->
    <table class="table" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th width="15%">编号</th>
                <th width="25%">管理员名称</th>
                <th width="30%">管理员邮箱</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
        <?php $i=1; foreach($rows as $row):?>
            <tr id="<?php echo $i;?>">
                <td><input type="checkbox" class="check" id="c1"><label for="c1" class="label"><?php echo $row['id']; ?></label></td>
                <td><?php echo $row['username'];?></td>
                <td><?php echo $row['email'];?></td>
                <td align="center"><input type="button" value="修改" value="" class="btn" onclick="editAdmin(<?php echo $row['id']; ?>)"><input type="button" value="删除" class="btn" onclick="delAdmin(<?php echo $row['id'];?>)"></td>
            <tr>
        <?php $i++; endforeach;?>
        <?php if($totalRows>$pageSize):?>
        <tr>
            <td colspan="4"><?php echo @showPage($page, $totalPage);?></td>
        </tr>
        <?php endif;?>
        </tbody>
    </table>
</div>
</body>
<script type="text/javascript">

	function addAdmin(){
		window.location="addAdmin.php";
	}
	function editAdmin(id){
		window.location="editAdmin.php?id="+id;
	}
	function delAdmin(id){
    	if(window.confirm("您确定要删除吗？删除之后不可以恢复哦！！！")){
    		window.location="doAdminAction.php?act=delAdmin&id="+id;
    	}
	}
</script>
</html>
