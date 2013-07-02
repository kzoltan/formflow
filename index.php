<?php 

include 'helpers.php';

//do_mysqli_connect();
do_mysqli_connect() or die ('I can not to connect to MySQL!');

function createInput($type, $name, $value = '', $label = '', $id = null, $pre = null, $post = null, $required = '', $validate = '') {

	global $gender;
	
	$idStr = $id?'id="'.$id.'"':'';
	$out = '<label>'.$label.'</label>';
	
	switch($type) {
		case 'radio':
			$vals = explode(',', $value);
			foreach($vals as $val) {
				$out .= '<label>'.$pre.$gender[$val].'<input type="'.$type.'" name="'.$name.'" value="'.$val.'" />'.$post.'</label>';
			}
			break;
		case 'textarea':
			$out .= $pre.'<textarea name="'.$name.'">'.$value.'</textarea>'.$post;
			break;
		case 'submit':
		case 'text':
		case 'password':
		default:
			$out .= $pre.'<input type="'.$type.'" name="'.$name.'" value="'.$value.'" '.$idStr.' />'.$post;
			break;
	}
	
	$out .= '<br />';
	return $out;
}


function get_fields() {

	$fields[] = array('type'=>'text', 'name'=>'username', 'value'=>@$_POST['username'], 'label'=>'Username:', 'required' => TRUE, 'validate' => usernameExist($post['username']));
	$fields[] = array('type'=>'text', 'name'=>'firstname', 'value'=>@$_POST['firstname'], 'label'=>'First Name:', 'required' => TRUE);
	$fields[] = array('type'=>'text', 'name'=>'email', 'value'=>@$_POST['email'], 'label'=>'Email:', 'required' => TRUE, 'validate' => validemail($post['email']));
	$fields[] = array('type'=>'password', 'name'=>'password', 'value'=>'', 'label'=>'Password:', 'required' => TRUE);
	$fields[] = array('type'=>'radio', 'name'=>'gender', 'value'=>'1,2,3', 'label'=>'Gender:', null, '<label>', '</label>', 'required' => TRUE);
	$fields[] = array('type'=>'textarea', 'name'=>'description', 'value'=>@$_POST['description'], 'label'=>'Description:', 'required' => FALSE);
	$fields[] = array('type'=>'submit', 'name'=>'save', 'value'=>'Save', 'label'=>'');
	
	return $fields;
}


function get_form($fields) {
	$inputs = array();
	if(count($fields)) {
		foreach($fields as $field) {
			$inputs[] = createInput($field['type'], $field['name'], $field['value'], $field['label'], $fields['required'], $fields['validate']);
		}
	}
	
	$form = array(
		'inputs' => $inputs,
		'method' => 'POST',
    'title' => 'User registration',
		);
	
  return $form;
}

function submit_form()
{
  $save = saveFieldsInDB($_POST);
	if($save===true) {
		print "User saved.";
		unset($_POST);
		do_mysqli_close();
	}
	else{
		print "Fill all required fields!";
	}
}

function saveFieldsInDB($post) {

	// insert into db;
	
	//set time
	//$time = time("H:i:s");
	$time = date('Y-m-d');
	$date = date('H:i:s');
	
	$query = 'INSERT INTO `users` 
		(`username`, `firstname`, `email`, `gender`, `description`, `password`, `lastlogin`, `registred`) 
		VALUES ("' . db_escape_string($post['username']).'", "'.db_escape_string($post['firstname']).'", "'.db_escape_string($post['email']).'",
		'.$post['gender'].', "'.db_escape_string($post['description']).'", "'.md5($post['password']).'", "'.$time.'", "'.$date.'")';
		
	if(db_query($query)) {
		return true;
	}
	return false;
}

function render_form($form, $form_state){

  
  $outHTML = '<form action="" method="POST">'.implode('', $inputs).'</form>';
	return $outHTML;
}


$fields = get_fields();
$form = get_form($fields);
$form_state = array();

if (isset($_POST)) 
{
  $form_state = validate_form($_POST);
  if ($form_state['is_valid']) 
  {
    submit_form($_POST);
  }
}

$build = render_form($form, $form_state);
print $build;
?>



  
