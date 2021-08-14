<?php 
	session_start();		// We need to check for the session, so we initialize session

	if(isset($_SESSION['id']))	// If the user is logged in, display the appropriate dashboard
		include_once './modules/components/dashboard_display.php';
	else {
    	header('location: login.php?error=need_login');	// Else redirect him to the login page
    	exit();
	}
?> 