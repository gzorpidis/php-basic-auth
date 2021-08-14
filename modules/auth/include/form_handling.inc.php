<?php

// Return true (there is an error) if at least one field in the form was submitted as empty
// Else return false (no error)

function empty_signup_form($username, $uid, $email, $pwd, $pwdre) {
	
    if (empty($username) || empty($uid) || empty($email) || empty($pwd)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

// Return true (there is an error) if the uid is not valid
// Else return false (no error)

function invalid_uid($uid) {

    if (!preg_match("/^[a-zA-Z0-9]*$/",$uid)) {
        return true;
    } else {
        return false;
    }
}

// Return true (there is an error) if the email is not valid
// Else return false (no error)

function invalid_email($email) {
	
    if ( !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}

// Return true (there is an error) if the passwords are not the same
// Else return false (no error)

function password_rep($pwd, $pwdre) {

    if ( $pwd !== $pwdre) {
        return true;
    } else {
    	return false;
    }
}

// Return false if the user is not existent
// Else return the row that's in located in inside the DB

function uid_exists($connection, $uid, $email) {
    $sql = "SELECT * FROM users WHERE user_uid = ? OR user_email = ?;";
	$statement = mysqli_stmt_init($connection);
	
    if ( !mysqli_stmt_prepare($statement, $sql) ) {
        header('location: ../../../signup.php?error=stmt_fail');
        exit();
    }
	
    mysqli_stmt_bind_param($statement, "ss", $uid, $email);
    mysqli_stmt_execute($statement);

    $result = mysqli_stmt_get_result($statement);

	if ( $row = mysqli_fetch_assoc($result)) {
		return $row;
    } else {
        return false;
    }

    mysqli_stmt_close($statement);

}

// Register the user through the DB connection

function create_user($connection, $username, $uid, $email, $pwd) {

    $sql = "INSERT INTO users (user_username, user_uid, user_email, user_pwd, auth_hash, authenticated) VALUES (?,?,?,?,?,?);";
    $statement = mysqli_stmt_init($connection);
	
    if ( !mysqli_stmt_prepare($statement, $sql) ) {
        // if the statement cannot be established, throw error
        header('location: ../../../signup.php?error=stmt_fail');
        exit();

    } else {

        $auth_hash = md5( rand(0, 1000));	// in order to yield the authentication url
		$hashed_pwd = password_hash($pwd, PASSWORD_DEFAULT);	// hash the password using the password_hash php function
		$authenticated = 0;		// newly registered users are not authenticated by default
		
    	mysqli_stmt_bind_param($statement, "sssssi", $username, $uid, $email, $hashed_pwd, $auth_hash, $authenticated);
		mysqli_stmt_execute($statement);
    	mysqli_stmt_close($statement);

		// after the registration is completed, go back to the signup without an error set
    	header('location: ../../../signup.php?error=none');
    	exit();
    }
    
}

// Return true(there has been an error) if the login form has a empty field
// Else return (no error occured)

function empty_login_form($uid, $pwd) {
    if (empty($uid) || empty($pwd)) {
        return true;
    } else {
        return false;
    }
}

// LogIn the user through the DB connection

function login_user($connection,$uid, $pwd) {
	$uid_exists = uid_exists($connection, $uid, $uid);
	
    if ($uid_exists === false) {
        header('location: ../../../login.php?error=id_not_found');
        exit();
    } else {
        $pwd_hashed = $uid_exists['user_pwd'];
        $check_pwd = password_verify($pwd, $pwd_hashed);
        
        if ($check_pwd === false) {
            header('location: ../../../login.php?error=credential_mismatch');
            exit();
        } else {
            session_start();

            // Set session variables, UID will be used to fetch the data of the dashboard
			$_SESSION['id'] = $uid_exists['user_id'];
            $_SESSION['uid'] = $uid_exists['user_uid'];
			$_SESSION['loggedin'] = true;

            header('location: ../../../index.php');
            exit();
        }
    }
}

// Query to get basic info about the courses of a user
function get_common($connection, $id) {
	$sql = "SELECT * FROM courses WHERE of_user = ?;";
    $statement = mysqli_stmt_init($connection);
    
    if ( !mysqli_stmt_prepare($statement, $sql) ) {
        // if the statement cannot be established, throw error
        header('location: ./index.php?error=could_not_fetch_data');
        exit();

    } else {
		mysqli_stmt_bind_param($statement, "i", $id);
		mysqli_stmt_execute($statement);
		
    	$result = mysqli_stmt_get_result($statement);
    	mysqli_stmt_close($statement);
        return $result;
    }
}

function all_courses_of_id($connection, $id) {

	$result = get_common($connection, $id);
    echo "<ol>";
    while ($row = mysqli_fetch_assoc($result)) {        	
        printf("<li>\"%s\" by\t%s\tGrade: %d [\"%s\"]</li>", $row['course_name'], $row['course_instructor'], $row['course_grade'], $row['course_code']);
		echo "<br>";
    }
	echo "</ol>";
    
}

// Get the total ECTs of a user
function get_ects($result) {
    $sum = 0;
    foreach ($result as $row) {
        $sum += $row['course_ects'];
    }
    return $sum;
}
// Get sum of total completed (passed) courses
function get_completed_courses($result) {
	$iterator = 0;
    foreach ($result as $row) {
        $iterator++;
    }
    return $iterator;
}

// Get the GPA of the user (in DI format)
function get_gpa($result) {
    $upper_sum = 0;
    $downer_sum = 0;
    foreach ($result as $row) {
        $upper_sum += $row['course_ects'] * $row['course_grade'];
        $downer_sum += $row['course_ects'];
    }
	return ($downer_sum == 0) ? 0 : ($upper_sum / $downer_sum);
}

// Add course into the database
function add_course($connection, $course_name, $instructor_name, $ects, $course_semester, $course_grade, $course_fails, $course_code, $uid) {
    $sql = "INSERT INTO courses(course_name, course_instructor, course_ects, course_semester, course_grade, course_fails, course_code, of_user) VALUES (?,?,?,?,?,?,?,?);";
    $statement = mysqli_stmt_init($connection);
    

    if ( !mysqli_stmt_prepare($statement, $sql) ) {
        // If the statement cannot be established, throw error
        header('location: ../index.php?error=could_not_fetch_data');
        exit();

    } else {
		mysqli_stmt_bind_param($statement, "ssiiiisi", $course_name, $instructor_name, $ects, $course_semester, $course_grade, $course_fails, $course_code, $uid);
		mysqli_stmt_execute($statement);
    	mysqli_stmt_close($statement);
    }
}

// Delete course from the database
function delete_course($connection, $course_code, $uid) {
	$sql = "DELETE FROM courses WHERE of_user = ? AND course_code = ?;";
    $statement = mysqli_stmt_init($connection);

    if ( !mysqli_stmt_prepare($statement, $sql) ) {
        // if the statement cannot be established, throw error
        header('location: ../index.php?error=could_not_fetch_data');
        exit();

    } else {
		mysqli_stmt_bind_param($statement, "is", $uid, $course_code);
		mysqli_stmt_execute($statement);
    	mysqli_stmt_close($statement);

        header('location: ../../dashboard.php?error=del_none');
    }
}