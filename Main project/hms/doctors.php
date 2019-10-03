<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>HMS HEALTHCARE</title>

  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans|Raleway|Candal">
  <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  
</head>
<style>
	.table{margin:auto;width:500px;height:100%;margin-top: 40px;background-color:#e7f1f55c;padding: 60px;}
</style>
	<body style="background-color:#e7f1f554">
	<h2 style="text-align:center;font-family: verdana;font-weight: 100;color:gray;margin-top:20px;">HMS | Appointment</h2>
	<?php
	$doctorId = $data->id;
	$i = 0;
	//$sqlCity = "SELECT * FROM users WHERE registerAs='doctor' and city='$city'";
	$sqlA = "SELECT * FROM appointments WHERE a_from=$doctorId";
	$mysqlA = mysqli_query($conn,$sqlA);
	while($appData = mysqli_fetch_object($mysqlA))//appData = appointment data.
	{
		$i++;
	?>
	<div class="container">
		<div class="table">
			<table>
			<tr>
				<th>
					<h2 style="font-weight: 200">
						<?php
						$sqlPD = "SELECT * FROM users WHERE id=$appData->a_to";//sqlPName = sql to select patient name
						$mysqlPD = mysqli_query($conn,$sqlPD);
						if($pD = mysqli_fetch_object($mysqlPD))
						{
							//die($pD->name);
							echo $pD->name;
						}
						?>	
					</h2>
				</th>
			</tr>
			<tr>
				<td>
					<h4 style="font-weight: 200">Request Sent at<br>
					<?php echo date("d-m-y h:i:s",$appData->a_time);?>
					</h4>
				</td>
				<td>
					<table class="" id="gd<?php echo $appData->id;?>">
					<?php
					if($appData->status == 0 && $appData->status != 2)
					{
					?>
						<tr><td><a class="btn btn-primary" id="<?php echo 'give'.$appData->id?>" onclick="giveAppointment(<?php echo $appData->id;?>,<?php echo $appData->a_from;?>,<?php echo $appData->a_to;?>)">Give Appointment</a></td></tr>
					<?php
					}
					else if($appData->status == 1)
					{
					?>
						<tr><td><a class='btn btn-primary' style="color:#red;text-decoration: none;" href="prescription.php?docId=<?php echo $appData->a_from;?>&patId=<?php echo $appData->a_to;?>">send prescription</a></td></tr>
					<?php
					}
					if($appData->status == 0)
					{
					?>
						<tr><td><a href="#" class="btn btn-primary" id="<?php echo 'deny'.$appData->id?>"onclick="denyAppointment(<?php echo $appData->id;?>)">Deny Appointment</a></td></tr>
					<?php
					}
					?>
					</table>
				</td>
			</tr>
			</table>
			<div id="response<?php echo $appData->id; ?>">
			</div>
			<?php
			if($appData->status != 2)
			{
			?>
			<div style="position: relative;">
				<a style="color:red;text-decoration: none;" href="<?php echo $appData->m_history; ?>" download>download medical history</a>
			</div>
			<?php
			}
			?>
		</div>		
	</div>	
	<?php
	}
	if($i == 0)
	{
	?>

	<div style="padding: 20px; text-align: center;border:1px solid red; width:500px;margin:auto;margin-top: 30px">
		you don't have any appointments
	</div>
	<?php
	}
	?>
	<div>&nbsp;</div>
	<div style="text-align: center;clear: both">
		<a href="login.php"><button type="submit" class="btn btn-danger">logout</button></a>
	</div>
	</body>

	</html>