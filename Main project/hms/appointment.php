<?php
date_default_timezone_set('Asia/Kolkata');
$conn = mysqli_connect('localhost','root','','hms');
if(isset($_GET['a_from']) && isset($_GET['a_to']))
{
	$id = $_GET['a_from'];
	$userId = $_GET['a_to'];
	$email=$_GET['email'];
}
else if(isset($_POST['a_from']) && isset($_POST['a_to']))
{
	$id = $_POST['a_from'];
	$userId = $_POST['a_to'];
	$email=$_POST['email'];
}
if(isset($_POST['aSubmit']))
{
	$aOn = $_POST['a_on'];
	$appointmentTime = time();
	if(isset($_FILES['mH']))
	{
		//die("file is on");
		$error = null;
	    $file_name = $_FILES['mH']['name'];
    	$file_size =$_FILES['mH']['size'];
	    $file_tmp =$_FILES['mH']['tmp_name'];
    	$file_type=$_FILES['mH']['type'];
    	$file_ext=strtolower(end(explode('.',$_FILES['mH']['name'])));
      
    	$expensions= array("jpeg","jpg","png","pdf");
      
    	if(in_array($file_ext,$expensions)=== false)
    	{
    		$error="extension not allowed, please choose a JPEG or PNG or PDF file.";
    	}
      
    	if(!isset($error))
    	{
    		$dest = "uploads/".$file_name;
        	if(move_uploaded_file($file_tmp,"uploads/".$file_name))
         	{
				$sqlAppointment = "INSERT INTO appointments (a_from,a_to,a_time,status,request_on,m_history) VALUES ($id,$userId,'$appointmentTime',0,'$aOn','$dest')";         	
				//$dest = "uploads/".$file_name;
         	}         
         }
	}
}

?>
<!DOCTYPE html>
<html>
	<head>
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans|Raleway|Candal">
  <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
		<style>
			.box{
				width:600px;
				height:100%;
				margin:auto;
				margin-top: 60px;
				border:1px solid #c1c3c4;

			}
			.home{text-align: center;}
		</style>
	</head>
	<body>
		<h2 style="text-align:center;font-family: verdana;font-weight: 100;color:gray;margin-top:20px;">HMS | Appointment</h2>
		<div class="box">
			
			<form method="post" action="<?php echo $_SERVER['PHP_SELF']?>" enctype="multipart/form-data">
				<table class="table">
					<tr>
						<td>doctor</td>
						<td>:</td>
						<td>
							<?php
							$sqlName = "SELECT * FROM users WHERE id=$id";
							//die($sqlName);
							$mysqlName = mysqli_query($conn,$sqlName) or die(mysqli_error($conn));
							if($name = mysqli_fetch_object($mysqlName))
							{
								echo $name->name;
							}
							?>
							<input type="hidden" name="a_from" value="<?php echo $id;?>">
							<input type="hidden" name="a_to" value="<?php echo $userId;?>">
							<input type="hidden" name="email" value="<?php echo $email;?>">
						</td>
					</tr>
					<tr>
						<td>
							request appointment on 
						</td>
						<td>:</td>
						<td>
							<input type="text" name="a_on" placeholder="enter date">
						</td>
					</tr>
					<tr>
						<td>
							upload medical history
						</td>
						<td>:</td>
						<td>
							<input type="file" name="mH";>
						</td>
					</tr>
					<tr>
						<td><input class="btn btn-primary" type="submit" name="aSubmit" value="request for appointment"></td>
					</tr>
				</table>
			</form>
		</div>
		<div style="text-align: center;color: green">
		<?php
		if(isset($_POST['aSubmit']) && !isset($error))
		{
			if(mysqli_query($conn,$sqlAppointment))
			{
				echo "your request for appointment is sent";
			}
		}
		if(isset($error))
		{
			echo $error;
			//echo "file is enabled";
		}
		?>
		
		</div>
		<div>&nbsp;</div>
		<div class="home">
			<a class="btn btn-primary" href="home.php?email=<?php echo $email;?>">go to home</a>
		</div>
	</body>
</html>