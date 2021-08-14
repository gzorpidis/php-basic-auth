<?php
// If a form was submitted to gain access, then authenticate
// Else send to LogIn Page
if (isset($_POST["submit"])) {

    $uid = $_POST['uid'];
    $pwd = $_POST['pwd'];

    require_once '../../database/handlers/dbh.inc.php';
    require_once 'form_handling.inc.php';

    if ( empty_login_form($uid, $pwd) !== false) {
        header('location: ../../../login.php?error=emptylogin_input');
        exit();
    }

	login_user($connection, $uid, $pwd);
	
} else {
    header('location: ../../../login.php');
    exit();
}