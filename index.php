<?php  

error_reporting (E_ALL);
include 'helpers.php';
include 'defines.php';
include 'form.php';

//include database class
include 'database.class.php';

//instantiate new database
$database = new Database();

//objects
//$query = $database->db_select('tablename')->fields('fieldname')->condition('conditioname')->execute();
//echo "<pre>";
//print $query;
//echo "</pre>";

//select all
echo 'ok';
$database = db_select('users', 'u')
        ->fields('n')
        ->execute()
        ->fetchAllAssoc();
echo "<pre>";
print $database;
echo "</pre>";

/*
$query = db_select('table', 't');
$result = $query 
    ->fields()
    ->fields()
    ->execute();

foreach ($result as $row) {
    //do something with $row
}
*/

$fields = get_fields();
$form = get_form($fields);

print $form;

if (isset($_POST) && !empty($_POST['isPost'])) {
    $validate = validate_form($_POST);
    if ($validate === TRUE) {
        submit_form($_POST);
    }
    else {
        print $validate;
    }
}

$build = render_form($form, $validate);
print $build;

?>



  
