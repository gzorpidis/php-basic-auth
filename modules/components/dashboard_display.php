<!-- Dashboard webpage
	-> Display useful information about the logged in user

-->
<!-- if the user is NOT logged in, redirect him to the login page -->
<?php
include_once "modules/database/handlers/dbh.inc.php"; // connect to the database
include_once "modules/components/header.php"; // include the header code, with meta tags and navbar
include_once "modules/auth/include/form_handling.inc.php"; // for the get_common function
$result = get_common($connection, $_SESSION["id"]);

// make 1 unique query every time the page is loaded
?>

<div class="wrapper">
	<h5>Γρήγορη Προεπισκόπιση</h5>
	<section class="quick-summary">
    	<div class="ects">
        	<p>Συνολικά ECTs:</p>
			<?php
  				// print the number of total ECTs collected
  				$sum = get_ects($result);
  				printf("<p>%d</p>", $sum);
  			?>
    	</div>

    <div class="completed-courses">
        <p>Περασμένα Μαθήματα:</p>
		<?php
  // print the total number of completed courses
  $entries = get_completed_courses($result);
  printf("<p>%d</p>", $entries);
  ?>
    </div>

    <div class="gpa">
        <p>Βαθμός:</p>
        <?php
        // print the cumulative GPA
        $gpa = get_gpa($result);
        printf("<p>%10.3f</p>", $gpa);
        ?>
    </div>

</section>

<div class="main-user-dashboard">
	<?php
 echo "<ol>";
 foreach ($result as $row) {
     printf(
         "<li>\"%s\" by\t%s\tGrade: %d [\"%s\"]</li>",
         $row["course_name"],
         $row["course_instructor"],
         $row["course_grade"],
         $row["course_code"]
     );
     echo "<br>";
 }
 echo "</ol>";
 ?>
</div>

<div class="addition-state">
    <?php if (isset($_GET["error"])) {
        if ($_GET["error"] == "add_none") {
            echo "<h3 id=\"reg_success\" style=\"color: #2dba50;font-size: 26px;font-weight: bold;text-align:center;margin: 1rem 0;\">
            Course added!
            </h3>";
        } elseif ($_GET["error"] == "del_none") {
            echo "<h3 id=\"reg_success\" style=\"color: #2dba50;font-size: 26px;font-weight: bold;text-align:center;margin: 1rem 0;\">
            Course deleted!
            </h3>";
        } else {
            echo "<h3 id=\"reg_success\" style=\"color: #c92c2c;font-size: 26px;font-weight: bold;text-align:center;margin: 1rem 0;\">
            An error has occured!
            </h3>";
        }
    } ?>
</div>
<div class="add-course-result">
	<div class="row justify-content-center">
            	<div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Add Course</div>
                        <div class="card-body">
                        	<!-- include if you want: onsubmit="return validform()"right below, into form -->
                            <form name="add-course-form" action="./modules/backend_handler/add_course.inc.php" method="post">
                                <div class="form-group row">
                                    <label for="course-name" class="col-md-4 col-form-label text-md-right">Course Name</label>
                                    <div class="col-md-6">
                                        <input type="text" id="course-name" class="form-control" name="course-name" placeholder="e.g. Computer Architecture, Microeconomy">
                                    </div>
                                </div>
								
                                <div class="form-group row">
                                    <label for="instructor-name" class="col-md-4 col-form-label text-md-right">Instructor Name</label>
                                    <div class="col-md-6">
                                        <input type="text" id="instructor-name" class="form-control" name="instructor-name" placeholder="Full Name of the Instructor">
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="course-code" class="col-md-4 col-form-label text-md-right">Course Code</label>
                                    <div class="col-md-6">
                                        <input type="text" id="course-code" class="form-control" name="course-code" placeholder="e.g. K08, GP12">
                                    </div>
                                </div>   

                                <div class="form-group row">
                                    <label for="ects" class="col-md-4 col-form-label text-md-right">ECTs</label>
                                    <div class="col-md-6">
                                        <input type="number" id="ects" class="form-control" name="ects" placeholder="European Credit Transfer and Accumulation System">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="fails" class="col-md-4 col-form-label text-md-right">Fails</label>
                                    <div class="col-md-6">
                                        <input type="number" id="course-fails" class="form-control" name="course-fails" placeholder="How many times have you failed this course?">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="grade" class="col-md-4 col-form-label text-md-right">Grade</label>
                                    <div class="col-md-6">
                                        <input type="number" id="grade" class="form-control" name="course-grade" placeholder="How much did you score?">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="semester" class="col-md-4 col-form-label text-md-right">Semester</label>
                                    <div class="col-md-6">
                                        <input type="number" id="course-semester" class="form-control" name="course-semester" placeholder="e.g. 1 for the first (winter) semester">
                                    </div>
                                </div>

                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary" name="submit">
                                    Add Course
                                    </button>
                                </div>

                                </div>
                            </form>
                        </div>
                    </div>
            </div>
        </div>

<div class="delete-course">
	<div class="row justify-content-center">
            	<div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Delete Course</div>
                        <div class="card-body">
                        	<!-- include if you want: onsubmit="return validform()"right below, into form -->
                            <form name="delete-course-form" action="./modules/backend_handler/delete_course.inc.php" method="post">
                                
                                <div class="form-group row">
                                    <label for="course-code" class="col-md-4 col-form-label text-md-right">Course Code</label>
                                    <div class="col-md-6">
                                        <input type="text" id="de-course-code" class="form-control" name="del-course-code" placeholder="Make sure it's correct!">
                                    </div>
                                </div>   

                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary" name="submit">
                                    Delete Course
                                    </button>
                                </div>

                                </div>
                            </form>
                        </div>
                    </div>
            	</div>
       		</div>
    	</div>
	</div>
</div>

</div>


<?php 
	// include the footer code, which closes the website
	// include the footer code, which closes the website
	include_once "modules/components/footer.php";
?>
