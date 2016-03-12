
<!-- Start of Footer -->

</div><!-- end container div -->
<div class="menu">
<?php
// Add links back and logut links:
	if (isset($_SESSION['user_id'])) {
 // Include logout button
 echo '<p ><a href="dashboard.php" title="Return to Dashboard" ><img src= "includes/images/back.png" /></a>'.'<a href="logout.php" title = "Logout" ><img src= "includes/images/logout.png" align ="right"/></a></p>';
	}
?>
</div>
<hr/><footer>
  <p align="center"><br/> 
    <a href="terms.php">Terms</a> of service | 
    <a href="www.gnsop.org/privacy">privacy</a> policy |  
    <a href="www.gnsop.org/cookies">cookie</a> policy |
     <br/>&copy; <a href="www.dnt.com.ng">Diginet</a> Technologies 2015 <br/>
  </p>
</footer>
</body>
</html>
<?php // Flush the buffered output.
ob_end_flush();
?>