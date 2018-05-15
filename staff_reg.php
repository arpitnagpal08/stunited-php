<!DOCTYPE html>

<!-- including functions page -->
<?php
	include("functions/functions.php");
?>

<html lang="en" ng-app="mainApp" ng-controller="mainCtrl">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

	<title>{{website}}</title>

	<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

	<script src="js/controller.js"></script>

	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">

	<link rel="stylesheet" href="css/bootstrap/css/bootstrap.min.css">
	
</head>
<body>
	
	<nav id="" class="navbar navbar-toggleable-md navbar-light" style="background-color: #fff; border-bottom: 5px solid tomato;">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <a class="navbar-brand" href="index.php">{{nav_item_1}}</a>

        <div id="navbarNavDropdown" class="navbar-collapse collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="staff_area/index.php">{{nav_item_2}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="openNav()" href="">{{nav_item_3}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">{{nav_item_4}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">{{nav_item_5}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">{{nav_item_6}}</a>
                </li>
            </ul>
        </div>
    </nav>

    <main>
    	<div class="container-fluid">
    		<div class="row">
    			<div class="col-md-10 offset-md-1" style="text-align: center; padding-top: 2%;">
    				<h2>Join
    					<span class="active">
    						<a href="index.php" style="color: inherit;">{{website}}</a>
    					</span> today.
    				</h4>
					<p>
						<a href="staff_login.php">Have an account? Log in</a>
					</p>
					<form action="staff_reg.php" method="post" enctype="multipart/form-data" role="form" class="form">
						<div class="form-group signup-group">
							<input type="text" class="form-control signup-control" name="staff_name" placeholder="Full Name">
						</div>
						<div class="form-group signup-group">
							<input type="email" class="form-control signup-control" name="staff_email" placeholder="Email">
						</div>
						<div class="form-group signup-group">
							<input type="password" class="form-control signup-control" name="staff_password" placeholder="Password">
						</div>
						<div class="form-group">
							<input type="file" name="staff_image" class="form-control">
						</div>
						<div class="form-group">
							<input type="submit" class="btn btn-outline-danger btn-block" name="signup" value="Sign up">
						</div>
					</form>
					
					

					<p>
						By signing up, you agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>, including <a href="#">Cookie Use</a>. Others will be able to find you by email or name when provided.
					</p>
    			</div> <!-- col md 12 -->
    		</div> <!-- row -->
    	</div> <!-- container fluid -->
    </main>


	<!-- script files for bootstrap 4-->
	<script src="https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script src="css/bootstrap/js/bootstrap.min.js"></script>
	<script src="js/script.js"></script>

</body>
</html>

<!-- code to submit student's registration -->
<?php 

	if(isset($_POST['signup'])){
		$name = $_POST['staff_name'];
		$email = $_POST['staff_email'];
		$password = $_POST['staff_password'];

		// storing profile image
		$staff_image = $_FILES['staff_image']['name'];
		$image_tmp = $_FILES['staff_image']['tmp_name'];

		move_uploaded_file($image_tmp, "images/$staff_image");
	
		$submit = "insert into members (designation, name, email, password, image, number_of_posts) values ('teacher' ,'$name', '$email', '$password', '$staff_image', '0')";
		$run_insert = mysqli_query($con, $submit);

			$_SESSION['staff_email']=$email;
			echo "<script>alert('Registration Successful, Thanks!')</script>";
			echo "<script>window.open('staff_login.php','_self')</script>";
	}

?>