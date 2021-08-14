<?php
if (!isset($_SESSION))
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="utf-8">
  <title>Something!</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../../css/signup.css?v=<?php echo time(); ?>">

  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  </head>

  <body>
  <style>
    <?php include './css/signup.css' ?>
  </style>
    
  <!-- BEGIN of the Navbar -->

  <div class="nav">
  <input type="checkbox" id="nav-check">
  <div class="nav-header">
    <div class="nav-title">
      <a href="index.php">StudyMate</a>
    </div>
  </div>
  <div class="nav-btn">
    <label for="nav-check">
      <span></span>
      <span></span>
      <span></span>
    </label>
  </div>
  
  <div class="nav-links">
      <a href="dashboard.php" >My Dashboard</a>
      <a href="about.php" >About</a>
      <?php 
      	if (!isset($_SESSION['id']) && !isset($_SESSION['uid'])) {
					echo "<a href=\"login.php\" >Log In</a>";
        	echo "<a href=\"signup.php\" >Sign Up</a>";
        } else {
			echo "<a href=\"profile.php\">Profile</a>";
			echo "<a href=\"./modules/auth/include/logout.inc.php\">Log Out</a>";
        }
      ?>
      
  </div>
</div>