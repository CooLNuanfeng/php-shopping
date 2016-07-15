<?php
    define("ROOT",dirname(__FILE__));
    echo PATH_SEPARATOR.'<br>';
    echo ROOT."<br>";
    echo get_include_path().'<br>';
    echo PATH_SEPARATOR.ROOT.'/lib'.PATH_SEPARATOR.ROOT.'/cores'.'<br>';

    session_start();


    $arr = array(
        'key1'=>'value1',
        'key2'=>'value2',
        'key3'=>'value3'
    );

    echo join(',',array_keys($arr)).'<br>';
    echo "'".join("','",array_values($arr))."'".'<br>';


    echo session_id().'===='.session_name().'<br>';
    $_SESSION['username']='blue';
    var_dump($_SESSION);
    session_destroy();
 ?>
