<!DOCTYPE html>

<!-- including php file -->
<?php session_start(); 
	include("../functions/functions.php");

	if(!isset($_SESSION['staff_email'])){
		header("location: ../staff_login.php");
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
            		if(isset($_SESSION['staff_email'])){
            			
            			$session = $_SESSION['staff_email'];
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
					<?php staffProfile(); ?>

					<!-- modal to add semester -->
					<div class="modal fade" id="semester" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h6 class="modal-title">Subjects along with Semesters</h6>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div> <!-- modal header -->
								<div class="modal-body">
									<?php semesters(); ?>
								</div> <!-- modal body -->
								<div class="modal-footer">
									<form action="" method="post" class="form-inline" enctype="multipart/form-data">
										<input class="form-control" type="text" name="semester" placeholder="Add Semester">
										<select name="subject" class="form-control">
											
												<?php 

													$sub = "select * from subjects";
													$run = mysqli_query($con, $sub);

													while($row = mysqli_fetch_array($run)){
														$subject = $row['subject'];
														$id = $row['id'];
														echo "
															<option value='$subject'>$subject</option>
														";
													}

												 ?>
											
										</select>
										<button type="submit" name="semesters" class="btn btn-success">Insert</button>
									</form>
								</div> <!-- modal footer -->
							</div> <!-- modal content -->
						</div> <!-- modal dialogue -->
					</div> <!-- modal -->

					<?php 

						if(isset($_POST['semesters'])){
							$session = $_SESSION['staff_email'];
							$member = "select * from members where email='$session'";
							$run_member = mysqli_query($con, $member);
							$row_member = mysqli_fetch_array($run_member);

							$id = $row_member['id'];
							$sem = $_POST['semester'];
							$subject = $_POST['subject'];

							$insert = "insert into staff (staff_id, sem, subjects) values ('$id','$sem','$subject')";
							$run = mysqli_query($con, $insert);

							if($run){
								echo "<script>alert('Successfully Inserted')</script>";
								echo "<script>window.open('index.php','_self')</script>";
							}
						}

					 ?>

				</div> <!-- col md 2 -->

				<div class='col-md-6 middle-container'>
					<div class="row">
						<ul class="nav nav-tabs" id="myTabs" role="tablist">
								<li class="nav-item">
									<a href="#posts" class="nav-link" data-toggle="tab" role="tab">Posts</a>
								</li>
								<li class="nav-item">
									<a href="#events" class="nav-link" data-toggle="tab" role="tab">Events</a>
								</li>
								<li class="nav-item">
									<a href="#attendance" class="nav-link" data-toggle="tab" role="tab">Attendance</a>
								</li>
								
							</ul>
						<div class="col-md-12 rounded" style="background-color: #fff;">
							
							<!-- posts section -->

							<div class="tab-content">
								<div class="tab-pane" id="posts" role="tabpanel">
									
									<div class="row">

										<!-- insert posts -->
										<form action='' method='post' role='form' class="form-inline col-md-12" style="padding: 15px;">

											<div class="col-md-6 input-group form-inline">
												<input type="text" name="postTitle" class="form-control" placeholder="Title of the post">
											</div>

											<div class="col-md-6 input-group form-inline">
												<input type="text" name="postContent" class="form-control" placeholder="What's on your mind?">
												<span class="input-group-btn"><button type="submit" name="insertPost" class="btn btn-outline-danger">Post</button></span>
											</div>

										</form>
									</div> <!-- row -->

									<!-- function to insert post -->
									<?php 

										if(isset($_POST['insertPost'])){
											
											if(isset($_SESSION['stu_email'])){
												
												$session = $_SESSION['stu_email'];
												$member = "select * from members where email='$session'";
												$run_member = mysqli_query($con, $member);
												$row_member = mysqli_fetch_array($run_member);

												$id = $row_member['id'];
												$title = $_POST['postTitle'];
												$content = $_POST['postContent'];
												$date = date('Y-m-d H:i:s');

												$insert_post = "insert into posts (member_id, title, content, date, no_of_comments, no_of_likes) values ('$id','$title','$content','$date', '0', '0')";
												$run_post = mysqli_query($con, $insert_post);

												if($run_post){
													echo "<script>window.open('index.php#top-container','_self')</script>";
												}
											} //end of if

											elseif(isset($_SESSION['staff_email'])){
												
												$session = $_SESSION['staff_email'];
												$member = "select * from members where email='$session'";
												$run_member = mysqli_query($con, $member);
												$row_member = mysqli_fetch_array($run_member);

												$id = $row_member['id'];
												$title = $_POST['postTitle'];
												$content = $_POST['postContent'];
												$date = date('Y-m-d H:i:s');

												$insert_post = "insert into posts (member_id, title, content, date) values ('$id','$title','$content','$date')";
												$run_post = mysqli_query($con, $insert_post);

												if($run_post){
													echo "<script>window.open('index.php#top-container','_self')</script>";
												}
											} //end of elseif

											else{
												echo "
													
													<div class='row' style='margin-top: 10px;'>
														<div class='col-md-12'>
															<div class='alert alert-danger alert-dismissible fade show' role='alert'>
																<a href='' class='close' data-dismiss='alert' aria-label='close'>×</a>
																<p class='text-center' style='margin: auto 0;'>You must Login first.</p>
															</div>
														</div>
													</div> 

												";
											}

										}

									 ?>


									<!-- function to like and dislike the post -->
									<?php //if user is logged in
										if(isset($_POST['like'])){

											global $member_id;			
											
											if(isset($_SESSION['staff_email']) || isset($_SESSION['stu_email'])){
											
												$like_id = $_POST['like'];

												$get_post = "select * from posts where id='$like_id'";
												$run_post = mysqli_query($con, $get_post);
												while($row_like = mysqli_fetch_array($run_post)){
													$likes = $row_like['no_of_likes'];

													//increment number of likes with 1
													$new_likes = $likes+1;

													$insert = "update posts set no_of_likes=$new_likes where id='$like_id'";
													$run_insert = mysqli_query($con,$insert);

													$insert_like = "insert into likes (post_id, member_id, button) values ('$like_id','$member_id','1')";
													$run_like = mysqli_query($con, $insert_like);

													if($run_like){
														echo "<script>window.open('index.php','_self')</script>"; //reloads the whole page			
													} //end of if
												} //end of while

											} //end of if

											else{
												echo "<script>alert('You must login first')</script>";
											}

										} //end of if

										elseif(isset($_POST['unlike'])){
											
											if(isset($_SESSION['staff_email']) || isset($_SESSION['stu_email'])){
											
												$unlike_id = $_POST['unlike'];

												$get_post = "select * from posts where id='$unlike_id'";
												$run_post = mysqli_query($con, $get_post);
												while($row_like = mysqli_fetch_array($run_post)){
													$unlike = $row_like['no_of_likes'];

													//increment number of likes with 1
													$new_unlike = $unlike-1;

													$insert = "update posts set no_of_likes=$new_unlike where id='$unlike_id'";
													$run_insert = mysqli_query($con,$insert);

													$delete_like = "delete from likes where post_id='$unlike_id'";
													$run_like = mysqli_query($con, $delete_like);

													if($run_like){
														echo "<script>window.open('index.php','_self')</script>"; //reloads the whole page			
													} //end of if
												} //end of while

											} //end of if
										} //end of elseif

										else{}
									?>

									<!-- function to show all the posts -->
									<?php staffPosts(); ?>

								</div>	<!-- tab pane -->

								<!-- events section -->
								
								<div class="tab-pane" id="events" role="tabpanel">
								
									<div class="row">
										<div class="col-md-12 rounded">
											<form action='' method='post' role='form' class="form-inline" style="padding: 15px;">

												<input type="text" class="form-control col-md-10" name="events" placeholder="Add an event">
												<span class="input-group-btn"><button type="submit" name="insertEvent" class="btn btn-outline-danger">Insert</button></span>

											</form>
										</div>
																
										<!-- function to insert post -->
										<?php 

											if(isset($_POST['insertEvent'])){
												
												if(isset($_SESSION['stu_email'])){
													
													$session = $_SESSION['stu_email'];
													$member = "select * from members where email='$session'";
													$run_member = mysqli_query($con, $member);
													$row_member = mysqli_fetch_array($run_member);

													$id = $row_member['id'];
													$content = $_POST['event'];
													$date = date('Y-m-d H:i:s');

													$insert_event = "insert into events (events, date) values ('$content','$date')";
													$run_event = mysqli_query($con, $insert_event);

													if($run_event){
														echo "<script>alert('Event successfully inserted.')</script>";
														echo "<script>window.open('index.php','_self')</script>";
													}
												} //end of if

												elseif(isset($_SESSION['staff_email'])){
													
													$session = $_SESSION['staff_email'];
													$member = "select * from members where email='$session'";
													$run_member = mysqli_query($con, $member);
													$row_member = mysqli_fetch_array($run_member);

													$id = $row_member['id'];
													$content = $_POST['event'];
													$date = date('Y-m-d H:i:s');

													$insert_event = "insert into events (events, date) values ('$content','$date')";
													$run_event = mysqli_query($con, $insert_event);

													if($run_event){
														echo "<script>alert('Event successfully inserted.')</script>";
														echo "<script>window.open('index.php','_self')</script>";
													}
												} //end of elseif

												else{
													echo "
														
														<div class='row' style='margin-top: 10px;'>
															<div class='col-md-12'>
																<div class='alert alert-danger alert-dismissible fade show' role='alert'>
																	<a href='' class='close' data-dismiss='alert' aria-label='close'>×</a>
																	<p class='text-center' style='margin: auto 0;'>You must Login first.</p>
																</div>
															</div>
														</div> 

													";
												}

											}

										 ?>		
									</div> <!-- row -->

									<!-- function to display all the events -->
									<?php events(); ?>
								
								</div> <!-- tab pane -->

								
								<!-- attendance section -->

								<div class="tab-pane active" id="attendance" role="tabpanel">
									<div class="row">
										<div class="col-md-12">
												<ul>
												<?php 

												$session = $_SESSION['staff_email'];
												$member = "select * from members where email='$session'";
												$run_member = mysqli_query($con, $member);
												$row_member = mysqli_fetch_array($run_member);

												$id = $row_member['id'];

												$staff = "select * from staff where staff_id='$id'";
												$run = mysqli_query($con, $staff);

												while($row = mysqli_fetch_array($run)){
													
													$subject_id = $row['id'];
													$subject = $row['subjects'];
													$sem = $row['sem'];

													echo "
														<li class='nav-item' style='display: inline-block;'>
															<a class='nav-link' href='attendance.php?sub_id=$subject_id' style='padding: 50px;'>
																$subject
															</a>

														</li>
													";
												}

											 ?>
											</ul>
											
										</div> <!-- col md 12 -->

									</div> <!--  row -->

								</div> <!-- tab pane -->

							</div> <!-- tab content -->

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