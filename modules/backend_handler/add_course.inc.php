<?php

if ( isset($_POST["submit"]) ) {
	
    // Get results from the post request
	session_start();

    $course_name = $_POST["course-name"];
    $instructor_name = $_POST["instructor-name"];	
    $ects = $_POST["ects"];
    $course_code= $_POST["course-code"];		
    $course_fails = $_POST["course-fails"];
    $course_grade = $_POST["course-grade"];	
    $course_semester = $_POST["course-semester"];
    $uid = $_SESSION['id'];


    require_once '../database/handlers/dbh.inc.php';	// include the database connection
    require_once '../auth/include/form_handling.inc.php';	// and the error handler for the requests
	    
    add_course($connection, $course_name, $instructor_name, $ects, $course_semester, $course_grade, $course_fails, $course_code, $uid);
    // if ( empty_signup_form($username, $uid, $email, $pwd, $pwdre) !== false) {
    //     header('location: ../../../signup.php?error=emptysignup_input');
    //     exit();
    // } else if ( invalid_uid($uid) !== false) {
	// 	header('location: ../../../signup.php?error=invalid_uid');
    //     exit();
    // } else if ( invalid_email($email) !== false) {
    //     header('location: ../../../signup.php?error=invalid_email');
    //     exit();
    // } else if ( uid_exists($connection, $username, $email) !== false) {
    //     header('location: ../../../signup.php?error=ex_uid');
    //     exit();
    // } else if ( password_rep($pwd, $pwdre) !== false) {
    //     header('location: ../../../signup.php?error=var_pass');
    //     exit();
    // }
	
	// If we get here, the course was added successfully	
    header('location: ../../dashboard.php?error=add_none');    
    exit();
} else {
    header("location: ../../index.php?error=not_authorized");
    exit();
}