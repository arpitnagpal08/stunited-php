<!DOCTYPE html>

<?php session_start();
include("functions/functions.php"); ?>

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
                    <a class="nav-link" href="stu_area/index.php">{{nav_item_2}}</a>
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
    				
    				<h2>Have an account? Login here</h4>
					
					<form action="" method="post" role="form" class="form">
						<div class="form-group signup-group">
							<input type="email" class="form-control signup-control" name="stu_email" placeholder="Email" required>
						</div>
						<div class="form-group signup-group">
							<input type="password" class="form-control signup-control" name="stu_password" placeholder="Password" required>
						</div>
						<div class="form-group">
							<input type="submit" class="btn btn-outline-danger btn-block" name="login" value="Let's Go!">
						</div>
					</form>
					
					<?php 
						if(isset($_POST['login'])){
							$email = $_POST['stu_email'];
							$password = $_POST['stu_password'];

							$select_stu = "select * from members where email='$email' AND password='$password' AND designation='student'";
							$run_select_stu = mysqli_query($con, $select_stu);

							$check_student = mysqli_num_rows($run_select_stu);
							if($check_student==1){
								while($row = mysqli_fetch_assoc($run_select_stu)){
									//$blog = $row['blogger_email'];
									//echo $blog;
									$_SESSION['stu_email'] = $row['email'];
									//echo $_SESSION['blogger_email'];
									
									header("location: stu_area/index.php");
								} //while loop ends 
							} //if loop ends
							else{
								 echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
								<a href='' class='close' data-dismiss='alert' aria-label='close'>×</a>
								login error</div>";
							} //end of else part
						} //end of if part
						else{}
					 ?>

					<p>
						<a href="forgotpassword.php">Forgot password</a>
					</p>
					<p>
						<a href="stu_reg.php">New to {{website}}? Sign up.</a>
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