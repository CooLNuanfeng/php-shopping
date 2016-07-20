<?php
    require_once "../include.php";
    $pageSize = 3;
    $sql = "select * from imooc_cate";
    $totalRows = getResultNum($sql);
    @$page = $_REQUEST['page'] ? (int)$_REQUEST['page'] : 1;
    $totalPage = ceil($totalRows/$pageSize);
    $offset = ($page-1) * $pageSize;
    if($page<1||$page==null||!is_numeric($page)){
        $page =1;
    }
    if($page>$totalPage){
        $page = $totalPage;
    }


    $sql = "select id,cName from imooc_cate order by id limit $offset,$pageSize";
    @$rows = fetchAll($sql);
    if(!$rows){
        alertMeg('请先添加分类','addCate.php');
        exit;
    }


 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>分类列表页</title>
    <link rel="stylesheet" href="styles/backstage.css">
</head>
<body>
    <div class="details">
        <div class="details_operation clearfix">
            <div class="bui_select">
                <input type="button" value="添&nbsp;&nbsp;加" class="add"  onclick="addCate()">
            </div>
        </div>
        <!--表格-->
        <table class="table" cellspacing="0" cellpadding="0">
            <thead>
                <tr>
                    <th width="15%">编号</th>
                    <th width="55%">分类名称</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
            <?php $i=1; foreach($rows as $row):?>
                <tr id="<?php echo $i;?>">
                    <td><input type="checkbox" class="check" id="c1"><label for="c1" class="label"><?php echo $row['id']; ?></label></td>
                    <td><?php echo $row['cName'];?></td>
                    <td align="center"><input type="button" value="修改" value="" class="btn" onclick="editCate(<?php echo $row['id']; ?>)"><input type="button" value="删除" class="btn" onclick="delCate(<?php echo $row['id'];?>)"></td>
                <tr>
            <?php $i++; endforeach;?>
            <?php if($totalRows>$pageSize):?>
            <tr>
                <td colspan="3"><?php echo @showPage($page, $totalPage);?></td>
            </tr>
            <?php endif;?>
            </tbody>
        </table>
    </div>
</body>
<script>
    function addCate(){
        window.location = 'addCate.php';
    }
    function editCate(id){
        window.location = 'editCate.php?id='+id;
    }
    function delCate(id){
        if(confirm('确定要删除吗')){
            window.location = 'doAdminAction.php?act=delCate&id='+id;
        }
    }
</script>
</html>
