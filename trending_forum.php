<!DOCTYPE html>

<!-- including php file -->
<?php
	session_start(); 
	include("functions/functions.php");
?>

<html lang="en" ng-app="mainApp">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="js/controller.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>	

	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
</head>
<body ng-controller="mainCtrl">

<!-- sidebar -->
<div id="mySidenav" class="sidenav">
	<a href="javascript:void(0)" class="closebtn" onclick="closeNav()"><i class="fa fa-angle-left"></i></a>
	<?php notification(); ?>
</div>
	
	<nav id="Nav" class="nav navbar-default" style="background-color: #fff;">
		<div class="container-fluid">
			<div class="navbar-header">
				<!-- items toggle button -->
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<?php
					if(!isset($_SESSION['blogger_email'])){
						echo "<a href='' id='sidebar-toggle' onclick='openNav()' class='navbar-brand'>{{blogSite}}</a>";
					}
					else{
						$session = $_SESSION['blogger_email'];

						$id = "select *,upper(blogger_name) as blogger_name from bloggers where blogger_email='$session'";
						$run_id = mysqli_query($con, $id);

						while($row_id = mysqli_fetch_array($run_id)){
							$blogger_id = $row_id['blogger_id'];

							$friend_list = "select * from friend_list where user_id='$blogger_id'";
							$run_friend_list = mysqli_query($con, $friend_list);

							while($row_friend_list = mysqli_fetch_array($run_friend_list)){
								$friend_id = $row_friend_list['friend_id'];

								$notification = "select * from notification where blogger_id='$friend_id'";
								$run_notification = mysqli_query($con, $notification);

								$num_rows = mysqli_num_rows($run_notification);

								if($num_rows == 0){
									echo "<a href='' id='sidebar-toggle' onclick='openNav()' class='navbar-brand'>{{blogSite}}</a>";
									break;
								}
								else{
									echo "
										<a href='' id='sidebar-toggle' onclick='openNav()' class='navbar-brand'>{{blogSite}} 
											<sup>
												<i class='fa fa-exclamation active'></i>
											</sup>
										</a>";
									break;
								}

							}
							
						}
					}
				?>

			</div> <!-- navbar header -->
			
			<div class="collapse navbar-collapse" id="navbar">
				<!-- unorderd navbar list items -->
				<ul class="nav navbar-nav navbar-right">
				<li>
		            <form method="post" action="search.php" class="search-form" enctype="multipart/form-data">
		                <div class="form-group has-feedback">
		            		<label for="search" class="sr-only">Search</label>
		            		<input type="text" class="form-control" name="searchBlogs" id="search" placeholder="search">
		              		<span class="glyphicon glyphicon-search form-control-feedback"></span>

		            	</div>
		            </form>
				</li>
					<li><a href="index.php" class="links">{{navItem1}}</a></li>
					<li>
						<?php
							if(isset($_SESSION['blogger_email'])){
								echo "<a href='blogger/blogger_account.php' class='links'>{{navItem2}}</a>";
							}
							else{
								echo "<a href='' data-toggle='modal' data-target='#loginModal' class='links'>{{navItem2}}</a>";

							}
						?>
					</li>
					
					<li><a href="forum.php" class="links active">{{navItem3}}</a></li>
					<li><a href="about.php" class="links">{{navItem4}}</a></li>
					<li><a href="contact.php" class="links">{{navItem5}}</a></li>
					<li>
						<?php
							if(isset($_SESSION['blogger_email'])){
								echo "<a href='logout.php'>Logout</a>";
							}
						?>
					</li>
				</ul>
			</div>	<!-- navbar -->
		</div> <!-- container fluid -->
	</nav>
	<section>
	
	<nav id="nav2" class="nav navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
				<button style="border: none" class="navbar-toggle" data-toggle="collapse" data-target="#navbar2">
					<span style="color: #fff"> <i class="fa fa-sort-desc"></i></span>
				</button>
			</div>

			<div class="collapse navbar-collapse" id="navbar2">

				<!-- unorderd navbar list items -->
				<ul class="nav navbar-nav">
					<li><a href="forum.php" class="links">{{nav2Item1}}</a></li>
					<li><a href="trending_forum.php" class="links active">{{nav2Item2}}</a></li>
					<li><a href="popular_this_week.php" class="links">{{nav2Item3}}</a></li>
					<li><a href="popular_this_month.php" class="links">{{nav2Item4}}</a></li>
					<li><a href="#" class="links">{{nav2Item5}}</a></li>
				</ul>
			</div>
		</div> <!-- container fluid -->
	</nav>

	</section>

	<main>
	<!-- Modal -->
				<div class="modal fade" id="loginModal" role="dialog">
					<div class="modal-dialog">

						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h2 class="modal-title">Login to view your <span class="active">Blogs.</span></h4>
								<p class="signup">
									Not a Member?
									<a href="signup.php">Sign Up Here</a>
								</p>

							</div>
							<div class="modal-body">
								<form action="" method="post" role="form" class="form">
									<div class="form-group">
										<input type="text" class="form-control" name="blogger_email" placeholder="email-address">
									</div>
									<div class="form-group">
										<input type="password" class="form-control" name="blogger_password" placeholder="password">
									</div>
									<div class="form-group">
										<input type="submit" class="form-control btn btn-success" name="login" placeholder="LogIn" value="Let's Go!">
									</div>
								</form>

								<?php login(); ?>

								<p class="forgot-passwords">
									<a href="forgotpassword.php">Forgot password? Click here</a>
								</p>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</div> <!-- modal content -->

					</div> <!-- modal dialog -->
				</div> <!-- login Modal -->
			
		<div class="container-fluid forum-container">
			<div class="col-md-9">

			<a href="javascript:" id="return-to-top"><i class="fa fa-chevron-up" aria-hidden="true"></i></a>

				<?php trendingForum(); ?>
				
			</div>
			<div class="col-md-3 forum-topic-container">
				<div class="col-md-12">
					<img src="images/GA-L.jpg" alt="" style="width: 300px; height: 300px;">
				</div>
				<div class="col-md-12">
					<h2>Hot Questions</h2>
					<hr>
					<ul>
						<?php hotQuestions(); ?>
					</ul>
				</div>
			</div>

		</div> <!-- forum container -->
	</main>
	<footer>
		<div class="container-fluid footer">
			<div class="row">
				<div class="col-md-4">
					<h3>Follow us</h3>
					<i class="fa fa-facebook-official fa-2x"></i>
					<i class="fa fa-twitter fa-2x"></i>
					<i class="fa fa-instagram fa-2x"></i>
					<i class="fa fa-google-plus fa-2x"></i>
				</div>

				<div class="col-md-4">
					<h3>Feedback</h3>
					<form action="#" role="form">
						<div class="form-group">
							<input type="text" class="form-control" placeholder="Help us improve the page">
						</div>
						<div class="form-group">
							<input type="email" class="form-control" placeholder="Your Email">
						</div>
						<div class="form-group">
							<button type="button" class="btn btn-block btn-danger">Submit</button>
						</div>
					</form>
				</div>
				<div class="col-md-4">
				<h3>Navigate</h3>
					<ul class="footer-links">
						<li><a href="#">{{navItem1}}</a></li>
						<li><a href="#">{{navItem2}}</a></li>
						<li><a href="#">{{navItem3}}</a></li>
						<li><a href="#">{{navItem4}}</a></li>
						<li><a href="#">{{navItem5}}</a></li>
					</ul>
				</div>
			</div>
			<div class="row">
				<hr>
				<p class="copyright"><i class="fa fa-copyright"></i> 2017, Arpit Nagpal</p>
			</div>
		</div>
	</footer>


	<script>
		$(window).scroll(function () {
			if ( $(this).scrollTop() > 50 && !$(document.getElementById('nav2')).hasClass('open') ) {
				$(document.getElementById('nav2')).addClass('open');
				$(document.getElementById('nav2')).slideDown();
				document.getElementById('nav2').style.position="fixed";
				document.getElementById('nav2').style.top="0";
				document.getElementById('nav2').style.width="100%";
				document.getElementById('nav2').style.opacity="1";
				document.getElementById('nav2').style.zIndex="1";
				document.getElementById('nav2').style.boxShadow="0px 2px 16px 0px #888";

			} else if ( $(this).scrollTop() <= 50 ) {
				$(document.getElementById('nav2')).removeClass('open');
				document.getElementById('nav2').style.position="relative";
				document.getElementById('nav2').style.boxShadow="0px 0px 0px 0px #888";
		  	}
		});

		function openNav() {
		    document.getElementById("mySidenav").style.width = "350px";
		}

		function closeNav() {
		    document.getElementById("mySidenav").style.width = "0";
		}
	</script>
</body>
</html>