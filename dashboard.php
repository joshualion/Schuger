<?php # Script 18.5 - index.php
// This is the main page for the site.

// Include the configuration file:
require ('includes/config.php'); 

// Set the page title and include the HTML header:
$page_title = 'Welcome &rarr; '.SCHOOL_NAME.' Dashboard';
include ('includes/header.php');



//Redirect invalid user
if (!isset($_SESSION['user_id'])) {
	$url = BASE_URL . 'index.php'; // Define the URL.
	ob_end_clean(); // Delete the buffer.
	header("Location: $url");
	exit(); // Quit the script.	
}
// redirect administrators

if($_SESSION['user_level']==3){
$url = BASE_URL . 'admin.php'; // Define the URL.
	ob_end_clean(); // Delete the buffer.
	header("Location: $url");
	exit(); // Quit the script.	
}
// Welcome the user (by name if they are logged in):
echo '<h4>Welcome';
if (isset($_SESSION['first_name'])) {
	echo ", {$_SESSION['first_name']}";
}
echo '!</h4>';
//Display menu option
menu();
?>


<?php include ('includes/footer.php'); ?>