<?php 
// This is the registration page for the system.
require ('includes/config.php');
$page_title = 'Register';
include ('includes/header_front.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Handle the form.

	// Need the database connection:
	require(MYSQL);
	
	// Trim all the incoming data:
	$trimmed = array_map('trim', $_POST);

	// Assume invalid values:
	$fn = $ln = $e = $p = $ul= FALSE;
	
	// Check for a first name:
	if (preg_match ('/^[A-Z \'.-]{2,20}$/i', $trimmed['first_name'])) {
		$fn = mysqli_real_escape_string ($dbc, $trimmed['first_name']);
	} else {
		echo '<p class="error">Please enter your first name!</p>';
	}

	// Check for a last name:
	if (preg_match ('/^[A-Z \'.-]{2,40}$/i', $trimmed['last_name'])) {
		$ln = mysqli_real_escape_string ($dbc, $trimmed['last_name']);
	} else {
		echo '<p class="error">Please enter your last name!</p>';
	}
	
	// Check for an email address:
	if (filter_var($trimmed['email'], FILTER_VALIDATE_EMAIL)) {
		$e = mysqli_real_escape_string ($dbc, $trimmed['email']);
	} else {
		echo '<p class="error">Please enter a valid email address!</p>';
	}

	// Check for a password and match against the confirmed password:
	if (preg_match ('/^\w{6,20}$/', $trimmed['password1']) ) {
		if ($trimmed['password1'] == $trimmed['password2']) {
			$p = mysqli_real_escape_string ($dbc, $trimmed['password1']);
		} else {
			echo '<p class="error">Your password did not match the confirmed password!</p>';
		}
	} else {
		echo '<p class="error">Please enter a valid password! <br/>Minimum of six characters is required.</p>';
	}
	
	// Check for a user level:
	if ($trimmed['user_level']) {
		$ul = mysqli_real_escape_string ($dbc, $trimmed['user_level']);
	} else {
		echo '<p class="error">You forgot to select who you are!</p>';
	}
	
	
	if ($fn && $ln && $e && $p && $ul) { // If everything's OK...

		// Make sure the email address has not been used by another user:
		$q = "SELECT user_id FROM users WHERE email='$e'";
		$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
		
		if (mysqli_num_rows($r) == 0) { // Available.

			// Create the activation code:
			$a = md5(uniqid(rand(), true));

			// Add the user to the database:
			$q = "INSERT INTO users (email, pass, first_name, last_name, active, user_level, registration_date) VALUES ('$e', SHA1('$p'), '$fn', '$ln', '$a', '$ul', NOW() )";
			$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));

			if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.

				// Send the email:
				$body = "Thank you for registering at <whatever site>. To activate your account, please click on this link:\n\n";
				$body .= BASE_URL . 'activate.php?x=' . urlencode($e) . "&y=$a";
				mail($trimmed['email'], 'Registration Confirmation', $body, 'From: admin@sitename.com');
				
				// Finish the page:
				echo '<h3 style="color:rgba(97,160,27,1);" class="success"><img src="includes/images/tick.png"/>Thank you for registering! A confirmation email has been sent to your address. Please click on the link in that email in order to activate your account.</h3><p align="right"><a href="logout.php"><img src= "includes/images/login.png"/></a></p>';
				include ('includes/footer.php'); // Include the HTML footer.
				exit(); // Stop the page.
				
			} else { // If it did not run OK.
				echo '<p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>';
			}
			
		} else { // The email address is not available.
			echo '<p class="error">That email address has already been registered. If you have forgotten your password, use the link at right to have your password sent to you.</p>';
		}
		
	} else { // If one of the data tests failed.
		echo '<p class="error">Please try again.</p>';
	}

	mysqli_close($dbc);

} // End of the main Submit conditional.
?>
	
<h1>Register</h1><hr>
<form action="register.php" method="post" class="form2">
	<fieldset>
	  <table width="852" border="0" cellspacing="20">
	  <tr>
	    <td >&nbsp;</td>
	    <td ><b>First Name:</b></td>
	    <td><label for="fname">
	      <input  type="text" name="first_name" id="fname" size="120" maxlength="20" value="<?php if (isset($trimmed['first_name'])) echo $trimmed['first_name']; ?>" />
        </label></td>
	    </tr>
	  <tr>
	    <td>&nbsp;</td>
	    <td><label for="lname2"><b>Last Name:</b></label></td>
	    <td>
	      <input  type="text" name="last_name" id="lname" size="20" maxlength="40" value="<?php if (isset($trimmed['last_name'])) echo $trimmed['last_name']; ?>" />
	   </td>
	    </tr>
	  <tr>
	    <td>&nbsp;</td>
	    <td><label for="email2"><b>Email Address:</b></label></td>
	    <td>
	      <input type="text" id="email" name="email" size="30" maxlength="60" value="<?php if (isset($trimmed['email'])) echo $trimmed['email']; ?>" />
	    </td>
	    </tr>
	  <tr>
	    <td>&nbsp;</td>
	    <td><b>Password </b></td>
	    <td>
	      <input type="password" id="pass1" name="password1" size="20" min="6" maxlength="20" value="<?php if (isset($trimmed['password1'])) echo $trimmed['password1']; ?>" />
	    </td>
	    </tr>
	  <tr>
	    <td>&nbsp;</td>
	    <td><b>Confirm password:</b></td>
	    <td>
	      <input type="password" name="password2" id="pass2" size="20" min="6" maxlength="20" value="<?php if (isset($trimmed['password2'])) echo $trimmed['password2']; ?>" />
	    </td>
	    </tr>
	  <tr>
	    <td>&nbsp;</td>
	    <td><b>I am a </b></td>
	    <td><select name="user_level">
	      <option>---select---</option>
	      <option value="1">Student</option>
	      <option value="2">Teacher</option>
        </select></td>
	    </tr>
	  <tr>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td><input class="submit" type="submit" name="submit" value="Register &darr;" /></td>
	    </tr>
	  </table>
	<p>&nbsp;</p>
	</fieldset>
</form>

<?php include ('includes/footer.php'); ?>
