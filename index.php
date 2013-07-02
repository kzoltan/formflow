<?php  
error_reporting (E_ALL);
include 'helpers.php';
include 'form.php';
include 'db.php';

db_connect();
//db_select();

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



  
