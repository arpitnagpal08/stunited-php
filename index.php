<!DOCTYPE html>

<?php session_start();
include ("functions/functions.php"); ?>

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
	<section id='cover'>
		<div id='cover-caption'>
			<div class='container-fluid'>
			<div class='row'>
				<div class='col-md-12'>
					
					<h1 class='display-3'>Welcome <span style='font-size: 30px'>to the college social media.</span></h1>
					
					<!-- cover function -->
					<?php cover(); ?>

				</div>
			</div>
			</div>
		</div>
	</section>

	<div class="container-fluid">
		<div id="top-container" class="row top-container">
			<div class="col-md-4 push-md-4">
				<p class="website-name">{{website}}</p>
			</div>

			<div class="col-md-4 pull-md-4">
				<a href="http://www.fb.com" class="social-media">
					<i class="fa fa-facebook"></i> 
				</a>&nbsp;&nbsp;
				<a href="http://instagram.com" class="social-media">
					<i class="fa fa-instagram"></i> 
				</a>&nbsp;&nbsp;
				<a href="http://youtube.com" class="social-media">
					<i class="fa fa-youtube"></i>
				</a>
			</div>
			
			<div class="col-md-4">
				<form action="search.php" method="post" role="form" class='form-inline offset-md-2'>
            		<div class='input-group' style="z-index: 0;">
					    <input class='form-control' type='text' name="search" placeholder='Search'>
						<span class='input-group-btn'><button type="submit" name="searchPost" class='btn btn-outline-danger'><i class='fa fa-search'></i></button></span>
            		</div>
				</form>
			</div>
		</div>
	</div>

	<!-- sidebar -->
	<div id="mySidenav" class="sidenav">
		<!-- to close side nav -->
		<a href="javascript:void(0)" class="closebtn" onclick="closeNav()"><i class="fa fa-angle-left"></i></a>
		
		<!-- function notification -->
		<?php notification(); ?>

	</div> <!-- side nav -->

	<nav id="Nav" class="navbar rounded navbar-toggleable-md navbar-light" style="background-color: #fff;">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <a class="navbar-brand" href="index.php#top-container">{{nav_item_1}}</a>

        <div id="navbarNavDropdown" class="navbar-collapse collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
			      
			      <!-- my account function -->
			      <?php myAccount(); ?>  
			      
			    </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="openNav()" href="">{{nav_item_3}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="forum.php">{{nav_item_4}}</a>
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
			<div class="row" style="margin-top: 10px;">
				
				<a href="javascript:" id="return-to-top">Back to top</a>
				
				<div class="col-md-2 rounded left-container">
					<div class="row rounded" style="background-color: #fff;">
						<div class="col-md-12">
							<h2>Event</h2>
							<?php events(); ?>
						</div>
					</div>
				</div><!-- left container -->

				<div class="col-md-6 rounded middle-container">
					<div class="row">
						<div class="col-md-12 rounded" style="background-color: #fff;">
							<!-- All posts -->
							<div class="row rounded">
								<div class="col-md-12" style="padding: 15px; z-index: 0;">
									<div class="row">								
										<form action='' method='post' role='form' class="form-inline col-md-12">
											<div class="col-md-6 input-group form-inline">
												<input type="text" name="postTitle" class="form-control" placeholder="Title of the post">
											</div>

											<div class="col-md-6 input-group form-inline">
												<input type="text" name="postContent" class="form-control" placeholder="What's on your mind?">
												<span class="input-group-btn"><button type="submit" name="insertPost" class="btn btn-outline-danger">Post</button></span>
											</div>
										</form>

									</div>
									
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

								</div>
							</div> <!-- row -->
							<div class="row rounded" style="border: 1px solid transparent;">
								<div class="col-md-12">

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
														echo "<script>window.open('index.php#top-container','_self')</script>"; //reloads the whole page			
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
														echo "<script>window.open('index.php#top-container','_self')</script>"; //reloads the whole page			
													} //end of if
												} //end of while

											} //end of if
										} //end of elseif

										else{}
									?>

									<!-- function to display all posts -->
									<?php allPosts(); ?>
									
									
								</div> <!-- col md 12 -->
							</div> <!-- row -->

						</div> <!-- col-md-12 -->
					</div> <!-- row -->

				</div> <!-- middle container -->

				<div class="col-md-3 rounded right-container">

					<div class="row rounded" style="background-color: #fff; padding: 5px;">
						<div class="col-md-12">
							<h2>Recent Posts</h2>
							
							<!-- recent post function -->
							<?php recentPost(); ?>	
						</div> <!-- col-md-12 -->
					</div> <!-- row -->
				
				</div> <!-- right container -->

			</div> <!-- row -->
		</div> <!-- container fluid -->

	</main>

	<footer>
		<div class="container-fluid footer">
			<div class="row">
				<div class="col-md-8 push-md-2 moto">
					<h2>Our Moto</h2>
					<p><span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quis pariatur maxime in temporibus blanditiis esse iure iusto ea, porro commodi labore omnis beatae sint earum quia possimus fugit consectetur aut.</span><span>Doloribus unde suscipit, accusantium fugiat ea ratione rem ipsam eum expedita iure optio et voluptatem, alias est voluptatibus illo ducimus! Saepe aut, repellat ab doloremque vitae. Magnam odit reiciendis consectetur!</span></p>
				</div>
			</div>

			<div class="row" style="text-align: center; border-top: 1px solid #fff;">
				<div class="col-md-4 push-md-4">
					<p class="copyright"><i class="fa fa-copyright"></i> 2017, {{websiteName}}</p>					
				</div>
			</div>
		</div>
	</footer>

	<!-- script files for bootstrap 4-->
	<script src="https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script src="css/bootstrap/js/bootstrap.min.js"></script>
	<script src="js/script.js"></script>


</body>
</html>