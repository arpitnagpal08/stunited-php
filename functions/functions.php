<?php

//creating a connection with database
$con = mysqli_connect("localhost","root","","stunited");

//in case connection is not established
if(mysqli_connect_errno()){
	echo "The connection as not established: " . mysqli_connect_error();
}


//getting user ip address
function getIp() {
    $ip = $_SERVER['REMOTE_ADDR'];
 
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } 
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
 
    return $ip;
}

//cover page
function cover(){

	//globally declaring variable
	global $con;

	//if logged in as staff or student
	if(isset($_SESSION['staff_email']) || isset($_SESSION['stu_email'])){
		echo "
			<a href='#top-container' role='button' class='btn btn-outline-secondary btn-sm'> <i class='fa fa-angle-double-down'></i></a>
		";
	} //end of if

	else{
		echo "
			<a class='btn btn-link text-white' data-toggle='collapse' href='#login' aria-expanded='false'>
				&laquo; Click here to Login/Sign Up &raquo;
			</a>
			
			<div class='row'>
				<div class='col-md-12'>
					
					<div class='collapse' id='login'>
		                <div class='row'>
							
							<div class='card card-block' style='background-color: transparent; border: 1px solid #f0f0f0;'>
									
								<legend>Teacher's Login</legend>

								<!-- login form for teachers-->
								<form action='' method='post' role='form' class='form-inline offset-md-1'>
			                    	<div class='form-group'>
			                    		<input class='form-control' type='email' name='staff_email' id='' placeholder='email-id'>
			                    	</div>
			                    	<div class='form-group'>
			                    		<input class='form-control' type='password' type='password' name='staff_password' placeholder='password'>
			                    	</div>
			                    	<div class='form-group'>
			                    		<button type='submit' class='btn btn-outline-secondary form-control' name='staff_login'>Submit</button>
			                    	</div>
			                    </form>

								<!-- link for new registration -->
								<a href='staff_reg.php' class='btn btn-link text-success'>Create an account</a>

							</div> <!-- card card-block -->

							<div class='card card-block' style='background-color: transparent; border: 1px solid #f0f0f0;'>
									
								<legend>Student's Login</legend>
								
								<!-- login form for students -->
								<form action='' method='post' role='form' class='form-inline offset-md-1'>
			                    	<div class='form-group'>
			                    		<input class='form-control' type='email' name='stu_email' id='' placeholder='email-id'>
			                    	</div>
			                    	<div class='form-group'>
			                    		<input class='form-control' type='password' type='password' name='stu_password' placeholder='password'>
			                    	</div>
			                    	<div class='form-group'>
			                    		<button type='submit' class='btn btn-outline-secondary form-control' name='stu_login'>Submit</button>
			                    	</div>
			                    </form>

			                    <!-- link for new registration -->
								<a href='stu_reg.php' class='btn btn-link text-success'>Create an account</a>
							</div> <!-- card card-block -->
		                    
		                </div> <!-- row -->

		            </div> <!-- collapse -->

				</div> <!-- col md 12 -->
			</div> <!-- row -->

			<br>
			
			<a href='#top-container' role='button' class='btn btn-outline-secondary btn-sm'> Skip login <i class='fa fa-angle-double-down'></i></a>
		";

		//staff login
		if(isset($_POST['staff_login'])){
			$email = $_POST['staff_email'];
			$password = $_POST['staff_password'];

			$select_staff = "select * from members where email='$email' AND password='$password' AND designation='teacher'";
			$run_select_staff = mysqli_query($con, $select_staff);

			$check_staff = mysqli_num_rows($run_select_staff);
			if($check_staff==1){
				while($row = mysqli_fetch_assoc($run_select_staff)){
					//$blog = $row['member_email'];
					//echo $blog;
					$_SESSION['staff_email'] = $row['email'];
					//echo $_SESSION['member_email'];
					
					header("location: index.php#top-container");
				} //while loop ends 
			} //if loop ends
			else{
				 echo "<div class='col-md-6 push-md-3 alert alert-danger alert-dismissible fade show' role='alert' style='margin-top: 5px;'>
				<a href='' class='close' data-dismiss='alert' aria-label='close'>×</a>
				Wrong email or password</div>";
			} //end of else part
		} //end of if part
		else{}

		//student login
		if(isset($_POST['stu_login'])){
			$email = $_POST['stu_email'];
			$password = $_POST['stu_password'];

			$select_stu = "select * from members where email='$email' AND password='$password' AND designation='student'";
			$run_select_stu = mysqli_query($con, $select_stu);

			$check_stu = mysqli_num_rows($run_select_stu);
			if($check_stu==1){
				while($row = mysqli_fetch_assoc($run_select_stu)){
					//$blog = $row['member_email'];
					//echo $blog;
					$_SESSION['stu_email'] = $row['email'];
					//echo $_SESSION['member_email'];
					
					header("location: index.php#top-container");
				} //while loop ends 
			} //if loop ends
			else{
				 echo "<div class='col-md-6 push-md-3 alert alert-danger alert-dismissible fade show' role='alert' style='margin-top: 5px;'>
				<a href='' class='close' data-dismiss='alert' aria-label='close'>×</a>
				Wrong email or password</div>";
			} //end of else part
		} //end of if part
		else{}

	} //end of else
} //end of function cover


//notification
function notification(){

	//globally declaring variable
	global $con;

	//if logged in as teacher

	if(isset($_SESSION['staff_email'])){
		
		$session = $_SESSION['staff_email'];

		$staff_selection = "select * from members where email='$session'";
		$run_staff_selection = mysqli_query($con, $staff_selection);

		while($row = mysqli_fetch_array($run_staff_selection)){
			$name = $row['name'];
			$email = $row['email'];

			echo "
				<!-- Name -->
				<h2 class='text-center' style='color: #f0f0f0;''>Welcome 
					<small>$name</small>
				</h2>

				<hr style='border: 1px solid #818181; width: 70%; opacity: 0.3;'>
				
				<!-- clear all notifications -->
				<a href='' class='clear text-right'>
					<i class='fa fa-trash-o'></i>clear all
				</a>
				
			";
		}
		
		$notification = "select * from notification where email='$email'";
		$run_notification = mysqli_query($con, $notification);
		$count = mysqli_num_rows($run_notification);
		while($row_notification = mysqli_fetch_array($run_notification)){
			$id = $row_notification['id'];
			$message = $row_notification['message'];

			if($count == 0){
				echo "
					<!-- display all nptifications -->
					<div class='container-fluid'>
						<div class='row'>
							<div class='col-md-10' style='color: #f0f0f0;'>
								<a href=''>No new notification</a>
							</div>
						</div><!-- row -->
					</div> <!-- container fluid -->
				";
			}
			else{
				echo "
					<!-- display all nptifications -->
					<div class='container-fluid'>
						<div class='row'>
							<div class='col-md-10' style='color: #f0f0f0;'>
								<a href=''>$message <span style='font-size: 15px; color:#888'><small>(10 minutes ago)</small></span></a>
							</div>
							<div class='col-md-1'>
								<a href=''>&times;</a>
							</div>
						</div><!-- row -->
					</div> <!-- container fluid -->						
				";
			}

		} //end of while

		
	} //end of if

	//else if logged in as student
	elseif(isset($_SESSION['stu_email'])){

		$session = $_SESSION['stu_email'];

		$stu_selection = "select * from members where email='$session'";
		$run_stu_selection = mysqli_query($con, $stu_selection);

		while($row = mysqli_fetch_array($run_stu_selection)){
			$name = $row['name'];
			$email = $row['email'];

			echo "
				<!-- Name -->
				<h2 class='text-center' style='color: #f0f0f0;''>Welcome 
					<small>$name</small>
				</h2>

				<hr style='border: 1px solid #818181; width: 70%; opacity: 0.3;'>
				
				<!-- clear all notifications -->
				<a href='' class='clear text-right'>
					<i class='fa fa-trash-o'></i>clear all
				</a>
				
			";
		}


		$notification = "select * from notification where email='$email'";
		$run_notification = mysqli_query($con, $notification);
		$count = mysqli_num_rows($run_notification);

		while($row_notification = mysqli_fetch_array($run_notification)){

			$id = $row_notification['id'];
			$message = $row_notification['message'];
			$date_time = $row_notification['date_time'];

			$result = nicetime($date_time);
			if($count == 0){
				echo "
					<!-- display all nptifications -->
					<div class='container-fluid'>
						<div class='row'>
							<div class='col-md-10' style='color: #f0f0f0;'>
								<a href=''>No new notification</a>
							</div>
						</div><!-- row -->
					</div> <!-- container fluid -->
				";
			}
			else{
				echo "
					<!-- display all nptifications -->
					<div class='container-fluid'>
						<div class='row'>
							<div class='col-md-10' style='color: #f0f0f0;'>
								<a href=''>$message <span style='font-size: 15px; color:#888'><small>($result)</small></span></a>
							</div>
							<div class='col-md-1'>
								<a href=''>&times;</a>
							</div>
						</div><!-- row -->
					</div> <!-- container fluid -->						
				";
			}

		} //end of while

	} //end of else if

	//if not logged in
	else{
		echo "
			<!-- if not logged in -->
			<div class='container-fluid'>
				<div class='row'>
					<div class='col-md-12'>
						<p style='color: #f0f0f0;'>
							<a href=''>
								Login / Sign Up to receive all the notifications.
							</a>
						</p>
					</div>
				</div>
			</div>
		";
	} // end of else
} //end of function notification


//my account function
function myAccount(){
	//if logged in as teacher
	if(isset($_SESSION['staff_email'])){
		echo "
			<a href='staff_area/index.php' class='nav-link'>My Account</a>
		";
	} //end of if

	//else if logged in as student
	elseif(isset($_SESSION['stu_email'])){
		echo "
			<a href='stu_area/index.php' class='nav-link'>My Account</a>
		";
	} //end of else if

	//if not logged in
	else{
		echo "
			<li class='nav-item dropdown'>

		        <a href='' class='nav-link' id='navbarDropdownMenuLink' data-toggle='dropdown'>My Account</a>
		    
		        <div class='dropdown-menu'>
		          <a class='dropdown-item' href='staff_login.php'>Teacher's Login</a>
		          <a class='dropdown-item' href='stu_login.php'>Student's Login</a>
		        </div>
		    </li>
		";
	} //end of else
} //end of function my account


################################ student area ################################

//stuent's profile
function stuProfile(){

	//globally declaring connection
	global $con;

	//fetching student's information
	$session = $_SESSION['stu_email'];

	$stu_selection = "select * from members where email='$session'";
	$run_stu_selection = mysqli_query($con, $stu_selection);

	while($row = mysqli_fetch_array($run_stu_selection)){
		$id = $row['id'];
		$name = $row['name'];
		$email = $row['email'];
		$image = $row['image'];
		$sem = $row['sem'];

		$posts = "select * from posts where member_id='$id'";
		$run_posts = mysqli_query($con, $posts);
		$count = mysqli_num_rows($run_posts);

		echo "
			<div class='row'>

				<div class='col-md-12 profile text-center rounded' style='border: 1px solid transparent; background-color: #fff;'>
					<img src='../images/$image' alt='' class='img-fluid rounded-circle profile-picture' width='100px' style='margin-top: -50px;'>
					
					<h5>$name</h5>
						
						<form action='' class='form' method='post' role='form' enctype='multipart/form-data'>
							<p class='text-muted'>
								What's Up fellas!
							</p>
						</form>
					
					<div class='row'>
						<div class='col-md-6 col-lg-6 col-sm-6' style='border-right: 5px solid #e7e7e7;'>
							Total Posts
							<h6>$count</h6>
						</div>
						<div class='col-md-6 col-lg-6 col-sm-6'>
							Sem
							<h6>$sem</h6>
						</div>
					</div> <!-- row -->
				</div> <!-- profile -->
			</div> <!-- row -->
			
			<div class='row'>
				<div class='col-md-12 about rounded' style='border: 1px solid transparent; margin-top: 3%; background-color: #fff; padding: 10px;'>
					<h5>About 
						<span style='font-size: 15px'>
							<a href=''>Edit</a>
						</span>
					</h5>
					<div class='row' style='font-size: 14px;'>
						<ul style='list-style-type: none; margin-left: -35px; line-height: 30px;'>
							<li class='col-md-12'>
								<i class='fa fa-graduation-cap about-links'></i> Went to <a href=''>MIMIT</a>
							</li>
							<li class='col-md-12'>
								<i class='fa fa-briefcase about-links'></i> Worked at <a href=''>Student</a>
							</li>
							<li class='col-md-12'>
								<span class='fa fa-home about-links'></span> Lives in <a href=''>Malout, India</a>
							</li>
							<li class='col-md-12'>
								<i class='fa fa-map-marker about-links'></i> From <a href=''>Malout, India</a>
							</li>
							<li class='col-md-12'>
								<i class='fa fa-rss about-links'></i> Followed by <a href=''>61 people</a>
							</li>
						</ul>
					</div>
				</div> <!-- about -->
			</div> <!-- row -->
			
			<div class='row'>
				<div class='col-md-12 photos rounded' style='border: 1px solid transparent; margin-top: 3%; background-color: #fff; padding: 10px;'>
					<h5>Photos 
						<span style='font-size: 15px'>
							<a href=''>(50)</a>
						</span>
					</h5>
					<div class='row'>
						<div class='col-md-5 col-lg-5 col-sm-5 text-center' style='margin: 10px 10px 0px 0px;'>
							<img src='../images/1.png' alt='' class='rounded' width='100px'>
						</div>
						<div class='col-md-5 col-lg-5 col-sm-5 text-center' style='margin: 10px 10px 0px 0px;'>
							<img src='../images/1.png' alt='' class='rounded' width='100px'>
						</div>
						<div class='col-md-5 col-lg-5 col-sm-5 text-center' style='margin: 10px 10px 0px 0px;'>
							<img src='../images/1.png' alt='' class='rounded' width='100px'>
						</div>
						<div class='col-md-5 col-lg-5 col-sm-5 text-center' style='margin: 10px 10px 0px 0px;'>
							<img src='../images/1.png' alt='' class='rounded' width='100px'>
						</div>
						<div class='col-md-5 col-lg-5 col-sm-5 text-center' style='margin: 10px 10px 0px 0px;'>
							<img src='../images/1.png' alt='' class='rounded' width='100px'>
						</div>
						<div class='col-md-5 col-lg-5 col-sm-5 text-center' style='margin: 10px 10px 0px 0px;'>
							<img src='../images/1.png' alt='' class='rounded' width='100px'>
						</div>
						<div class='col-md-12'>
							<a href='' class='float-right'>See All &raquo;</a>
						</div>
					</div>
				</div> <!-- photos -->
			</div> <!-- row -->
		";
	} //end of while
} // end of function stu profile


//function to display posts of students
function stuPosts(){
	
	global $con;
	$session = $_SESSION['stu_email'];

	$details = "select * from members where email='$session'";
	$run = mysqli_query($con, $details);

	while($row = mysqli_fetch_array($run)){
		$member_id = $row['id'];
		$name = $row['name'];
		$designation = $row['designation'];
		$image = $row['image'];

		$posts = "select * from posts where member_id='$member_id' order by id DESC";
		$runPosts = mysqli_query($con, $posts);

		while($rowPosts = mysqli_fetch_array($runPosts)){

			$id = $rowPosts['id'];
			$title = $rowPosts['title'];
			$content = $rowPosts['content'];
			$date = $rowPosts['date'];
			$no_of_comments = $rowPosts['no_of_comments'];
			$no_of_likes = $rowPosts['no_of_likes'];

			$result = nicetime($date);

			echo "
					<div class='row posts'>
						<div class='col-md-2 text-center'>
							<img src='images/$image' alt='' class='img-fluid rounded-circle' width='60px'>
						</div>
						<div class='col-md-10'>
							<h4>$title
								<span class='float-right text-muted' style='font-weight: normal; font-size: 14px; padding-top: 8px;'>
									By <span class='active'>
											<a href='../members.php?id=$member_id' style='color: inherit;'>
												$name
											</a>
										</span> $result
								</span>
							</h4>
							<p>
								$content <a href='../details.php?post_id=$id'>more &raquo;</a>

								<span>
									
								</span>
							</p>
							";
							
							
				$likes = "select * from likes where post_id='$id'";
				$run_likes = mysqli_query($con, $likes);
				$count = mysqli_num_rows($run_likes);

				if($count == 0){
					echo"
							<div style='border-top: 1px solid lightgrey'>
								<form action='' class='form' method='post' role='form' enctype='multipart/form-data'>
									<!-- like button -->
									<button type='submit' name='like' class='btn btn-link text-gray-dark' value='$id'>
										<i class='fa fa-thumbs-up'></i> Like($no_of_likes)
									</button>

									<!-- comment button -->
									<button type='submit' class='btn btn-link text-gray-dark' value='$id'>
										<i class='fa fa-comments'></i> <a href='../details.php?post_id=$id' style='color: inherit;'>Comment</a>($no_of_comments)
									</button>
									
									<!-- share button -->
									<button type='submit' class='btn btn-link text-gray-dark'>
										<i class='fa fa-share'></i> Share
									</button>
								</form>
							</div>
						</div> <!-- col md 10 -->
					</div> <!-- posts -->
				";

				}
				else{
					while($row_likes = mysqli_fetch_array($run_likes)){
						$post_id = $row_likes['post_id'];
						$member = $row_likes['member_id'];
						$button = $row_likes['button'];

						if($member = $member_id){
							echo "

									<div style='border-top: 1px solid lightgrey'>
										<form action='' class='form' method='post' role='form' enctype='multipart/form-data'>
											<!-- like button -->
											<button type='submit' name='unlike' class='btn btn-link text-gray-dark' value='$id'>
												<i class='fa fa-thumbs-up'></i> Unlike($no_of_likes)
											</button>

											<!-- comment button -->
											<button type='submit' class='btn btn-link text-gray-dark' value='$id'>
												<i class='fa fa-comments'></i> <a href='../details.php?post_id=$id' style='color: inherit;'>Comment</a>($no_of_comments)
											</button>
											
											<!-- share button -->
											<button type='submit' class='btn btn-link text-gray-dark'>
												<i class='fa fa-share'></i> Share
											</button>
										</form>
									</div>
								</div> <!-- col md 10 -->
							</div> <!-- posts -->

							";

						} //end of if
						else{
							echo "

									<div style='border-top: 1px solid lightgrey'>
										<form action='' class='form' method='post' role='form' enctype='multipart/form-data'>
											<!-- like button -->
											<button type='submit' name='like' class='btn btn-link text-gray-dark' value='$id'>
												<i class='fa fa-thumbs-up'></i> Like($no_of_likes)
											</button>

											<!-- comment button -->
											<button type='submit' class='btn btn-link text-gray-dark' value='$id'>
												<i class='fa fa-comments'></i> <a href='../details.php?post_id=$id' style='color: inherit;'>Comment</a>($no_of_comments)
											</button>
											
											<!-- share button -->
											<button type='submit' class='btn btn-link text-gray-dark'>
												<i class='fa fa-share'></i> Share
											</button>
										</form>
									</div>
								</div> <!-- col md 10 -->
							</div> <!-- posts -->


							";
						} //ned of else

					} //end of while
				} //end of else
							
			} //end of while

		} //end of while

		echo "

			<div class='row'>
				<button type='button' class='btn btn-block btn-outline-info'>Show more <i class='fa fa-angle-double-down'></i></button>
			</div>

		";

} // end of function


################################ staff area ################################

//staff's profile function
function staffProfile(){

	//globally declaring connection
	global $con;

	//fetching staff's information
	$session = $_SESSION['staff_email'];

	$staff_selection = "select * from members where email='$session'";
	$run_staff_selection = mysqli_query($con, $staff_selection);

	while($row = mysqli_fetch_array($run_staff_selection)){
		$id = $row['id'];
		$name = $row['name'];
		$email = $row['email'];
		$image = $row['image'];

		$posts = "select * from posts where member_id='$id'";
		$run_posts = mysqli_query($con, $posts);
		$count = mysqli_num_rows($run_posts);

		echo "
			<div class='row'>

				<div class='col-md-12 profile text-center rounded' style='border: 1px solid transparent; background-color: #fff;'>
					<img src='../images/$image' alt='' class='img-fluid rounded-circle profile-picture' width='100px' style='margin-top: -50px;'>
					
					<h5>$name</h5>
						
						<form action='' class='form' method='post' role='form' enctype='multipart/form-data'>
							<p class='text-muted'>
								What's Up fellas!
							</p>
						</form>
					
					<div class='row'>
						<div class='col-md-6 col-lg-6 col-sm-6' style='border-right: 5px solid #e7e7e7;'>
							Total Posts
							<h6>$count</h6>
						</div>
						<div class='col-md-6 col-lg-6 col-sm-6'>
							Designation
							<h6>Teacher</h6>
						</div>
					</div> <!-- row -->
				</div> <!-- profile -->
			</div> <!-- row -->
			
			<div class='row'>
				<div class='col-md-12 about rounded' style='border: 1px solid transparent; margin-top: 3%; background-color: #fff; padding: 10px;'>
					<h5>About 
						<span style='font-size: 15px'>
							<a href=''>Edit</a>
						</span>
					</h5>
					<div class='row' style='font-size: 14px;'>
						<ul style='list-style-type: none; margin-left: -35px; line-height: 30px;'>
							<li class='col-md-12'>
								<i class='fa fa-file about-links'></i> <a href='' data-toggle='modal' data-target='#semester'>Subjects & Semesters</a> you teach.
							</li>
							<li class='col-md-12'>
								<i class='fa fa-graduation-cap about-links'></i> Went to <a href=''>MIMIT</a>
							</li>
							<li class='col-md-12'>
								<i class='fa fa-briefcase about-links'></i> Worked at <a href=''>Student</a>
							</li>
							<li class='col-md-12'>
								<span class='fa fa-home about-links'></span> Lives in <a href=''>Malout, India</a>
							</li>
							<li class='col-md-12'>
								<i class='fa fa-map-marker about-links'></i> From <a href=''>Malout, India</a>
							</li>
						</ul>
					</div>
				</div> <!-- about -->
			</div> <!-- row -->
			
			<div class='row'>
				<div class='col-md-12 photos rounded' style='border: 1px solid transparent; margin-top: 3%; background-color: #fff; padding: 10px;'>
					<h5>Photos 
						<span style='font-size: 15px'>
							<a href=''>(50)</a>
						</span>
					</h5>
					<div class='row'>
						<div class='col-md-5 col-lg-5 col-sm-5 text-center' style='margin: 10px 10px 0px 0px;'>
							<img src='../images/1.png' alt='' class='rounded' width='100px'>
						</div>
						<div class='col-md-5 col-lg-5 col-sm-5 text-center' style='margin: 10px 10px 0px 0px;'>
							<img src='../images/1.png' alt='' class='rounded' width='100px'>
						</div>
						<div class='col-md-5 col-lg-5 col-sm-5 text-center' style='margin: 10px 10px 0px 0px;'>
							<img src='../images/1.png' alt='' class='rounded' width='100px'>
						</div>
						<div class='col-md-5 col-lg-5 col-sm-5 text-center' style='margin: 10px 10px 0px 0px;'>
							<img src='../images/1.png' alt='' class='rounded' width='100px'>
						</div>
						<div class='col-md-5 col-lg-5 col-sm-5 text-center' style='margin: 10px 10px 0px 0px;'>
							<img src='../images/1.png' alt='' class='rounded' width='100px'>
						</div>
						<div class='col-md-5 col-lg-5 col-sm-5 text-center' style='margin: 10px 10px 0px 0px;'>
							<img src='../images/1.png' alt='' class='rounded' width='100px'>
						</div>
						<div class='col-md-12'>
							<a href='' class='float-right'>See All &raquo;</a>
						</div>
					</div>
				</div> <!-- photos -->
			</div> <!-- row -->
		";
	} // end of while

} //end of function staff profile

//function to display all semesters taught by particular staff member
function semesters(){

	global $con;

	$session = $_SESSION['staff_email'];
	$staff = "select * from members where email='$session'";
	$run_staff = mysqli_query($con, $staff);

	$row = mysqli_fetch_array($run_staff);

	$id = $row['id'];
	$semester = "select * from staff where staff_id='$id'";
	$run_sem = mysqli_query($con, $semester);

	while($row_sem = mysqli_fetch_array($run_sem)){
		$id = $row_sem['id'];
		$staff_id = $row_sem['staff_id'];
		$sem = $row_sem['sem'];
		$subjects = $row_sem['subjects'];

		echo "<button type='button' class='btn btn-link'>$subjects : $sem (Semester)</button>";

	}

}


//function to display posts of students
function staffPosts(){
	
	global $con;
	$session = $_SESSION['staff_email'];

	$details = "select * from members where email='$session'";
	$run = mysqli_query($con, $details);

	while($row = mysqli_fetch_array($run)){
		$member_id = $row['id'];
		$name = $row['name'];
		$designation = $row['designation'];
		$image = $row['image'];

		$posts = "select * from posts where member_id='$member_id' order by id DESC";
		$runPosts = mysqli_query($con, $posts);

		while($rowPosts = mysqli_fetch_array($runPosts)){

			$id = $rowPosts['id'];
			$title = $rowPosts['title'];
			$content = $rowPosts['content'];
			$date = $rowPosts['date'];
			$no_of_comments = $rowPosts['no_of_comments'];
			$no_of_likes = $rowPosts['no_of_likes'];

			$result = nicetime($date);

			echo "
					<div class='row posts'>
						<div class='col-md-2 text-center'>
							<img src='images/$image' alt='' class='img-fluid rounded-circle' width='60px'>
						</div>
						<div class='col-md-10'>
							<h4>$title
								<span class='float-right text-muted' style='font-weight: normal; font-size: 14px; padding-top: 8px;'>
									By <span class='active'>
											<a href='../members.php?id=$member_id' style='color: inherit;'>
												$name
											</a>
										</span> $result
								</span>
							</h4>
							<p>
								$content <a href='../details.php?post_id=$id'>more &raquo;</a>
							</p>
							";
							
							
				$likes = "select * from likes where post_id='$id'";
				$run_likes = mysqli_query($con, $likes);
				$count = mysqli_num_rows($run_likes);

				if($count == 0){
					echo"
							<div style='border-top: 1px solid lightgrey'>
								<form action='' class='form' method='post' role='form' enctype='multipart/form-data'>
									<!-- like button -->
									<button type='submit' name='like' class='btn btn-link text-gray-dark' value='$id'>
										<i class='fa fa-thumbs-up'></i> Like($no_of_likes)
									</button>

									<!-- comment button -->
									<button type='submit' class='btn btn-link text-gray-dark' value='$id'>
										<i class='fa fa-comments'></i> <a href='../details.php?post_id=$id' style='color: inherit;'>Comment</a>($no_of_comments)
									</button>
									
									<!-- share button -->
									<button type='submit' class='btn btn-link text-gray-dark'>
										<i class='fa fa-share'></i> Share
									</button>
								</form>
							</div>
						</div> <!-- col md 10 -->
					</div> <!-- posts -->
				";

				}
				else{
					while($row_likes = mysqli_fetch_array($run_likes)){
						$post_id = $row_likes['post_id'];
						$member = $row_likes['member_id'];
						$button = $row_likes['button'];

						if($member = $member_id){
							echo "

									<div style='border-top: 1px solid lightgrey'>
										<form action='' class='form' method='post' role='form' enctype='multipart/form-data'>
											<!-- like button -->
											<button type='submit' name='unlike' class='btn btn-link text-gray-dark' value='$id'>
												<i class='fa fa-thumbs-up'></i> Unlike($no_of_likes)
											</button>

											<!-- comment button -->
											<button type='submit' class='btn btn-link text-gray-dark' value='$id'>
												<i class='fa fa-comments'></i> <a href='../details.php?post_id=$id' style='color: inherit;'>Comment</a>($no_of_comments)
											</button>
											
											<!-- share button -->
											<button type='submit' class='btn btn-link text-gray-dark'>
												<i class='fa fa-share'></i> Share
											</button>
										</form>
									</div>
								</div> <!-- col md 10 -->
							</div> <!-- posts -->

							";

						} //end of if
						else{
							echo "

									<div style='border-top: 1px solid lightgrey'>
										<form action='' class='form' method='post' role='form' enctype='multipart/form-data'>
											<!-- like button -->
											<button type='submit' name='like' class='btn btn-link text-gray-dark' value='$id'>
												<i class='fa fa-thumbs-up'></i> Like($no_of_likes)
											</button>

											<!-- comment button -->
											<button type='submit' class='btn btn-link text-gray-dark' value='$id'>
												<i class='fa fa-comments'></i> <a href='../details.php?post_id=$id' style='color: inherit;'>Comment</a>($no_of_comments)
											</button>
											
											<!-- share button -->
											<button type='submit' class='btn btn-link text-gray-dark'>
												<i class='fa fa-share'></i> Share
											</button>
										</form>
									</div>
								</div> <!-- col md 10 -->
							</div> <!-- posts -->


							";
						} //ned of else

					} //end of while
				} //end of else
							
			} //end of while

		} //end of while

		echo "

			<div class='row'>
				<button type='button' class='btn btn-block btn-outline-info'>Show more <i class='fa fa-angle-double-down'></i></button>
			</div>

		";

} // end of function


//current date and time
function nicetime($date)
    {
    if(empty($date)) {
        return "No date provided";
    }

    $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
    $lengths = array("60","60","24","7","4.35","12","10");

    $now = time();
    $unix_date = strtotime($date);

    // check validity of date
    if(empty($unix_date)) {    
        return "Bad date";
    }

    // is it future date or past date
    if($now > $unix_date) {    
        $difference = $now - $unix_date;
        $tense = "ago";

    }
    else {
        $difference = $unix_date - $now;
        $tense = "from now";
    }

    for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
        $difference /= $lengths[$j];
    }

    $difference = round($difference);

    if($difference != 1) {
        $periods[$j].= "s";
    }

    return "$difference $periods[$j] {$tense}";
} //end of function nicetime


//function to display all posts
function allPosts(){

	//globally declaring connection variable
	global $con;

	$limit = 10;

	$posts = "select *,substring(content, 1, 500) from posts order by rand() limit 0,10";
	$run_posts = mysqli_query($con, $posts);

	//counting the number of rows
	$num_rows = mysqli_num_rows($run_posts);

	if($num_rows == 0){
		echo "
			<div class='alert alert-heading'>
				<h2>No posts yet.</h2>
			</div>
		";
	} //end of if 

	else{

		while($row = mysqli_fetch_array($run_posts)){

			$id = $row['id'];
			$member_id = $row['member_id'];
			$title = $row['title'];
			$content = $row['substring(content, 1, 500)'];
			$date_time = $row['date'];
			$no_of_comments = $row['no_of_comments'];
			$no_of_likes = $row['no_of_likes'];

			$members = "select * from members where id='$member_id'";
			$run_members = mysqli_query($con, $members);

			while($row_members = mysqli_fetch_array($run_members)){

				$name = $row_members['name'];
				$image = $row_members['image'];

				$date = $date_time;
				$result = nicetime($date);

				echo "
					<div class='row posts'>
						<div class='col-md-2 text-center'>
							<img src='images/$image' alt='' class='img-fluid rounded-circle' width='60px'>
						</div>
						<div class='col-md-10'>
							<h4>$title
								<span class='float-right text-muted' style='font-weight: normal; font-size: 14px; padding-top: 8px;'>
									By <span class='active'>
											<a href='members.php?id=$member_id' style='color: inherit;'>
												$name
											</a>
										</span> $result
								</span>
							</h4>
							<p>
								$content <a href='details.php?post_id=$id'>more &raquo;</a>

								<span>
									
								</span>
							</p>
							";
							
							
				$likes = "select * from likes where post_id='$id'";
				$run_likes = mysqli_query($con, $likes);
				$count = mysqli_num_rows($run_likes);

				if($count == 0){
					echo"
							<div style='border-top: 1px solid lightgrey'>
								<form action='' class='form' method='post' role='form' enctype='multipart/form-data'>
									<!-- like button -->
									<button type='submit' name='like' class='btn btn-link text-gray-dark' value='$id'>
										<i class='fa fa-thumbs-up'></i> Like($no_of_likes)
									</button>

									<!-- comment button -->
									<button type='submit' class='btn btn-link text-gray-dark' value='$id'>
										<i class='fa fa-comments'></i> <a href='details.php?post_id=$id' style='color: inherit;'>Comment</a>($no_of_comments)
									</button>
									
									<!-- share button -->
									<button type='submit' class='btn btn-link text-gray-dark'>
										<i class='fa fa-share'></i> Share
									</button>
								</form>
							</div>
						</div> <!-- col md 10 -->
					</div> <!-- posts -->
				";

				}
				else{
					while($row_likes = mysqli_fetch_array($run_likes)){
						$post_id = $row_likes['post_id'];
						$member = $row_likes['member_id'];
						$button = $row_likes['button'];

						if($member = $member_id){
							echo "

									<div style='border-top: 1px solid lightgrey'>
										<form action='' class='form' method='post' role='form' enctype='multipart/form-data'>
											<!-- like button -->
											<button type='submit' name='unlike' class='btn btn-link text-gray-dark' value='$id'>
												<i class='fa fa-thumbs-up'></i> Unlike($no_of_likes)
											</button>

											<!-- comment button -->
											<button type='submit' class='btn btn-link text-gray-dark' value='$id'>
												<i class='fa fa-comments'></i> <a href='details.php?post_id=$id' style='color: inherit;'>Comment</a>($no_of_comments)
											</button>
											
											<!-- share button -->
											<button type='submit' class='btn btn-link text-gray-dark'>
												<i class='fa fa-share'></i> Share
											</button>
										</form>
									</div>
								</div> <!-- col md 10 -->
							</div> <!-- posts -->

							";

						} //end of if
						else{
							echo "

									<div style='border-top: 1px solid lightgrey'>
										<form action='' class='form' method='post' role='form' enctype='multipart/form-data'>
											<!-- like button -->
											<button type='submit' name='like' class='btn btn-link text-gray-dark' value='$id'>
												<i class='fa fa-thumbs-up'></i> Like($no_of_likes)
											</button>

											<!-- comment button -->
											<button type='submit' class='btn btn-link text-gray-dark' value='$id'>
												<i class='fa fa-comments'></i> <a href='details.php?post_id=$id' style='color: inherit;'>Comment</a>($no_of_comments)
											</button>
											
											<!-- share button -->
											<button type='submit' class='btn btn-link text-gray-dark'>
												<i class='fa fa-share'></i> Share
											</button>
										</form>
									</div>
								</div> <!-- col md 10 -->
							</div> <!-- posts -->


							";
						} //ned of else

					} //end of while
				} //end of else
							
			} //end of while

		} //end of while

		echo "
			<div class='row'>
				<div class='col-md-12'>
					<form action='' class='form' method='post' role='form' enctype='multipart/form-data'>
						<button type='submit' name='button' class='btn btn-block btn-outline-danger'>Show more <i class='fa fa-angle-double-down'></i></button>
					</form>		
				</div>
			</div>
		";

	} //end of else

} //end of function posts


//recent post
function recentPost(){
	//globally declaring connection variable
	global $con;

	$posts = "select *,substring(content,1,100) from posts order by id DESC limit 0,10";
	$run_posts = mysqli_query($con, $posts);

	//counting the number of rows
	$num_rows = mysqli_num_rows($run_posts);

	if($num_rows == 0){
		echo "
			<div class='alert alert-heading'>
				<h2>No posts yet.</h2>
			</div>
		";
	} //end of if 

	else{

		while($row = mysqli_fetch_array($run_posts)){

			$id = $row['id'];
			$member_id = $row['member_id'];
			$title = $row['title'];
			$content = $row['substring(content,1,100)'];
			$date_time = $row['date'];
			$no_of_comments = $row['no_of_comments'];
			$no_of_likes = $row['no_of_likes'];

			$members = "select * from members where id='$member_id'";
			$run_members = mysqli_query($con, $members);

			while($row_members = mysqli_fetch_array($run_members)){

				$name = $row_members['name'];
				$image = $row_members['image'];

				$date = $date_time;
				$result = nicetime($date);

				echo "
					<p class='text-muted'>
						$content <a href='details.php?post_id=$id'>more &raquo;</a>
					</p>
					<hr>
				";
			}
		} //end of while
	} //end of else
}

//function to display events
function events(){

	global $con;

	$event = "select * from events order by id DESC";
	$run_event = mysqli_query($con, $event);
	$count = mysqli_num_rows($run_event);

	if($count == 0){
		echo "<p class='text-muted'>No event at this moment.</p>";
	} //end of if
	else{
		while($row = mysqli_fetch_array($run_event)){
			$id = $row['id'];
			$events = $row['events'];
			$date = $row['date'];

			$result = nicetime($date);

			echo "<p class='text-muted posts'>$events <a href=''>more &raquo;</a> <span style='color: red'>$result</span></p>";
		} //end of while
	} //end of else
}

//details of posts
function postDetails(){

	//globally declaring connection variable
	global $con;

	//if id exists
	if(isset($_GET['post_id'])){
		$id = $_GET['post_id'];

		//fetching the post
		$post = "select * from posts where id='$id'";
		$run = mysqli_query($con, $post);



		while($row = mysqli_fetch_array($run)){

			//$id = $row['id'];
			$member_id = $row['member_id'];
			$title = $row['title'];
			$content = $row['content'];
			$date_time = $row['date'];
			$no_of_comments = $row['no_of_comments'];
			$no_of_likes = $row['no_of_likes'];

			$members = "select * from members where id='$member_id'";
			$run_members = mysqli_query($con, $members);

			while($row_members = mysqli_fetch_array($run_members)){

				$name = $row_members['name'];
				$image = $row_members['image'];

				$date = $date_time;
				$result = nicetime($date);

				echo "
					<div class='row post-details'>
						<div class='col-md-2 text-center'>
							<img src='images/$image' alt='' class='img-fluid rounded-circle' width='60px'>
						</div>

						<div class='col-md-10'>
							<h4>$title
								<span class='float-right text-muted' style='font-weight: normal; font-size: 14px; padding-top: 8px;'>
									By <span class='active'>
											<a href='members.php?id=$member_id' style='color: inherit;'>$name</a>
										</span> $result
								</span>
							</h4>
							<p>
								$content
							</p>
				";
							
							
				$likes = "select * from likes where post_id='$id'";
				$run_likes = mysqli_query($con, $likes);
				$count = mysqli_num_rows($run_likes);

				if($count == 0){
					echo"
							<div style='border-top: 1px solid lightgrey'>
								<form action='' class='form' method='post' role='form' enctype='multipart/form-data'>
									<!-- like button -->
									<button type='submit' name='like' class='btn btn-link text-gray-dark' value='$id'>
										<i class='fa fa-thumbs-up'></i> Like($no_of_likes)
									</button>
									
									<!-- share button -->
									<button type='submit' class='btn btn-link text-gray-dark'>
										<i class='fa fa-share'></i> Share
									</button>
								</form>
							</div>
						</div> <!-- col md 10 -->
					</div> <!-- posts -->
				";

				}
				else{
					while($row_likes = mysqli_fetch_array($run_likes)){
						$post_id = $row_likes['post_id'];
						$member = $row_likes['member_id'];
						$button = $row_likes['button'];

						if($member = $member_id){
							echo "

									<div style='border-top: 1px solid lightgrey'>
										<form action='' class='form' method='post' role='form' enctype='multipart/form-data'>
											<!-- like button -->
											<button type='submit' name='unlike' class='btn btn-link text-gray-dark' value='$id'>
												<i class='fa fa-thumbs-up'></i> Unlike($no_of_likes)
											</button>
											
											<!-- share button -->
											<button type='submit' class='btn btn-link text-gray-dark'>
												<i class='fa fa-share'></i> Share
											</button>
										</form>
									</div>
								</div> <!-- col md 10 -->
							</div> <!-- posts -->

							";

						} //end of if
						else{
							echo "

									<div style='border-top: 1px solid lightgrey'>
										<form action='' class='form' method='post' role='form' enctype='multipart/form-data'>
											<!-- like button -->
											<button type='submit' name='like' class='btn btn-link text-gray-dark' value='$id'>
												<i class='fa fa-thumbs-up'></i> Like($no_of_likes)
											</button>
											
											<!-- share button -->
											<button type='submit' class='btn btn-link text-gray-dark'>
												<i class='fa fa-share'></i> Share
											</button>
										</form>
									</div>
								</div> <!-- col md 10 -->
							</div> <!-- posts -->


							";
						} //ned of else

					} //end of while
				} //end of else
							
			} //end of while

		} //end of while

	//if user is logged in
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
						echo "<script>window.open('details.php?post_id=$like_id','_self')</script>"; //reloads the whole page			
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
						echo "<script>window.open('details.php?post_id=$unlike_id','_self')</script>"; //reloads the whole page			
					} //end of if
				} //end of while

			} //end of if
		} //end of elseif

		else{}
		}
}


//comments on a post
function comments(){

	//globally declaring connection variable
	global $con;

	//if id exists
	if(isset($_GET['post_id'])){
		$id = $_GET['post_id'];

		$comments = "select * from comments where post_id='$id' order by id DESC";
		$run_comments = mysqli_query($con, $comments);

		$num_comments = mysqli_num_rows($run_comments);

		if($num_comments == 0){
			echo "
				<h5>There are no comments at this moment</h5>
			";	
		}

		else{
			while($row = mysqli_fetch_array($run_comments)){
				$comment_id = $row['id'];
				$member_id = $row['member_id'];
				$comment = $row['comment'];
				$date_time = $row['date_time'];
				$no_of_likes = $row['no_of_likes'];

				$member = "select * from members where id='$member_id'";
				$run_member = mysqli_query($con, $member);

				while($row_member = mysqli_fetch_array($run_member)){

					$name = $row_member['name'];
					$image = $row_member['image'];

					$date = $date_time;
					$result = nicetime($date);


					echo "
						<div class='row' style='border-bottom: 1px solid #e7e7e7; padding: 5px;'>
							<div class='col-md-2 text-center'>
								<img src='images/$image' alt='' class='img-fluid rounded-circle' style='width: 60px;'>
							</div> <!-- col md 2 -->
							<div class='col-md-10'>
								
								<h4 class='text-warning'>
									
									<div class='row'>
										<div class='col-md-12'>
											<div class='row'>
												<div class='col-md-5'>
													$name
												</div>
												<div class='col-md-7 text-right'>
													<form action='' class='form' method='post' role='form' enctype='multipart/form-data'>
														<!-- like button -->
														<button type='submit' name='like' class='btn btn-link text-success' value='$comment_id'>
															<i class='fa fa-thumbs-up'></i> Like($no_of_likes)
														</button>
														
														<!-- report button -->
														<button type='submit' class='btn btn-link' value='$comment_id'>
															<i class='fa fa-warning'></i> Report
														</button>
														
														<!-- delete button -->
														<!-- <button type='submit' class='btn btn-link text-danger' value='$comment_id'>
															<i class='fa fa-trash'></i> Delete
														</button> -->
													</form>
												</div> <!-- col md 7 -->
											</div> <!-- row -->
										</div> <!-- col md 12 -->
									</div> <!-- row -->

								</h4>

								<p>
									$comment 
									<span class='float-md-right text-muted' style='font-weight: normal; font-size: 14px; padding-top: 8px;'>
										$result
									</span>
								</p>

							</div> <!-- col md 10 -->
							
						</div> <!-- row -->
					";
				} //end of while loop
			} //emd of while loop
		} //end of else
	} //end of if
}


//function to insert comment
function insertComment(){
	
	global $con;

	if(isset($_POST['submitComment'])){

		if(isset($_SESSION['staff_email']) || isset($_SESSION['stu_email'])){
		
			if(isset($_SESSION['staff_email'])){
				$mail = $_SESSION['staff_email'];

				$select = "select * from members where email='$mail'";
				$run = mysqli_query($con, $select);

				$row = mysqli_fetch_array($run);

				$id = $row['id'];
				$comment = $_POST['comment'];

				$post_id = $_GET['post_id'];

				$date_time = date('Y-m-d H:i:s');

				$insertComment = "insert into comments (post_id, member_id, comment, date_time) values ('$post_id', '$id', '$comment', '$date_time')";
				$run_insert = mysqli_query($con, $insertComment);

				$get_post = "select * from posts where id='$post_id'";
				$run_post = mysqli_query($con, $get_post);
				while($row_post = mysqli_fetch_array($run_post)){
					$comments = $row_post['no_of_comments'];

					//increment number of likes with 1
					$new_comments = $comments+1;

					$insert = "update posts set no_of_comments=$new_comments where id='$post_id'";
					$run_insert = mysqli_query($con,$insert);

					if($run_insert){
						header("Refresh:0"); //reloads the whole page			
					} //end of if
				} //end of while
			} //end of if part of staff email

			elseif(isset($_SESSION['stu_email'])){
				$mail = $_SESSION['stu_email'];

				$select = "select * from members where email='$mail'";
				$run = mysqli_query($con, $select);

				$row = mysqli_fetch_array($run);

				$id = $row['id'];
				$comment = $_POST['comment'];

				$post_id = $_GET['post_id'];
				$date_time = date('Y-m-d H:i:s');

				$insertComment = "insert into comments (post_id, member_id, comment, date_time) values ('$post_id', '$id', '$comment', '$date_time')";
				$run_insert = mysqli_query($con, $insertComment);

				$get_post = "select * from posts where id='$post_id'";
				$run_post = mysqli_query($con, $get_post);
				while($row_post = mysqli_fetch_array($run_post)){
					$comments = $row_post['no_of_comments'];

					//increment number of likes with 1
					$new_comments = $comments+1;

					$insert = "update posts set no_of_comments=$new_comments where id='$post_id'";
					$run_insert = mysqli_query($con,$insert);

					if($run_insert){
						echo "<script>window.open('details.php?post_id=$post_id','_self')</script>"; //reloads the whole page			
					} //end of if
				} //end of while
			}
			//end of if part of staff email

			else{}

		} //end of if

		else{
			echo "<script>alert('You must login first')</script>";
		}

	} //end of if

	else{}
}


//function to display members
function members(){

	global $con;

	$id = $_GET['id'];
	$member = "select * from members where id='$id'";
	$run_member = mysqli_query($con, $member);

	while($row = mysqli_fetch_array($run_member)){
		$designation = $row['designation'];
		$name = $row['name'];
		$email = $row['email'];
		$image = $row['image'];
		
		$posts = "select * from posts where member_id='$id'";
		$run_posts = mysqli_query($con, $posts);
		$count = mysqli_num_rows($run_posts);

		echo "
			
			<div class='row post-details'>
				
				<div class='col-md-4 push-md-4 text-center'>
					<img src='images/$image' alt='$name' style='margin-top: -100px;' class='img-fluid rounded-circle' width='200px'>
				</div>

				<div class='col-md-4 pull-md-4 text-center'>
					
					<span class='float-left active' style='letter-spacing: 3px;'>
						$name ($designation)
					</span>
				</div>
				
				<div class='col-md-4 text-center'>
					<span class='float-right active' style='letter-spacing: 3px;'>
						Number of Posts : $count
					</span>

				</div>

			</div> <!-- posts -->


		";
		
	}

}

//function to search the post
function searchPosts(){

	global $con;

	if(isset($_POST['searchPost'])){
		$search = $_POST['search'];

		$post = "select *,substring(content, 1, 500) from posts where title like '%$search%' order by id DESC";
		$run = mysqli_query($con, $post);

		//counting the number of rows
		$num_rows = mysqli_num_rows($run);

		if($num_rows == 0){
			echo "
				<div class='alert alert-heading'>
					<h2>No posts yet.</h2>
				</div>
			";
		} //end of if 

		else{

			while($row = mysqli_fetch_array($run)){

				$id = $row['id'];
				$member_id = $row['member_id'];
				$title = $row['title'];
				$content = $row['substring(content, 1, 500)'];
				$date_time = $row['date'];
				$no_of_comments = $row['no_of_comments'];
				$no_of_likes = $row['no_of_likes'];

				$members = "select * from members where id='$member_id'";
				$run_members = mysqli_query($con, $members);

				while($row_members = mysqli_fetch_array($run_members)){

					$name = $row_members['name'];
					$image = $row_members['image'];

					$date = $date_time;
					$result = nicetime($date);

					echo "
						<div class='row posts'>
							<div class='col-md-2 text-center'>
								<img src='images/$image' alt='' class='img-fluid rounded-circle' width='60px'>
							</div>
							<div class='col-md-10'>
								<h4>$title
									<span class='float-right text-muted' style='font-weight: normal; font-size: 14px; padding-top: 8px;'>
										By <span class='active'>
												<a href='members.php?id=$member_id' style='color: inherit;'>
													$name
												</a>
											</span> $result
									</span>
								</h4>
								<p>
									$content <a href='details.php?post_id=$id'>more &raquo;</a>

									<span>
										
									</span>
								</p>
								";
								
								
					$likes = "select * from likes where post_id='$id'";
					$run_likes = mysqli_query($con, $likes);
					$count = mysqli_num_rows($run_likes);

					if($count == 0){
						echo"
								<div style='border-top: 1px solid lightgrey'>
									<form action='' class='form' method='post' role='form' enctype='multipart/form-data'>
										<!-- like button -->
										<button type='submit' name='like' class='btn btn-link text-gray-dark' value='$id'>
											<i class='fa fa-thumbs-up'></i> Like($no_of_likes)
										</button>

										<!-- comment button -->
										<button type='submit' class='btn btn-link text-gray-dark' value='$id'>
											<i class='fa fa-comments'></i> <a href='details.php?post_id=$id' style='color: inherit;'>Comment</a>($no_of_comments)
										</button>
										
										<!-- share button -->
										<button type='submit' class='btn btn-link text-gray-dark'>
											<i class='fa fa-share'></i> Share
										</button>
									</form>
								</div>
							</div> <!-- col md 10 -->
						</div> <!-- posts -->
					";

					}
					else{
						while($row_likes = mysqli_fetch_array($run_likes)){
							$post_id = $row_likes['post_id'];
							$member = $row_likes['member_id'];
							$button = $row_likes['button'];

							if($member = $member_id){
								echo "

										<div style='border-top: 1px solid lightgrey'>
											<form action='' class='form' method='post' role='form' enctype='multipart/form-data'>
												<!-- like button -->
												<button type='submit' name='unlike' class='btn btn-link text-gray-dark' value='$id'>
													<i class='fa fa-thumbs-up'></i> Unlike($no_of_likes)
												</button>

												<!-- comment button -->
												<button type='submit' class='btn btn-link text-gray-dark' value='$id'>
													<i class='fa fa-comments'></i> <a href='details.php?post_id=$id' style='color: inherit;'>Comment</a>($no_of_comments)
												</button>
												
												<!-- share button -->
												<button type='submit' class='btn btn-link text-gray-dark'>
													<i class='fa fa-share'></i> Share
												</button>
											</form>
										</div>
									</div> <!-- col md 10 -->
								</div> <!-- posts -->

								";

							} //end of if
							else{
								echo "

										<div style='border-top: 1px solid lightgrey'>
											<form action='' class='form' method='post' role='form' enctype='multipart/form-data'>
												<!-- like button -->
												<button type='submit' name='like' class='btn btn-link text-gray-dark' value='$id'>
													<i class='fa fa-thumbs-up'></i> Like($no_of_likes)
												</button>

												<!-- comment button -->
												<button type='submit' class='btn btn-link text-gray-dark' value='$id'>
													<i class='fa fa-comments'></i> <a href='details.php?post_id=$id' style='color: inherit;'>Comment</a>($no_of_comments)
												</button>
												
												<!-- share button -->
												<button type='submit' class='btn btn-link text-gray-dark'>
													<i class='fa fa-share'></i> Share
												</button>
											</form>
										</div>
									</div> <!-- col md 10 -->
								</div> <!-- posts -->


								";
							} //ned of else

						} //end of while
					} //end of else
								
				} //end of while

			} //end of while

		} //end of else

	}

}

//function to display all the posts of the member
function memberPosts(){

	global $con;

	$id = $_GET['id'];

	$post = "select * from posts where member_id='$id' order by id DESC limit 0,6";
		$run = mysqli_query($con, $post);

		while($row = mysqli_fetch_array($run)){

			$id = $row['id'];
			$member_id = $row['member_id'];
			$title = $row['title'];
			$content = $row['content'];
			$date_time = $row['date'];
			$no_of_comments = $row['no_of_comments'];
			$no_of_likes = $row['no_of_likes'];

			$result = nicetime($date_time);

				echo "
						<div class='card col-md-4 text-center' style='margin-left:0;'>
	                        <div class='card-block'>
		                        <h4>$title</h4>
		                        <p class='card-text'>
	        	                    $content <a href='details.php?post_id=$id'>more &raquo;</a>
	            	            </p>
	            	            <hr>
	            	            <p class='text-muted'>
									$result
	            	            </p>
	                        </div> <!-- card-block -->
		                </div> <!-- card -->

				";


		}//end of while
}

############################## Forum section s###############################################

//insert forum reaction
function forumReaction(){
	global $con;
	if(isset($_POST['like'])){
		$forum_id = $_GET['forum_id'];
		$like = "select * from forum where forum_id='$forum_id'";
		$run_like = mysqli_query($con,$like);
			while($row_like = mysqli_fetch_array($run_like)){
				$likes = $row_like['likes'];

				$new_likes = $likes+1;
				$insert = "update forum set likes=$new_likes where forum_id='$forum_id'";
				$run_insert = mysqli_query($con,$insert);

				if($run_insert){
					echo "<script>window.open('forum_details.php?forum_id=$forum_id','_self')</script>";
				}
			}
	}
	if(isset($_POST['dislike'])){
		$forum_id = $_GET['forum_id'];
		$dislike = "select * from forum where forum_id='$forum_id'";
		$run_dislike = mysqli_query($con,$dislike);
			while($row_like = mysqli_fetch_array($run_dislike)){
				$dislikes = $row_like['dislikes'];

				$new_dislikes = $dislikes+1;
				$insert = "update forum set dislikes=$new_dislikes where forum_id='$forum_id'";
				$run_insert = mysqli_query($con,$insert);

				if($run_insert){
					echo "<script>window.open('forum_details.php?forum_id=$forum_id','_self')</script>";
				}
			}
	}
}

//getting forum topics
function forum(){
	global $con;

	$get_forum = "select * from forum order by forum_id DESC";
	$run_forum = mysqli_query($con, $get_forum);
	$count = mysqli_num_rows($run_forum);

	while($row_forum = mysqli_fetch_array($run_forum)){
		$forum_id = $row_forum['forum_id'];
		$forum_topic = $row_forum['forum_topic'];
		$topic_time = $row_forum['topic_time'];
		$member_email = $row_forum['member_email'];
		$likes = $row_forum['likes'];
		$dislikes = $row_forum['dislikes'];

		$get_comments = "select * from forum_comments where forum_id = '$forum_id'";
		$run_comments = mysqli_query($con, $get_comments);
		$row_comments = mysqli_num_rows($run_comments);
		
		$member_name = "select * from members where email = '$member_email'";
		$run_member = mysqli_query($con,$member_name);

		while($row_member = mysqli_fetch_array($run_member)){
			$name = $row_member['name'];
			$member_id = $row_member['id'];

            $date = $topic_time;
            $result = nicetime($date);

			echo "
				
				<div class='row'>
					
					<div class='col-md-12'>
						<div class='row'>
							<div class='col-md-12'>
							
								<h4>
									<a href='forum_details.php?forum_id=$forum_id' style='text-decoration: none; color: inherit;'>$forum_topic</a>
								</h4>
								
							</div>
							<div class='col-md-6'>

								<form action='' class='form' method='post' role='form' enctype='multipart/form-data'>
									
									<!-- comment button -->
									<a href='forum_details.php?forum_id=$forum_id' style='text-decoration: none'>
										<i class='fa fa-comments fa-sm'> $row_comments comment(s)</i>
									</a>

									<!-- like button -->
									<button type='submit' name='like' class='btn btn-link text-success' value='$forum_id'>
										<i class='fa fa-thumbs-up'></i> Like($likes)
									</button>
									
									<!-- dislike button -->
									<button type='submit' name='like' class='btn btn-link text-danger' value='$forum_id'>
										<i class='fa fa-thumbs-up'></i> Dislike($dislikes)
									</button>
								</form>

							</div>
							<div class='col-md-6'>
								<p style='text-align: right; color: grey'>by - 
									<span class='active'>
										<a href='members.php?id=$member_id' style='color: inherit;'>$name</a>
									</span> $result
								</p>
							</div>
						</div>
					</div> <!-- forum topic container -->

				</div>
			";
			
		}
	}


}

/*

//trending forum
function trendingForum(){
	global $con;

	$start=0;
	$limit=20;

	if(isset($_GET['id']))
	{
	$id=$_GET['id'];
	$start=($id-1)*$limit;
	}
	else{
		$id=1;
	}

	$get_forum = "select * from forum order by total_comments DESC limit $start,$limit";
	$run_forum = mysqli_query($con, $get_forum);
	while($row_forum = mysqli_fetch_array($run_forum)){
		$forum_id = $row_forum['forum_id'];
		$forum_topic = $row_forum['forum_topic'];
		$topic_time = $row_forum['topic_time'];
		$member_email = $row_forum['member_email'];
		$likes = $row_forum['likes'];
		$dislikes = $row_forum['dislikes'];

		$get_comments = "select * from forum_comments where forum_id = '$forum_id'";
		$run_comments = mysqli_query($con, $get_comments);
		$row_comments = mysqli_num_rows($run_comments);

		$member_name = "select upper(name) as member_name,id from members where email = '$member_email'";
		$run_member = mysqli_query($con,$member_name);
		while($row_member = mysqli_fetch_array($run_member)){
			$name = $row_member['name'];
			$member_id = $row_member['id'];

            $date = $topic_time;
            $result = nicetime($date);

			echo "
				<div class='col-md-12 forum-topic-container'>
					<div class='col-md-12'>
						<h2>
							<a href='forum_details.php?forum_id=$forum_id' style='text-decoration: none; color: inherit;'>$forum_topic</a>
						</h2>
						
					</div>
					<div class='col-md-6'>
						<a href='forum_details.php?forum_id=$forum_id' style='text-decoration: none'>
							<i class='fa fa-comments fa-sm'> $row_comments comment(s)</i>
						</a>
						<i class='fa fa-thumbs-up fa-sm'> $likes</i>
						<i class='fa fa-thumbs-down fa-sm'> $dislikes</i>	
					</div>
					<div class='col-md-6'>
						<p style='text-align: right; color: grey'>by - 
							<span class='active'>
								<a href='members.php?id=$member_id' style='color: inherit;'>$name</a>
							</span> $result
						</p>
					</div>
				</div> <!-- forum topic container -->
			";
		}
	}
	$rows=mysqli_num_rows(mysqli_query($con,"select forum_id from forum"));
	$total=ceil($rows/$limit);

	if($id==1 && $id==$total){
				echo "
				<div class='col-md-4 col-md-push-5'>
					<button type='button' class='btn btn-link' disabled='disabled'>&laquo; No more records &raquo;</button>
				</div>
				";
		}

		elseif($id==$total){
			echo "
				<div class='col-md-4 col-md-push-1'>
					<a href='trending_forum.php?id=".($id-1)."' class='btn btn-link'>&laquo; PREVIOUS</a>
				</div>
			";
			echo "<div class='col-md-4'> <ul>";
				for($i=1;$i<=$total;$i++){
					if($i == $id) { 
						echo "
							<li class='btn btn-link paging page-active'>".$i."</li>
						";
					}

					else {
						echo "
							<li class='btn btn-link paging'><a href='forum.php?id=".$i."'>".$i."</a></li>
						";
					}
				}
			echo "</ul> </div>";

		}
		elseif($id>1 && $id<$total){
			echo "
			<div class='col-md-4 col-md-push-1'>
				<a href='trending_forum.php?id=".($id-1)."' class='btn btn-link'>&laquo; PREVIOUS</a>
			</div>";
			
			echo "<div class='col-md-4'> <ul>";
				for($i=1;$i<=$total;$i++){
					if($i == $id) { 
						echo "
							<li class='btn btn-link paging page-active'>".$i."</li>
						";
					}

					else {
						echo "
							<li class='btn btn-link paging'><a href='trending_forum.php?id=".$i."'>".$i."</a></li>
						";
					}
				}
			echo "</ul> </div>";

			echo"
			<div class='col-md-4 col-md-push-2'>
				<a href='trending_forum.php?id=".($id+1)."' class='btn btn-link'>NEXT &raquo;</a>
			</div>
			";
		}
		elseif($id==1 && $id<$total){
			echo "<div class='col-md-4 col-md-push-4'> <ul>";
				for($i=1;$i<=$total;$i++){
					if($i == $id) { 
						echo "
							<li class='btn btn-link paging page-active'>".$i."</li>
						";
					}

					else {
						echo "
							<li class='btn btn-link paging'><a href='trending_forum.php?id=".$i."'>".$i."</a></li>
						";
					}
				}
			echo "</ul> </div>";

			echo "
			<div class='col-md-4 col-md-push-6'>
				<a href='trending_forum.php?id=".($id+1)."' class='btn btn-link'>NEXT &raquo;</a>
			</div>
			";
		}

}

//popular this week forum
function popThisWeek(){
	global $con;

	$start=0;
	$limit=20;

	if(isset($_GET['id']))
	{
	$id=$_GET['id'];
	$start=($id-1)*$limit;
	}
	else{
		$id=1;
	}

	$get_forum = "select * FROM forum WHERE topic_time>=date_add(now(),interval -7 day) order by total_comments DESC limit $start,$limit";
	$run_forum = mysqli_query($con, $get_forum);
	$num_forum = mysqli_num_rows($run_forum);

	if($num_forum == 0){
		echo "
			<div class='col-md-12'>
				<h2>\"Nothing is popular this week\"</h2>
			</div>
		";
	}
	else{
		while($row_forum = mysqli_fetch_array($run_forum)){
			$forum_id = $row_forum['forum_id'];
			$forum_topic = $row_forum['forum_topic'];
			$topic_time = $row_forum['topic_time'];
			$member_email = $row_forum['member_email'];
			$likes = $row_forum['likes'];
			$dislikes = $row_forum['dislikes'];

			$get_comments = "select * from forum_comments where forum_id = '$forum_id'";
			$run_comments = mysqli_query($con, $get_comments);
			$row_comments = mysqli_num_rows($run_comments);

			$member_name = "select upper(name) as name,id from members where email = '$member_email'";
			$run_member = mysqli_query($con,$member_name);
			while($row_member = mysqli_fetch_array($run_member)){
				$name = $row_member['name'];
				$member_id = $row_member['id'];

	            $date = $topic_time;
	            $result = nicetime($date);

				echo "
					<div class='col-md-12 forum-topic-container'>
					<div class='col-md-12'>
						<h2>
							<a href='forum_details.php?forum_id=$forum_id' style='text-decoration: none; color: inherit;'>$forum_topic</a>
						</h2>
						
					</div>
					<div class='col-md-6'>
						<a href='forum_details.php?forum_id=$forum_id' style='text-decoration: none'>
							<i class='fa fa-comments fa-sm'> $row_comments comment(s)</i>
						</a>
						<i class='fa fa-thumbs-up fa-sm'> $likes</i>
						<i class='fa fa-thumbs-down fa-sm'> $dislikes</i>	
					</div>
					<div class='col-md-6'>
						<p style='text-align: right; color: grey'>by - 
							<span class='active'>
								<a href='members.php?id=$member_id' style='color: inherit;'>$name</a>
							</span> $result
						</p>
					</div>
				</div> <!-- forum topic container -->
				";
			}
		}
	}
	$rows=mysqli_num_rows(mysqli_query($con,"select forum_id from forum"));
	$total=ceil($rows/$limit);

	if($id==1 && $id==$total){
				echo "
				<div class='col-md-4 col-md-push-5'>
					<button type='button' class='btn btn-link' disabled='disabled'>&laquo; No more records &raquo;</button>
				</div>
				";
		}

		elseif($id==$total){
			echo "
				<div class='col-md-4 col-md-push-1'>
					<a href='forum.php?id=".($id-1)."' class='btn btn-link'>&laquo; PREVIOUS</a>
				</div>
			";
			echo "<div class='col-md-4'> <ul>";
				for($i=1;$i<=$total;$i++){
					if($i == $id) { 
						echo "
							<li class='btn btn-link paging page-active'>".$i."</li>
						";
					}

					else {
						echo "
							<li class='btn btn-link paging'><a href='index.php?id=".$i."'>".$i."</a></li>
						";
					}
				}
			echo "</ul> </div>";

		}
		elseif($id>1 && $id<$total){
			echo "
			<div class='col-md-4 col-md-push-1'>
				<a href='forum.php?id=".($id-1)."' class='btn btn-link'>&laquo; PREVIOUS</a>
			</div>";
			
			echo "<div class='col-md-4'> <ul>";
				for($i=1;$i<=$total;$i++){
					if($i == $id) { 
						echo "
							<li class='btn btn-link paging page-active'>".$i."</li>
						";
					}

					else {
						echo "
							<li class='btn btn-link paging'><a href='index.php?id=".$i."'>".$i."</a></li>
						";
					}
				}
			echo "</ul> </div>";

			echo"
			<div class='col-md-4 col-md-push-2'>
				<a href='forum.php?id=".($id+1)."' class='btn btn-link'>NEXT &raquo;</a>
			</div>
			";
		}
		elseif($id==1 && $id<$total){
			echo "<div class='col-md-4 col-md-push-4'> <ul>";
				for($i=1;$i<=$total;$i++){
					if($i == $id) { 
						echo "
							<li class='btn btn-link paging page-active'>".$i."</li>
						";
					}

					else {
						echo "
							<li class='btn btn-link paging'><a href='index.php?id=".$i."'>".$i."</a></li>
						";
					}
				}
			echo "</ul> </div>";

			echo "
			<div class='col-md-4 col-md-push-6'>
				<a href='forum.php?id=".($id+1)."' class='btn btn-link'>NEXT &raquo;</a>
			</div>
			";
		}
}

//popular this month
function popThisMonth(){
	global $con;

	$start=0;
	$limit=20;

	if(isset($_GET['id']))
	{
	$id=$_GET['id'];
	$start=($id-1)*$limit;
	}
	else{
		$id=1;
	}

	$get_forum = "select * FROM forum WHERE topic_time>=date_add(now(),interval -30 day) order by total_comments DESC limit $start,$limit";
	$run_forum = mysqli_query($con, $get_forum);
	$num_forum = mysqli_num_rows($run_forum);

	if($num_forum == 0){
		echo "
			<div class='col-md-12'>
				<h2>\"Nothing is popular this month\"</h2>
			</div>
		";
	}
	else{
		while($row_forum = mysqli_fetch_array($run_forum)){
			$forum_id = $row_forum['forum_id'];
			$forum_topic = $row_forum['forum_topic'];
			$topic_time = $row_forum['topic_time'];
			$member_email = $row_forum['member_email'];
			$likes = $row_forum['likes'];
			$dislikes = $row_forum['dislikes'];

			$get_comments = "select * from forum_comments where forum_id = '$forum_id'";
			$run_comments = mysqli_query($con, $get_comments);
			$row_comments = mysqli_num_rows($run_comments);

			$member_name = "select upper(name) as name,id from members where email = '$member_email'";
			$run_member = mysqli_query($con,$member_name);
			while($row_member = mysqli_fetch_array($run_member)){
				$name = $row_member['name'];
				$member_id = $row_member['id'];

	            $date = $topic_time;
	            $result = nicetime($date);

				echo "
					<div class='col-md-12 forum-topic-container'>
					<div class='col-md-12'>
						<h2>
							<a href='forum_details.php?forum_id=$forum_id' style='text-decoration: none; color: inherit;'>$forum_topic</a>
						</h2>
						
					</div>
					<div class='col-md-6'>
						<a href='forum_details.php?forum_id=$forum_id' style='text-decoration: none'>
							<i class='fa fa-comments fa-sm'> $row_comments comment(s)</i>
						</a>
						<i class='fa fa-thumbs-up fa-sm'> $likes</i>
						<i class='fa fa-thumbs-down fa-sm'> $dislikes</i>	
					</div>
					<div class='col-md-6'>
						<p style='text-align: right; color: grey'>by - 
							<span class='active'>
								<a href='members.php?id=$member_id' style='color: inherit;'>$name</a>
							</span> $result
						</p>
					</div>
				</div> <!-- forum topic container -->
				";
			}
		}
	}
	$rows=mysqli_num_rows(mysqli_query($con,"select forum_id from forum"));
	$total=ceil($rows/$limit);

	if($id==1 && $id==$total){
				echo "
				<div class='col-md-4 col-md-push-5'>
					<button type='button' class='btn btn-link' disabled='disabled'>&laquo; No more records &raquo;</button>
				</div>
				";
		}

		elseif($id==$total){
			echo "
				<div class='col-md-4 col-md-push-1'>
					<a href='popular_this_month.php?id=".($id-1)."' class='btn btn-link'>&laquo; PREVIOUS</a>
				</div>
			";
			echo "<div class='col-md-4'> <ul>";
				for($i=1;$i<=$total;$i++){
					if($i == $id) { 
						echo "
							<li class='btn btn-link paging page-active'>".$i."</li>
						";
					}

					else {
						echo "
							<li class='btn btn-link paging'><a href='popular_this_month.php?id=".$i."'>".$i."</a></li>
						";
					}
				}
			echo "</ul> </div>";

		}
		elseif($id>1 && $id<$total){
			echo "
			<div class='col-md-4 col-md-push-1'>
				<a href='popular_this_month.php?id=".($id-1)."' class='btn btn-link'>&laquo; PREVIOUS</a>
			</div>";
			
			echo "<div class='col-md-4'> <ul>";
				for($i=1;$i<=$total;$i++){
					if($i == $id) { 
						echo "
							<li class='btn btn-link paging page-active'>".$i."</li>
						";
					}

					else {
						echo "
							<li class='btn btn-link paging'><a href='popular_this_month.php?id=".$i."'>".$i."</a></li>
						";
					}
				}
			echo "</ul> </div>";

			echo"
			<div class='col-md-4 col-md-push-2'>
				<a href='popular_this_month.php?id=".($id+1)."' class='btn btn-link'>NEXT &raquo;</a>
			</div>
			";
		}
		elseif($id==1 && $id<$total){
			echo "<div class='col-md-4 col-md-push-4'> <ul>";
				for($i=1;$i<=$total;$i++){
					if($i == $id) { 
						echo "
							<li class='btn btn-link paging page-active'>".$i."</li>
						";
					}

					else {
						echo "
							<li class='btn btn-link paging'><a href='popular_this_month.php?id=".$i."'>".$i."</a></li>
						";
					}
				}
			echo "</ul> </div>";

			echo "
			<div class='col-md-4 col-md-push-6'>
				<a href='popular_this_month.php?id=".($id+1)."' class='btn btn-link'>NEXT &raquo;</a>
			</div>
			";
		}
}

*/

//getting forum topic details
function forumDetails(){
	global $con;

	if(isset($_GET['forum_id'])){
		$forum_id = $_GET['forum_id'];

		$get_forum = "select * from forum where forum_id='$forum_id'";
		$run_forum  = mysqli_query($con,$get_forum);
		while($row_forum = mysqli_fetch_array($run_forum)){
			$forum_id = $row_forum['forum_id'];
			$member_email = $row_forum['member_email'];
			$forum_topic = $row_forum['forum_topic'];
			$topic_time = $row_forum['topic_time'];

			$get_member = "select * from members where email='$member_email'";
			$run_member = mysqli_query($con, $get_member);
			while($row_member = mysqli_fetch_array($run_member)){
				$member_email = $row_member['email'];
				$member_name = $row_member['name'];
				$member_id = $row_member['id'];

                $date = $topic_time;
                $result = nicetime($date);

				echo "

					<div class='row post-details'>
						
						<div class='col-md-12'>
							<h4>$forum_topic
								<span class='float-right text-muted' style='font-weight: normal; font-size: 14px; padding-top: 8px;'>
									By <span class='active'>
											<a href='members.php?id=$member_id' style='color: inherit;'>$member_name</a>
										</span> $result
								</span>
							</h4>

						</div> <!-- col md 12 -->
					</div> <!-- posts -->

				";
			}

		}
	}

}

//getting forum comments
function forumComments(){
	global $con;

	if(isset($_GET['forum_id'])){
		$forum_id = $_GET['forum_id'];

		$get_comments = "select * from forum_comments where forum_id='$forum_id'";
		$run_comments = mysqli_query($con,$get_comments);
		while($row_comments = mysqli_fetch_array($run_comments)){
			$forum_comment_id = $row_comments['forum_comment_id'];
			$forum_id = $row_comments['forum_id'];
			$comments = $row_comments['comments'];
			$member_email = $row_comments['member_email'];
			$no_of_likes = $row_comments['no_of_likes'];

			$get_member = "select * from members where email='$member_email'";
			$run_member = mysqli_query($con, $get_member);
			while($row_member = mysqli_fetch_array($run_member)){
				$member_name = $row_member['name'];
				$member_id = $row_member['id'];
				$image = $row_member['image'];

				echo "
					
					<div class='row' style='border-bottom: 1px solid #e7e7e7; padding: 5px;'>
							<div class='col-md-2 text-center'>
								<img src='images/$image' alt='' class='img-fluid rounded-circle' style='width: 60px;'>
							</div> <!-- col md 2 -->
							<div class='col-md-10'>
								
								<h4 class='text-warning'>
									
									<div class='row'>
										<div class='col-md-12'>
											<div class='row'>
												<div class='col-md-5'>
													$member_name
												</div>
												<div class='col-md-7 text-right'>
													<form action='' class='form' method='post' role='form' enctype='multipart/form-data'>
														<!-- like button -->
														<button type='submit' name='like' class='btn btn-link text-success' value='$forum_comment_id'>
															<i class='fa fa-thumbs-up'></i> Like($no_of_likes)
														</button>
														
														<!-- report button -->
														<button type='submit' class='btn btn-link' value='$forum_comment_id'>
															<i class='fa fa-warning'></i> Report
														</button>
														
														<!-- delete button -->
														<!-- <button type='submit' class='btn btn-link text-danger' value='$forum_comment_id'>
															<i class='fa fa-trash'></i> Delete
														</button> -->
													</form>
												</div> <!-- col md 7 -->
											</div> <!-- row -->
										</div> <!-- col md 12 -->
									</div> <!-- row -->

								</h4>

								<p>
									$comments
									<span class='float-md-right text-muted' style='font-weight: normal; font-size: 14px; padding-top: 8px;'>
										<!-- variable to display time -->
									</span>
								</p>

							</div> <!-- col md 10 -->
							
						</div> <!-- row -->

					";
			}
		}
	}

}

/*

//hot questions
function hotQuestions(){
	global $con;

	$forum = "select * from forum order by total_comments DESC limit 0,10";
	$run_forum = mysqli_query($con, $forum);
	while($row_forum = mysqli_fetch_array($run_forum)){
		$forum_id = $row_forum['forum_id'];
		$forum_topic = $row_forum['forum_topic'];

		echo "
			<li>
				<a href='forum_details.php?forum_id=$forum_id'>
					<p class='hot-questions'>$forum_topic</p>
				</a>
			</li>
		";

	}
}

*/

//insert Forum Comments
function insertForumComments(){
	global $con;
	if(isset($_GET['forum_id'])){
		if(isset($_POST['submit'])){
		    $forum_id = $_GET['forum_id'];
		    $member = $_SESSION['member_email'];
		    $comments= $_POST['comment'];
		    
		    $insert = "insert into forum_comments (forum_id,member_email,comments) values ('$forum_id','$member','$comments')";

		    $run = mysqli_query($con,$insert);

		    $tot_comments = "select comments from forum_comments where forum_id='$forum_id'";
		    $run_tot_comments = mysqli_query($con,$tot_comments);
		    $num_rows = mysqli_num_rows($run_tot_comments);

		    $update_tot = "update forum set total_comments=$num_rows where forum_id='$forum_id'";
		    $run_tot = mysqli_query($con,$update_tot);


		    if($run){
		    	echo "<script>window.open('forum_details.php?forum_id=$forum_id','_self')</script>";

		    }
		}
	}
}


//function to add attendance
function attendance(){

	global $con;

	if(isset($_GET['sub_id'])){
		$sub_id = $_GET['sub_id'];

		$staff = "select * from staff where id='$sub_id'";
		$run_staff = mysqli_query($con, $staff);

		echo "<ol><form action='' method='post' role='form' class='form'>";

		while($row_staff = mysqli_fetch_array($run_staff)){

			$staff_id = $row_staff['staff_id'];
			$sem = $row_staff['sem'];
			$subject = $row_staff['subjects'];

			$stu = "select * from members where sem='$sem'";
			$run_stu = mysqli_query($con, $stu);
			$count = mysqli_num_rows($run_stu);

			if($count == 0){
				echo "
					<h5 class='text-muted' style='padding: 10px;'>There is no any student of $subject.</h5>
					<p class='text-center'>
						<a href='index.php#attendance'>&laquo; back</a>
					</p>
				";
			}

			else{
				while($row_stu = mysqli_fetch_array($run_stu)){

					$member_id = $row_stu['id'];
					$name = $row_stu['name'];
					$email = $row_stu['email'];
					$image = $row_stu['image'];

					echo "
						<li style='padding: 10px;'>
							$name
							<button type='submit' id='absent' name='absent' class='btn btn-danger' value='$member_id'>Absent</button>
							<button type='submit' id='present' name='present' class='btn btn-success' value='$member_id'>Present</button>
						</li>
					";

				} //end of while

				if(isset($_POST['absent'])){
					$member_id = $_POST['absent'];
					date_default_timezone_set("Asia/Calcutta");
					
					$date = date('Y-m-d h:i:s A');

					$insert = "insert into attendance (stu_id, subject, date, attendance) values ('$member_id','$subject','$date','Absent')";
					$run_insert = mysqli_query($con, $insert);
				}
				elseif(isset($_POST['present'])){
					$member_id = $_POST['present'];

					date_default_timezone_set("Asia/Calcutta");
					
					$date = date('Y-m-d h:i:s A');
				
					$insert = "insert into attendance (stu_id, subject, date, attendance) values ('$member_id','$subject','$date','Present')";
					$run_insert = mysqli_query($con, $insert);	
				}

			} //end of else

		} //end of while
		echo "</form></ol>";

	}

}

function attendance_list(){

	global $con;
	$sub_id = $_GET['sub_id'];
	$subject = "select * from staff where id='$sub_id'";
	$run_subject = mysqli_query($con, $subject);

	echo "		
		<div class='col-md-12'>

				<table class='table table-hover'>
					<thead>
						<tr>
							<th>Roll No.</th>
							<th>Name</th>
							<th>Semester</th>
							<th>Subject</th>
							<th>Date</th>
							<th>Attendance</th>
						</tr>
					</thead>
					<tbody>
	";

	while($row_subject = mysqli_fetch_array($run_subject)){
		
		$subject = $row_subject['subjects'];

		$attendance = "select * from attendance where subject='$subject'";
		$run_attendance = mysqli_query($con, $attendance);

		while($row_attendance = mysqli_fetch_array($run_attendance)){
			$id = $row_attendance['id'];
			$stu_id = $row_attendance['stu_id'];
			$date = $row_attendance['date'];
			$attendance = $row_attendance['attendance'];

			$stu = "select * from members where id='$stu_id' order by roll_number DESC";
			$run_stu = mysqli_query($con, $stu);

			while($row_stu = mysqli_fetch_array($run_stu)){
				$name = $row_stu['name'];
				$email = $row_stu['email'];
				$image = $row_stu['email'];
				$sem = $row_stu['sem'];
				$roll_number = $row_stu['roll_number'];
				echo "
					<tr>
						<td>$roll_number</td>
						<td>$name</td>
						<td>$sem</td>
						<td>$subject</td>
						<td>$date</td>
						<td>$attendance</td>
					</tr>
				";
			
			}
			
		}

	}
	echo "
		
		</tbody>
				</table>
			</div>

	";
}



//student attendance list
function stu_attendance_list(){

	global $con;
	$sub_id = $_GET['sub_id'];
	$subject = "select * from staff where id='$sub_id'";
	$run_subject = mysqli_query($con, $subject);

	echo "		
		<div class='col-md-12'>

				<table class='table table-hover'>
					<thead>
						<tr>
							<th>Roll No.</th>
							<th>Name</th>
							<th>Semester</th>
							<th>Subject</th>
							<th>Date</th>
							<th>Attendance</th>
						</tr>
					</thead>
					<tbody>
	";

	while($row_subject = mysqli_fetch_array($run_subject)){
		
		$subject = $row_subject['subjects'];

		$attendance = "select * from attendance where subject='$subject'";
		$run_attendance = mysqli_query($con, $attendance);

		while($row_attendance = mysqli_fetch_array($run_attendance)){
			$id = $row_attendance['id'];
			$stu_id = $row_attendance['stu_id'];
			$date = $row_attendance['date'];
			$attendance = $row_attendance['attendance'];

			$stu = "select * from members where id='$stu_id' order by roll_number DESC";
			$run_stu = mysqli_query($con, $stu);

			while($row_stu = mysqli_fetch_array($run_stu)){
				$name = $row_stu['name'];
				$email = $row_stu['email'];
				$image = $row_stu['email'];
				$sem = $row_stu['sem'];
				$roll_number = $row_stu['roll_number'];
				echo "
					<tr>
						<td>$roll_number</td>
						<td>$name</td>
						<td>$sem</td>
						<td>$subject</td>
						<td>$date</td>
						<td>$attendance</td>
					</tr>
				";
			
			}
			
		}

	}
	echo "
		
		</tbody>
				</table>
			</div>

	";

}
?>