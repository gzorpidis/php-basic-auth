<?php 
	// include the header code, with meta tags and navbar
	include_once 'modules/components/header.php'
?>
<div id="main-view" style="
    height: calc(100vh - 50px);
    background-color: tomato;
    width: 100%;
    color: white;
    display: flex;
    align-items: center;
    text-align: center;
	overflow-x: hidden;
	flex-direction: column;"
	>
<?php 
	// personalised index using session variables!
	if (isset($_SESSION['uid'])) {	// if the session variable has been set, a login has been detected
		echo "<h2>Hi ". $_SESSION['uid']."!Glad to see you here!</h2>";
	} else {	// else no log in
		echo "<h2>Hi stranger! Log In or Sign Up to view your dashboard!</h2>";
	}

?>
<img src="./img/desert.svg" id="desert">

</div>

<div>
	<?php 
		include_once 'modules/database/handlers/dbh.inc.php';
		include_once 'modules/auth/include/form_handling.inc.php';
			
		if (isset($_SESSION['id'])) {
			all_courses_of_id($connection, $_SESSION['id']);
		}
	?>
</div>
<?php 
	// include the footer code, which closes the website
  include_once 'modules/components/footer.php' 
?>