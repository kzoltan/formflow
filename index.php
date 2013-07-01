<?php  

error_reporting (E_ALL);
include 'helpers.php';
include 'defines.php';
include 'form.php';

//include database class
include 'database.class.php';


//instantiate new database
$database = new Database();

$database->$fields = 'hello';
print $database->$fields;

//objects
$database->__construct();

$query = $database->db_select('tablename')->fields('field names')->conditions('conditions')->execute();
echo "<pre>";
print $query;
echo "</pre>";

$result = $database->resultset();
echo "<pre>";
print $result;
echo "</pre>";


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



  
