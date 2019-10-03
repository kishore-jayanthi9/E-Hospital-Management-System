<?php
$id = $_GET['id'];
$change = $_GET['change'];
$conn = mysqli_connect('localhost','root','','hms');
if($change == "approve")
{
	$sqlU = "UPDATE appointments SET status=1 WHERE id=$id";
	if(mysqli_query($conn,$sqlU))
	{
		echo "appointment is confirmed";
	}
}
else if($change == "deny")
{
	$sqlU = "UPDATE appointments SET status=2 WHERE id=$id";
	if(mysqli_query($conn,$sqlU))
	{
		echo "appointment is denied";
	}
}
?>