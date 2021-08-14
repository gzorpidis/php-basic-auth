<?php 
	include_once 'modules/components/header.php';
?>
	
    <main class="my-form">
    	<div class="container">
        <div class="reg-state">
<?php 
	if (isset($_GET["error"])) {
        // echo "<p>In here!</p>";
        if ( $_GET['error'] == "emptysignup_input") {
            echo "<h3 id=\"reg_success\" style=\"color: #c92c2c;font-size: 26px;font-weight: bold;text-alignment:center;\">
            Registration Failed!
            </h3>";
        	echo "<h5 id=\"reg_fail\">
            Please fill in all the required information!
            </h5>";
        } 
        else if ( $_GET['error'] == "invalid_email") {
            echo "<h3 id=\"reg_success\" style=\"color: #c92c2c;font-size: 26px;font-weight: bold;text-alignment:center;\">
            Registration Failed!
            </h3>";
        	echo "<h5 id=\"reg_fail\">
            Email is invalid!
            </h5>";
        }
        else if ( $_GET['error'] == "password_rep") {
        	echo "<h3 id=\"reg_success\" style=\"color: #c92c2c;font-size: 26px;font-weight: bold;text-alignment:center;\">
            Registration Failed!
            </h3>";
        	echo "<h5 id=\"reg_fail\">
            Passwords do not match!
            </h5>";
        }
        else if ( $_GET['error'] == "invalid_uid") {
        	echo "<h3 id=\"reg_success\" style=\"color: #c92c2c;font-size: 26px;font-weight: bold;text-alignment:center;\">
            Registration Failed!
            </h3>";
        	echo "<h5 id=\"reg_fail\">
            Invalid username. Please enter appropriate characters!
            </h5>";
        }
        else if ( $_GET['error'] == "uid_exists") {
        	echo "<h3 id=\"reg_success\" style=\"color: #c92c2c;font-size: 26px;font-weight: bold;text-alignment:center;\">
            Registration Failed!
            </h3>";
        	echo "<h5 id=\"reg_fail\">
            Username already exists. Try an other one!
            </h5>";
        }
        else if ( $_GET['error'] == "none") {
            echo "<h3 id=\"reg_success\" style=\"color: #2dba50;font-size: 26px;font-weight: bold;text-alignment:center;\">
            Registration Succesfull!
            </h3>";
            echo "<h5 id=\"reg_fail\">
            You can now log in!
            </h5>";
        }
    }
?>
</div>
        	<div class="row justify-content-center">
            	<div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Register</div>
                        <div class="card-body">
                        	<!-- include if you want: onsubmit="return validform()"right below, into form -->
                            <form name="singup-form" action="modules/auth/include/signup.inc.php" method="post">
                                <div class="form-group row">
                                    <label for="full_name" class="col-md-4 col-form-label text-md-right">Full Name</label>
                                    <div class="col-md-6">
                                        <input type="text" id="name" class="form-control" name="name">
                                    </div>
                                </div>
								
                                <div class="form-group row">
                                    <label for="user_name" class="col-md-4 col-form-label text-md-right">User Name</label>
                                    <div class="col-md-6">
                                        <input type="text" id="uid" class="form-control" name="uid">
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                                    <div class="col-md-6">
                                        <input type="text" id="email" class="form-control" name="email">
                                    </div>
                                </div>

                                

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                    <div class="col-md-6">
                                        <input type="password" id="password" class="form-control" name="pwd">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                    <div class="col-md-6">
                                        <input type="password" id="password" class="form-control" name="pwdrepeat">
                                    </div>
                                </div>

                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary" name="submit">
                                        Sign Up
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
            </div>
        </div>
    </div>

</main>

<?php
	include_once 'modules/components/footer.php'
?>