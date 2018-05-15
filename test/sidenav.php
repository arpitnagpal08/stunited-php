<!-- sidebar -->
	<div id="mySidenav" class="sidenav">
		<!-- to close side nav -->
		<a href="javascript:void(0)" class="closebtn" onclick="closeNav()"><i class="fa fa-angle-left"></i></a>
		
		<!-- Name -->
		<h2 class='text-center' style="color: #f0f0f0;">Welcome 
			<small>Arpit Nagpal</small>
		</h2>

		<hr style='border: 1px solid #818181; width: 70%; opacity: 0.3;'>
		
		<!-- clear all notifications -->
		<a href='' class='clear text-right'>
			<i class='fa fa-trash-o'></i>clear all
		</a>

		<!-- display all nptifications -->
		<div class='container-fluid'>
			<div class="row">
				<div class='col-md-10' style="color: #f0f0f0;">
					<a>Arpit sent you a message <span style='font-size: 15px; color:#888'><small>(10 minutes ago)</small></span></a>
				</div>
				<div class='col-md-1'>
					<a href=''>&times;</a>
				</div>
			</div><!-- row -->
		</div> <!-- container fluid -->

	</div> <!-- side nav -->

<!-- css -->
<style>

/* side nav*/
.sidenav {
	height: 100%; /* 100% Full-height */
	width: 0px; /* 0 width - change this with JavaScript */
	position: fixed; /* Stay in place */
	z-index: 999; /* Stay on top */
	top: 0;
	left: 0;
	background-color: #111; /* Black*/
	overflow-x: hidden; /* Disable horizontal scroll */
	padding-top: 60px; /* Place content 60px from the top */
	transition: 0.5s; /* 0.5 second transition effect to slide in the sidenav */
}
/* The navigation menu links */

.sidenav a {
    padding: 8px 8px 8px 20px;
    text-decoration: none;
    font-size: 18px;
    color: #818181;
    display: block;
    transition: 0.3s;
}

/* When you mouse over the navigation links, change their color */
.sidenav a:hover, .offcanvas a:focus{
    color: #f1f1f1;
}

/* Position and style the close button (top right corner) */
.sidenav .closebtn {
    position: absolute;
    top: 0;
    right: 25px;
    font-size: 36px;
    margin-left: 50px;
}

.sidenav .clear {
    font-size: 20px;
}
</style>


<script>
// <!-- JS -->

//Toggle Side Nav
function openNav() {
    document.getElementById("mySidenav").style.width = "350px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}
</script>