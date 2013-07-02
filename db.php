<?php

function db_connect () {
    
    $connect= do_mysqli_connect() or die ('I can not to connect to MySQL!');
    return $connect;
}

?>
