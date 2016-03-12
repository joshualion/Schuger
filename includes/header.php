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
    <link href="includes/javascript/bootstrap.js"  rel="script"     type="text/javascript"/>
    <link rel="stylesheet" href="includes/css/styles.css">
	<link href="includes/css/portal.css"    rel="stylesheet" type="text/css">
    <link href="includes/css/jquery-ui.css" rel="stylesheet" type="text/css">
     <script src = "includes/javascript/jquery.js"></script>
      <script src = "includes/javascript/jquery-ui.js"></script>
      <script src = "includes/javascript/jquery-idleTimeout.js"></script>
     
		
      <script>
         $(function() {
            $( "#tabs-9" ).tabs({
               event:"click"
            });
         });
      </script>
		
      <style>
         #tabs-9{font-size: 14px;}
         .ui-widget-header {
            background:#02623E;
            border: 1px solid #02623E;
            color: #FFFFFF;
            font-weight: bold;
         }
      </style>
   
    <script type="text/javascript">
	$(document).ready(function(){
    $(document).idleTimeout({
      inactivity: 30000,
      noconfirm: 10000,
      sessionAlive: 10000
    });
  });
	</script>
 
	
</head>
<body>
<div class="header"><h1><?php echo SCHOOL_NAME ; ?></h1><br/><p><small>Powered by GNSOP</small></p><hr></div>
<hr>
   <div class="container"> <!-- End of Header -->