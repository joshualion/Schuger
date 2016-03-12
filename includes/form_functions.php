<?php
function create_form_input($name, $type, $errors) {
//Check for and process the value:
$value = false;
if (isset($_POST[$name])) $value = $_POST[$name];
if ($value && get_magic_quotes_gpc( )) $value = stripslashes($value);
//Check the input type:
if ( ($type == 'text') || ($type == 'password') ) {
//Begin creating the input:
echo '<input type="' . $type . '" name="' . $name . '" id="' . $name . '"';
//Add the input’s value, if applicable:
if ($value) echo ' value="' . htmlspecialchars($value) . '"';
if (array_key_exists($name, $errors)) {
echo 'class="error" /> <span class="error">' . $errors[$name] .'</span>';
} else {
echo ' />';
}
} elseif ($type == 'textarea') {
//Display the error first:
if (array_key_exists($name, $errors)) echo ' <span class="error">' .$errors[$name] . '</span>';
//Start creating the textarea:
echo '<textarea name="' . $name . '" id="' . $name . '" rows="5" cols="75"';
//Add the error class, if applicable:
if (array_key_exists($name, $errors)) {
echo ' class="error">';
} else {
echo '>';
}
//Add the value to the textarea:
if ($value) echo $value;
//Complete the textarea:
echo '</textarea>';
//Complete the function:
} // End of primary IF-ELSE.
} // End of the create_form_input( ) function.

function get_password_hash($password) {
global $dbc;
return mysqli_real_escape_string ($dbc, hash_hmac('sha256', $password, 'c#haRl891', true));
}