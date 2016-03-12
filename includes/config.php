<?php 
/* This script:
 * - define constants and settings, dictates how errors are handled, defines useful functions
 * - Authors name: Joshua Ekpe
 * - Founder Diginet technologies
*/

// ********************************** //
// ************ SETTINGS ************ //

// Flag variable for school name:
define('SCHOOL_NAME', 'schuger');

// Flag variable for site status:
define('LIVE', FALSE);

// Admin contact address:
define('EMAIL', 'joshuadiginettechnologies.com');

// Site URL (base for all redirections):
define ('BASE_URL', ' ');

// Location of the MySQL connection script:
define ('MYSQL', ' ');

// Adjust the time zone for PHP 5.1 and greater:
date_default_timezone_set ('US/Eastern');

// ****************************************** //
// ************ ERROR MANAGEMENT ************ //

// Create the error handler:
function my_error_handler ($e_number, $e_message, $e_file, $e_line, $e_vars) {

	// Build the error message:
	$message = "An error occurred in script '$e_file' on line $e_line: $e_message\n";
	
	// Add the date and time:
	$message .= "Date/Time: " . date('n-j-Y H:i:s') . "\n";
	
	if (!LIVE) { // Development (print the error).

		// Show the error message:
		echo '<div class="error">' . nl2br($message);
	
		// Add the variables and a backtrace:
		echo '<pre>' . print_r ($e_vars, 1) . "\n";
		debug_print_backtrace();
		echo '</pre></div>';
		
	} else { // Don't show the error:

		// Send an email to the admin:
		$body = $message . "\n" . print_r ($e_vars, 1);
		mail(EMAIL, 'Site Error!', $body, 'From: info@diginettechnologies.com');
	
		// Only print an error message if the error isn't a notice:
		if ($e_number != E_NOTICE) {
			echo '<div class="error">A system error occurred. We apologize for the inconvenience.</div><br />';
		}
	} // End of !LIVE IF.

} // End of my_error_handler() definition.

// Use my error handler:
set_error_handler ('my_error_handler');

// ************ ERROR MANAGEMENT ************ //
// ****************************************** //


//***************Date Management***********//
function calendar(){
	//create an array of days
	$days = range(1,31);
	
	//create an array of months
	$months = array (1 => 'January','February', 'March', 'April','May', 'June', 'July', 'August','September', 'October','November', 'December');
	
	//create an array of years
	$years = range (1955, 2025);
	
	
	//Generate the day 
echo '<select name="day">' . 'Day';
foreach ($days as $value) {
echo "<option value=\"$value\">$value</option>\n";
}
echo '</select>'.'<br/> ';

	
	//Generate the month pull-down menu:
echo '<select name="month">'.'Month ';
foreach ($months as $key => $value) {
echo "<option value=\"$key\"> $value </option>\n";
}
echo '</select>'.'<br/> ';


//Generate the year pull-down menus:
echo '<select name="year">'. 'Year';
foreach ($years as $value) {
echo "<option value=\"$value\">$value</option>\n" ;
}
echo '</select>'.' ';	
	
}//end of date management function


//******MENU MANAGEMENT********//
 function menu(){
	 
	echo '<div align="center" class="Menu">';

	// This function completes the HTML template.

/*Display links based upon the login status:*/
	
	// Add links if the user is a student:
	if (isset($_SESSION['user_id'])) {
		
		// Add links if the user is a student:
		if ($_SESSION['user_level'] == 1) {

		echo '<table border="0" width="80%" cellpadding="10">
		<tr>
		<td><a href="student_profile.php" ><img src="includes/images/profile.png" title="Edit Your Profile" width="200px" height="200px"/><br/><h4>Your Profile</h4></a></td>
        <td><a href="check_result.php"><img src="includes/images/bg2.png" title="check results" width="200px" height="200px"/><br/><h4>Check Results</h4></a></td>
		<td><a href="#"><img src="includes/images/register.png" title="This feature is disable in the free version of Schuger" width="200px" height="200px"  ;"/><br><h4>Course Registration</h4></a></td>
		
		<td><a href="#"><img src="includes/images/club.png" title="This feature is disable in the free version of Schuger"  width="200px" height="200px" onMouseOver"Join school club"/><br><h4>Club Activity</h4></a></td></tr>
	    <tr>
		<td><a href="#"><img src="includes/images/payment.png" title="This feature is disable in the free version of Schuger"  width="200px" height="200px"/><br><h4>Fee Payment<h4></a></td>
	
		<td><a href="social.php"><img src="includes/images/social.png" title=" Visit School Social pages " width="200px" height="200px" onMouseOver"Join us now"/><br/><h4>School Network</h4></a></td>
		
		<td><a href="chat.php" ><img src="includes/images/chat.png" title="chat with your school mate" width="200px" height="200px"/><br/><h4>Discussion Board</h4></a></td>
		
		<td><a href="help.php"><img src="includes/images/Help.png" title="Need Help? Contact administrator" width="200px" height="200px"/><br><h4>Contact Administrator</h4></a></td>
		</tr>
		</table>
    	';
		}
		
			// Add links if the user is a teacher:
		if ($_SESSION['user_level'] == 2) {
			echo '<table border="0" width="80%" cellpadding="10">
		<tr>
			<td><a href="profile.php" ><img src="includes/images/profile.png" title="Edit Your Profile" width="200px" height="200px"/><br/><h4 align="left">Your Profile</h4></a></td>
			<td><a href="#" ><img src="includes/images/broadsheet.png" title="Generate broadsheet on the fly" width="200px" height="200px"/><br/><h4>Generate Broadsheet</h4></a></td>
			<td><a href="process_result.php" ><img src="includes/images/result.png" title="process students results" width="200px" height="200px"/><br/><h4>Process Results</h4></a></td>
		</tr>
		<tr>
			<td><a href="#"><img src="includes/images/dairy.png" title="Fill Dairy" width="200px" height="200px"/><br/><h4>School Dairy</h4></a></td>
			<td><a href="#"><img src="includes/images/sms.png" title="Send SMS Notification to Students" width="200px" height="200px"/><br/><h4>Send SMS</h4></a></td>
		    <td><a href="help.php"><img src="includes/images/Help.png" title="Need Help? Contact administrator" width="200px" height="200px"/><br/><h4>Contact Administrator</h4></a></td>
		
		</tr>
		<tr>
		    </tr>
		</table>
		
		';
		}

		// Add links if the user is an administrator:
		if ($_SESSION['user_level'] == 3) {
			echo '
			<a href="admin_profile.php" ><img src="includes/images/profile.jpg" title="Edit Your Profile" width="200px" height="200px"/></a>
			<a href="settings.php" title="Genneral setting">General Settings</a><br />
			<a href="view_all_student.php" title="View All Users">View All Students</a><br />
			<a href="view_all_student.php" title="View All Users">View All Teachers</a><br />
		    <a href="read_message.php">Message</a><br />
		';
		}
	
	} else { //  Not logged in.
	
	}
	
	echo '</div><!-- Menu -->';
	
}//end menu function

//*****MENU MANAGEMENT*********//






