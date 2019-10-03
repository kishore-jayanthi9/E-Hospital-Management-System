<?php
$id = $_GET['id'];
$time = time();
$docId = $_GET['docId'];
$phId = $_GET['pId'];
$conn = mysqli_connect('localhost','root','','hms');
$sql = "INSERT INTO messages (m_to,doc_id,p_id,message,sent_at) values ($id,$docId,$phId,'your medicine is ready','$time')";
if(mysqli_query($conn,$sql) or die(mysqli_error($conn)))
{
	echo "message is sent";
}
?>