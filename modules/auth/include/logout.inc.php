<?php
	session_start();
    session_unset();	// Unset the variables
	session_destroy();	// Destroy the session
	
    // And redirect
    header("location: ../../../index.php");
    exit();
?>