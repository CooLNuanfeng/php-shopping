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
