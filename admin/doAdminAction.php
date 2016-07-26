<?php
    require_once '../include.php';
    $act = $_REQUEST['act'];

    if($act == 'logout'){
        logout();
    }

    if($act == 'addAdmin'){
        $mes = addAdmin();
    }

    if($act == 'editAdmin'){
        $id = $_REQUEST['id'];
        $mes = editAdmin($id);
    }

    if($act == 'delAdmin'){
        $id = $_REQUEST['id'];
        $mes = deleteAdmin($id);
    }

    if($act == 'addCate'){
        $mes = addCate();
    }

    if($act == 'editCate'){
        $id = $_REQUEST['id'];
        $mes = editCate($id);
    }

    if($act=='delCate'){
        $id = $_REQUEST['id'];
        $mes = deleteCate($id);
    }

    if($act == 'addPro'){
        $mes = addPro();
    }

    if($act=='editPro'){
        $id = $_REQUEST['id'];
        $mes = editPro($id);
    }

    if($act=='delPro'){
        $id = $_REQUEST['id'];
        $mes = delPro($id);
    }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <?php
        echo $mes;
     ?>
</body>
</html>
