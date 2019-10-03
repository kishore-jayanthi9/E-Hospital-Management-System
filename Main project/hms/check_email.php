<?php
$email = $_GET['email'];
$conn = mysqli_connect('localhost','root','','hms');
$sql = "SELECT * FROM users WHERE email='$email'";
$mysql = mysqli_query($conn,$sql);
$num = mysqli_num_rows($mysql);
if($num == 1)
{
	echo "not available";
}
else if($num == 0)
{
	echo "available";
}
?>