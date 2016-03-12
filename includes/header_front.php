<?php # - header.html
// This page begins the HTML header for the site.

// Start output buffering:
ob_start();

// Initialize a session:
session_start();

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<title> <?php echo $page_title; ?> </title>
	<link href="includes/css/bootstrap.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="includes/css/styles.css">
	<link href="includes/css/portal.css"    rel="stylesheet" type="text/css">
    <link href="includes/css/jquery-ui.css" rel="stylesheet" type="text/css">
     <script src = "includes/javascript/jquery.js"></script>
     <link href="includes/javascript/bootstrap.js"  rel="script"     type="text/javascript"/>
      <script src = "includes/javascript/jquery-ui.js"></script>
     
 
	
</head>
<body>
<body>
<div class="header"><h1><?php echo SCHOOL_NAME ; ?></h1><br/><p><small>Powered by GNSOP</small></p><hr></div>
<hr>
   <div class="container"> <!-- End of Header -->