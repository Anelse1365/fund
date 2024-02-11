<?php
	$conn= mysqli_connect("localhost","root","","db_book") or die("Error: " . mysqli_error($con));
	mysqli_query($conn, "SET NAMES 'utf8' "); 
?>