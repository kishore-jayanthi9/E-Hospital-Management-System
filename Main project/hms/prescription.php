<?php
if(isset($_POST['pSubmit']))
{
	//$prescription = $_POST['prescription'];		
	$prescription = '';		
	$docId = $_POST['docId'];
	$patId = $_POST['patId'];
	$pharmacy = $_POST['pharmacy'];
	$conn = mysqli_connect('localhost','root','','hms');
	$pOn = time();
	if(isset($_FILES['p']))
	{
		//die("charan");
		$error = null;
	   	$file_name = $_FILES['p']['name'];
    	$file_size =$_FILES['p']['size'];
	   	$file_tmp =$_FILES['p']['tmp_name'];
    	$file_type=$_FILES['p']['type'];
    	$file_ext=strtolower(end(explode('.',$_FILES['p']['name'])));
      
    	$expensions= array("jpeg","jpg","png","pdf");
      
    	if(in_array($file_ext,$expensions)=== false)
    	{
    		$error="extension not allowed, please choose a JPEG or PNG or PDF file.";
    	}
     
    	if(empty($errors)==true)
    	{
    		$dest = "uploads/prescriptions/".$file_name;
       		if(move_uploaded_file($file_tmp,"uploads/prescriptions/".$file_name))
       		{
				//$sqlP = "INSERT INTO prescriptions (pharmacy,prescription,doc_id,pat_id,file) VALUES ($pharmacy,'$prescription',$docId,$patId,'$dest')";
				$dest = "uploads/prescriptions/".$file_name;
       		}         
       		else
       		{
       			$dest = "";
       		}
    	}
	}
	else
	{
		//$sqlAppointment = "INSERT INTO appointments (a_from,a_to,a_time,status,request_on) VALUES ($id,$userId,'$appointmentTime',0,'$aOn')";    
		$dest = "";
	}	
	$sqlP = "INSERT INTO prescriptions (pharmacy,prescription,doc_id,pat_id,file) VALUES ($pharmacy,'$prescription',$docId,$patId,'$dest')";
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

	.form{
		margin:auto;
		/*background-color:#e7f1f554;*/
		width:550px;
		height:140%;
		padding:40px;
		margin-top:40px;
		border:1px solid #c1c3c4;
		
	}
	#submit{
		margin-top:30px;
		
		color:#fff;
		padding:5px;
		border:0;
		border-radius:3px;
		margin-left:30px;
	}
	#prescription{
		margin-top:40px;
		margin-left:18px;
	}
	.name{
		text-align: center;
	}
	.logout{
		text-align: center;
		position: absolute;
		top:70%;
		left:43%;
		
	}

	#pharmacyClickButton
	{
		position: absolute;
		top:270px;	
		left:42%;
	}



	td{
		padding-bottom: 10px;
	}
	</style>
	</head>
	<body>
		<h2 style="text-align:center;font-family: verdana;font-weight: 100;color:gray;margin-top:40px;">HMS | Prescription</h2>
	<div class="form">

	    <div class="name">
		<?php
		$con = mysqli_connect('localhost','root','','hms');
		$pId = $_GET['patId'];
		$sqlName = "SELECT * FROM users WHERE id=$pId";
		$mysqlName = mysqli_query($con,$sqlName);
		if($n = mysqli_fetch_object($mysqlName))
		{
			echo $n->name;
		}
		?>
		</div>
		<div id="formElement">
			<form method="post" action="prescription.php?docId=<?php echo $_GET['docId'] ?>&patId=<?php echo $_GET['patId'] ?>" enctype="multipart/form-data">
			<table class="table">
				<tr>
					<td>select a pharmacy</td>
					<td>:</td>
					<td>
					<select name="pharmacy" id="pharmacy">
						<option value="select a pharmacy">select a pharmacy</option>
						<?php
						$sqlPh = "SELECT * FROM users WHERE COALESCE(TRIM(pname), '') <> ''";
						$mysqlPh = mysqli_query($con,$sqlPh);
						//die(mysqli_num_rows($mysqlPh));
						while($phData = mysqli_fetch_object($mysqlPh))
						{
						?>
						<option value="<?php echo $phData->id;?>"><?php echo $phData->pname;?></option>
						<?php
						}
						?>
					</select>
					<td>
				</tr>
				<td>upload a prescription</td>
				<td>:</td>
				<td>
					<input type="file" name="p" id="p">
					<input type="hidden" name="docId" value="<?php echo $_GET['docId'];?>"  />
					<input type="hidden" name="patId" value="<?php echo $_GET['patId'];?>"  />
				</td>
				
				<div id="pharmacyClickButton">
					<input class="btn btn-success" id="submit" type="submit" name="pSubmit" value="submit to pharmacy" />
				</div>
			</form>
		</div>
		<div class="logout">
			<a href="login.php" class="btn btn-danger">logout</a>
		</div>
	</div>
	<div style="position:absolute;top:380px;right:50%;color: green;">
	<?php
	if(isset($_POST['pSubmit']))
	{
		if(mysqli_query($conn,$sqlP))
		{
			echo "prescription sent";
		}
	}
	?>		
	</div>
		
	</body>
</html>