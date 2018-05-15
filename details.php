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

	<!-- sidebar -->
	<div id="mySidenav" class="sidenav">
		<!-- to close side nav -->
		<a href="javascript:void(0)" class="closebtn" onclick="closeNav()"><i class="fa fa-angle-left"></i></a>
		
		<!-- function notification -->
		<?php notification(); ?>

	</div> <!-- side nav -->

	<nav id="Nav2" class="navbar rounded navbar-toggleable-md navbar-light" style="background-color: #fff;">
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
			<div class="row" style="margin-top: 10px;">
				<a href="javascript:" id="return-to-top">Back to top</a>

				<div class="col-md-8 push-md-2 rounded middle-container">
					<div class="row">
						<div class="col-md-12 rounded" style="background-color: #fff;">
							<!-- All posts -->
							
							<div class="row rounded" style="border: 1px solid transparent;">
								<div class="col-md-12">
									
									<!-- function to display all posts -->
									<?php postDetails(); ?>
									
								</div> <!-- col md 12 -->
							</div> <!-- row -->

							<div class="row rounded" style="border-top: 2px solid lightgray">
								<div class="col-md-12">
									
									<h2 class="text-muted">Comments</h2>
									
									<div class="row rounded">
										<div class="col-md-12" style="padding: 15px; z-index: 0;">
											<form class="form" action="" method="post" role="form" method="post" enctype="multipart/form-data">
												<div class="input-group form-inline">
													<input type="text" class="form-control" name="comment" placeholder="Say Something!">
													<span class="input-group-btn"><button type="submit" name="submitComment" class="btn btn-outline-danger">Post</button></span>
												</div>
											</form>
									
									<!-- function to insert comment -->
									<?php insertComment(); ?>
									
										</div>
									</div> <!-- row -->

									

									<!-- function commensts -->
									<?php comments(); ?>

								</div> <!-- col md 12 -->				
							</div> <!-- row -->

						</div> <!-- col-md-12 -->
					</div> <!-- row -->

				</div> <!-- middle container -->

			</div> <!-- row -->
		</div> <!-- container fluid -->

	</main>

	<footer style="margin-top: 10px;">
		<div class="container-fluid">
			<div class="row" style="text-align: center;">
				<div class="col-md-4 push-md-4">
					<p class=""><i class="fa fa-copyright"></i> 2017, {{websiteName}}</p>					
				</div>
			</div>
		</div>
	</footer>

	<!-- script files for bootstrap 4-->
	<script src="https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script src="css/bootstrap/js/bootstrap.min.js"></script>

	<script>
		//Toggle Side Nav
function openNav() {
    document.getElementById("mySidenav").style.width = "350px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}

//return to top function
$(window).scroll(function() {
    if ($(this).scrollTop() >= 1000) {        // If page is scrolled more than 50px
        $('#return-to-top').fadeIn(200);    // Fade in the arrow
    } else {
        $('#return-to-top').fadeOut(200);   // Else fade out the arrow
    }
});

$('#return-to-top').click(function() {      // When arrow is clicked
    $('body,html').animate({
        scrollTop : 0                      // Scroll to top of body
    }, 500);
});
	</script>

</body>
</html>