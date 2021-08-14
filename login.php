<?php 
	include_once 'modules/components/header.php';
?>
<div class="wrapper">
	<div class="login-page">
        <div class="login-state" id="error-header">
            <?php
            	if (isset($_GET['error'])) {
					if ($_GET['error'] == "credential_mismatch") {
                        echo "<h3 id=\"reg_success\" style=\"color: #c92c2c;font-size: 26px;font-weight: bold;text-align:center;\">
                        Log In Failed!
                        </h3>";
                        echo "<h5 id=\"reg_fail\">
                        The credentials provided in the password do not match a user!
                        </h5>";
                    } else if ($_GET['error'] == "id_not_found") {
                        echo "<h3 id=\"reg_success\" style=\"color: #c92c2c;font-size: 26px;font-weight: bold;text-align:center;\">
                        Log In Failed!
                        </h3>";
                        echo "<h5 id=\"reg_fail\">
                        Wrong username or email!
                        </h5>";
                    } else if ($_GET['error'] == 'need_login') {
                        echo "<h3 id=\"reg_success\" style=\"color: #c92c2c;font-size: 26px;font-weight: bold;text-align:center;\">
                        Login required first!
                        </h3>";
                        echo "<h5 id=\"reg_fail\">
                        The resource you are trying to access needs authentication.
                        </h5>";
                    }
					echo 	"<script type=\"text/javascript\">";
                    echo	"noError();";
                    echo	"</script>";
                }
            ?>
        </div>
    <main class="my-form">
    	<div class="container">
        	<div class="row justify-content-center">
            	<div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Log In</div>
                        	<div class="card-body">
                        			<!-- include if you want: onsubmit="return validform()"right below, into form -->
                            		<form name="singup-form" action="modules/auth/include/login.inc.php" method="post">
			
                                	<div class="form-group row">
                                    	<label for="user_name" class="col-md-4 col-form-label text-md-right">User Name or Email</label>
                                    		<div class="col-md-6">
                                        		<input type="text" id="uid" class="form-control" name="uid">
                                    		</div>
                                	</div>
        
                                	<div class="form-group row">
                                    	<label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                    	<div class="col-md-6">
                                        	<input type="password" id="password" class="form-control" name="pwd">
                                    </div>
                            </div>

                            <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary" name="submit">
                                    Log In
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
</div>
</div>
<?php
	include_once 'modules/components/footer.php'
?>