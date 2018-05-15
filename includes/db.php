<?php

//creating a connection with database
$con = mysqli_connect("localhost","root","","");

//in case connection is not established
if(mysqli_connect_errno()){
	echo "The connection as not established: " . mysqli_connect_error();
}

?>