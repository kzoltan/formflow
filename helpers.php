<?php 

include 'defines.php';
function do_mysqli_connect($server = 'localhost', $user = __DB_USER, $pass = __DB_PASS, $dbname = __DB_NAME) {
    global $db;
    $db = mysqli_connect($server, $user, $pass);
    if (!$db) {
        error_log('Database connection error occuerd (#' . mysqli_errno($db) . ')');
        show_offline();
    }
    mysqli_query($db, "SET NAMES 'utf8'");
    mysqli_query($db, "SET CHARACTER SET 'utf8'");
    mysqli_query($db, "SET character_set_connection = 'utf8'");
    mysqli_set_charset($db, "utf8");

    mysqli_select_db($db, $dbname);

    return $db;
}

/*
 * Close an estabilished database connection
 */

function do_mysqli_close() {
    global $db;
    mysqli_close($db);
}

/*
 * Execute mysql query
 */

function db_query($query) {
    //print_r($db);
    global $db;
    return mysqli_query($db, $query);
}

/*
 * Fetch query results
 */

function db_fetch_array($results) {
    global $db;
    return mysqli_fetch_assoc($results);
}

/*
 * Mysql escape string
 */

function db_escape_string($string) {
    global $db;
    return mysqli_real_escape_string($db, $string);
}

function usernameExist($username) {
	$query = 'SELECT COUNT(`id`) AS `count` FROM `users` WHERE `username`="'.$username.'"';
	$res = db_fetch_array(db_query($query));
	return ($res['count']>0)?true:false;
}

function validemail($email) {
	return (bool) filter_var($email, FILTER_VALIDATE_EMAIL);
}
?>