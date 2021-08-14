<?php

if ( isset($_POST["submit"]) ) {
	
    // Get results from the post request

    $username = $_POST["name"];	// FULL NAME
    $uid = $_POST["uid"];		// Username
    $email = $_POST["email"];	// Email
    $pwd = $_POST["pwd"];		// Password
    $pwdre = $_POST["pwdrepeat"];	// Password repeated

    require_once '../../database/handlers/dbh.inc.php';	// include the database connection
    require_once 'form_handling.inc.php';	// and the error handler for the requests

    if ( empty_signup_form($username, $uid, $email, $pwd, $pwdre) !== false) {
        header('location: ../../../signup.php?error=emptysignup_input');
        exit();
    } else if ( invalid_uid($uid) !== false) {
		header('location: ../../../signup.php?error=invalid_uid');
        exit();
    } else if ( invalid_email($email) !== false) {
        header('location: ../../../signup.php?error=invalid_email');
        exit();
    } else if ( uid_exists($connection, $username, $email) !== false) {
        header('location: ../../../signup.php?error=ex_uid');
        exit();
    } else if ( password_rep($pwd, $pwdre) !== false) {
        header('location: ../../../signup.php?error=var_pass');
        exit();
    }

    // if everything is okay, sign the user up by creating it
    create_user($connection, $username, $uid, $email, $pwd);

} else {
    header("location: ../../../signup.php");
    exit();
}