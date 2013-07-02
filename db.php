<?php

function db_connect () {
    
    $connect = do_mysqli_connect() or die ('I can not to connect to MySQL!');
    return $connect;
}

function db_disconnect () {
    $disconnect = do_mysqli_close();
    return $disconnect;
}

/*
function db_select () {
    $dbname = __DB_NAME;
    $connect = db_connect();
    $select = mysqli_select_db($dbname, $connect);
    //echo 'OK';
    return $select;
    
    //$query = "SELECT * FROM `users` WHERE `id` ='".$_POST['id']."'"; 
}
*/
?>
