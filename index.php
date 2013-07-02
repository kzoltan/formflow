<?php 

include 'helpers.php';
include 'form.php';

//do_mysqli_connect();
do_mysqli_connect() or die ('I can not to connect to MySQL!');

if(isset($_POST) && !empty($_POST['isPost'])) {
    
    $validate = validate_form($_POST);
    if ($validate === TRUE) {
	$save = saveFieldsInDB($_POST);
	if($save === TRUE) {
            print "User saved!";
            unset($_POST);
            do_mysqli_close();
	}
    }
    else{
        print $validate;
    } 
}
$fields = get_fields();
$form = get_form($fields);

print $form;

$build = render_form($form, $form_state);
print $build;

?>



  
