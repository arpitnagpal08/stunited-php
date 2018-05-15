<!DOCTYPE html>

<!-- including php file -->
<?php session_start(); 
	include("../functions/functions.php");

	if(!isset($_SESSION['stu_email'])){
		header("location: ../stu_login.php");
	}
	else{
?>

<html lang="en" ng-app="mainApp" ng-controller="mainCtrl">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

	<title>{{website}}</title>

	<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

	<script src="../js/controller.js"></script>

	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="../css/font-awesome/css/font-awesome.min.css">

	<link rel="stylesheet" href="../css/bootstrap/css/bootstrap.min.css">

</head>
<body>

	<nav id="Nav" class="navbar navbar-toggleable-md navbar-light bg-faded">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <a href="../index.php#top-container" class="navbar-brand">{{website}}</a>

        <div id="navbarNavDropdown" class="navbar-collapse collapse">
            <ul class="navbar-nav mr-auto">
	            <li class="nav-item">
	            	<a class="nav-link" href="index.php">{{my_account_1}}</a>
	            </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">{{my_account_2}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">{{my_account_3}}</a>
                </li>

            </ul>

            <ul class="navbar-nav">
            	<li class="nav-item">
	            	<form action="search.php" method="post" role="form" class='form-inline'>
	            		<div class='input-group'>
						    <input class='form-control' type='text' name="search" placeholder='Search'>
							<span class='input-group-btn'><button type="submit" name="searchPost" class='btn btn-outline-info'><i class='fa fa-search'></i></button></span>            			
	            		</div>
					</form>
            	</li>

            	<li class="nav-item dropdown">
            	
            	<?php 
            		if(isset($_SESSION['stu_email'])){
            			
            			$session = $_SESSION['stu_email'];
            			$selection = "select * from members where email='$session'";
            			$run_selection = mysqli_query($con, $selection);

            			$row = mysqli_fetch_array($run_selection);

            			$image = $row['image'];

            			echo "
							<img src='../images/$image' alt='' class='img-fluid rounded-circle dropdown-toggle' id='navbarDropdownMenuLink' data-toggle='dropdown' width='40px'>
            			";
            		}
            	 ?>
			          
			        <div class="dropdown-menu" style="left: -150px;">
			          <a class="dropdown-item" href="#">Action</a>
			          <a class="dropdown-item" href="#">Another action</a>
			          <a class="dropdown-item" href="../logout.php" style="color: tomato">Logout</a>
			        </div>
			    </li>
            </ul>
        </div>
    </nav>
	
	<main>
		<div class="container-fluid">
			
			<div class="row" style='margin-top: 5%;'>
				<div class='col-md-2 col-lg-2 col-sm-2 left-container'>
			
					<!-- student's profile function -->
					<?php stuProfile(); ?>

				</div> <!-- col md 2 -->

				<div class='col-md-6 middle-container'>
					<div class="row">
						
						<div class="col-md-12 rounded" style="background-color: #fff;">
							
							<div class="row">

								<div class="col-md-12">
									<a href='index.php#attendance'>&laquo; back</a>	
								</div>
								<div class="col-md-12">
									<ul>
									<?php 

									$session = $_SESSION['stu_email'];
									$member = "select * from members where email='$session'";
									$run_member = mysqli_query($con, $member);
									$row_member = mysqli_fetch_array($run_member);

									$id = $row_member['id'];

									$staff = "select * from subjects where sem='7'";
									$run = mysqli_query($con, $staff);

									while($row = mysqli_fetch_array($run)){
										
										$id = $row['id'];
										$subject = $row['subject'];
										$sem = $row['sem'];

										echo "
											<li class='nav-item' style='display: inline-block;'>
												<a class='nav-link' href='attendance_list.php?sub_id=$id' style='padding: 50px;'>
													$subject
												</a>
											</li>
										";
									}

								 ?>
								</ul>
								
							</div> <!-- col md 12 -->
							</div>
							<!-- Attendance section -->
							<?php attendance(); ?>

						</div> <!-- col md 12 -->
					</div> <!-- row -->
				</div> <!-- col md 6 -->

				<div class='col-md-3 col-lg-3 col-sm-3 right-container'>
					
					<!-- additional information by admin -->
					<div class='row'>
						<div class='alert alert-danger alert-dismissible fade show' role='alert'>
							<a href='' class='close' data-dismiss='alert' aria-label='close'>×</a>
							<p>All the messages of the "Admin" will be displayed here that he wants to convey.</p>
						</div>
					</div>

					<div class='row rounded' style='border: 1px solid transparent; background-color: #fff; color: #222;'>
						

						<h5 style='margin-top: 10px;margin-left: 10px;'>Notification</h5>
						
						<div class='col-md-12' style='padding: 0px 15px 15px 15px; overflow-y: scroll; height: 250px;'>
							
							<div class='row' style=''>
								<div class='col-md-12' style='border-top: 2px solid #f0f0f0; padding: 0px 0px 0px 0px;'>
										<a href='' style='text-decoration: none;' class='btn btn-link'>
											<p>
												Arpit Nagpal likes your post.
											</p>
										</a>
								</div> <!-- col md 12 -->
								<div class='col-md-12' style='border-top: 2px solid #f0f0f0; padding: 5px 0px 5px 0px;'>
										<a href='' style='text-decoration: none;' class='btn btn-link'>
											<p>
												Arpit Nagpal likes your post.
											</p>
										</a>
								</div> <!-- col md 12 -->
								<div class='col-md-12' style='border-top: 2px solid #f0f0f0; padding: 5px 0px 5px 0px;'>
										<a href='' style='text-decoration: none;' class='btn btn-link'>
											<p>
												Arpit Nagpal likes your post.
											</p>
										</a>
								</div> <!-- col md 12 -->
								<div class='col-md-12' style='border-top: 2px solid #f0f0f0; padding: 5px 0px 5px 0px;'>
										<a href='' style='text-decoration: none;' class='btn btn-link'>
											<p>
												Arpit Nagpal likes your post.
											</p>
										</a>
								</div> <!-- col md 12 -->
							</div> <!-- row -->
							
							

						</div> <!-- col md 12 -->
					</div> <!-- row -->
				</div> <!-- col md 3 -->
				
			</div> <!-- row -->
			
		</div> <!-- container fluid -->
	</main>
	<!-- script files for bootstrap 4-->
	<script src="https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script src="../css/bootstrap/js/bootstrap.min.js"></script>

</body>
</html>

<!-- end of else part -->
<?php } ?>