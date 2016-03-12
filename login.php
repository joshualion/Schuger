<?php # - login.php
require('includes/config.php'); 
$page_title = 'Login To '.SCHOOL_NAME;
include('includes/header_front.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	require(MYSQL);
	
	// Validate the email address:
	if (!empty($_POST['email'])) {
		$e = mysqli_real_escape_string ($dbc, $_POST['email']);
	} else {
		$e = FALSE;
		echo '<center class="container"><p class="error">You forgot to enter your email address!</p></center>';
	}
	
	// Validate the password:
	if (!empty($_POST['pass'])) {
		$p = mysqli_real_escape_string ($dbc, $_POST['pass']);
	} else {
		$p = FALSE;
		echo '<center class="container"><p class="error">You forgot to enter your password!</p></center>';
	}
	

	
	if ($e && $p) { // If everything's OK.

		// Query the database:
		$q = "SELECT user_id, first_name, last_name, email, user_level FROM users WHERE (email='$e' AND pass=SHA1('$p')) AND active IS NULL";		
		$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
		
		if (@mysqli_num_rows($r) == 1) { // A match was made.

			// Register the values:
			$_SESSION = mysqli_fetch_array ($r, MYSQLI_ASSOC); 
			mysqli_free_result($r);
			
							
			// Redirect the user:
			$url = BASE_URL . 'dashboard.php'; // Define the URL.
			ob_end_clean(); // Delete the buffer.
			header("Location: $url");
			exit(); // Quit the script.
				
		} else { // No match was made.
			echo '<p class="error">Either the email address and password entered do not match those on file or you have not yet activated your account.<br/> <a href="forgot_password.php" title="Password Retrieval">Retrieve Password</a></p>';
		}
		
	} else { // If everything wasn't OK.
		echo '<center class="container"><p class="error">Please try again.</p></center>';
	}
	
	mysqli_close($dbc);

} // End of SUBMIT conditional.
?>
<p align="center"><a href="index.php" ><img src="includes/images/schugerlogo1.png" width="200" height="150"/></a><p>
<div class="form" >
 <h1 style="color:#fff;">Login</h1>
<form action="login.php" method="post">
	<fieldset>
   <h4><p align="right"><span style ="color:rgba(255,252,185,1); align:right;"></span> <a href="register.php" target="new">Sign Up</a> </p></h4><hr/>
	<div align="center" > <input type="text" name="email" size="10" maxlength="60" placeholder="Enter Email Address" /></div><br/>
	<div align="center"><input type="password" name="pass" size="10" maxlength="20" placeholder=" Enter Password" /></div><br/>
   <!-- <div align="center"><input name="user_level" type="radio" value="1"><b>Students </b><input name="user_level" type="radio" value="2"><b>Teacher</b></div><br/>
	--><div align="CENTER"><input class="submit" type="submit" name="submit" value="Login &rarr;" /></div>
    </fieldset>
</form>

</div>
<?php include ('includes/footer.php'); ?>