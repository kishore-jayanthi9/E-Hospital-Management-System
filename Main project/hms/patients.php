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
	.container{
margin-top: 50px;
	}
</style>
	<body style="background-color:#e7f1f554">
	<div class="container">
		<div style="background-color:#ffff;color:gray;width:400px;height:100%;margin: auto;text-align: center;padding: 15px;" id="patientBox">
		<h2>Doctors</h2><br>
		<div>
			<?php
			$city = $data->city;
			?>
			<select style="padding: 5px;margin-bottom: 5px;" id="specialist" onchange="getDoctors('<?php echo $city;?>','<?php echo $data->email; ?>')">
				<option value="select a specialist">select a specialist</option>
				<option value="cardiologist">cardiologist</option>
				<option value="radiologist">radiologist</option>
				<option value="orthopedician">orthopedician</option>
				<option value="dermatologist">dermatologist</option>
				<option value="dentist">dentist</option>
			</select>
		</div>
		<div>&nbsp;</div>
		<div id="doctors">
		<?php
		$city = $data->city;
		//$sqlCity = "SELECT * FROM users WHERE registerAs='doctor' and city='$city'";
		$sqlCity = "SELECT * FROM users WHERE registerAs='doctor' and city='$city'";
		$mysqlCity = mysqli_query($conn,$sqlCity);
		if(mysqli_num_rows($mysqlCity) > 0)
		{
			$i = 0;
		while($doctorData = mysqli_fetch_object($mysqlCity))
		{
			$i++;
			//echo $i;
		?>
		<div style="margin-left: 40px;">
			<table class="table-bordered">
				<tr>
					<td style="padding: 10px 20px 10px 20px; ">
					<?php
					echo $doctorData->name;
					?>
					</td>
					<?php
					$a_to = $data->id;
					$a_from = $doctorData->id;
					$sqlStatus = "SELECT * FROM appointments WHERE a_from=$a_from AND a_to=$a_to";
					$mysqlStatus = mysqli_query($conn,$sqlStatus);
					$status = mysqli_fetch_object($mysqlStatus);
					//die(mysqli_num_rows($mysqlStatus));
					if(mysqli_num_rows($mysqlStatus) == 0)
					{
					?>
					<td style="padding: 10px 20px 10px 20px;" onclick="requestAppointment(event,<?php echo $data->id;?>,'<?php echo $data->email;?>')" id="<?php echo $doctorData->id;?>"><a href="#" class="btn btn-primary">ask for appointment</a></td>
					<?php
					}
					else
					{
					?>
					<td>
						your request for appointment has been sent.
					</td>
					<?php
					}
					?>
				</tr>
			</table>
			<div id="response<?php echo $doctorData->id; ?>">
			</div>
		</div>
		<?php
		}
		}
		else
		{
		?>
			<div style="padding: 20px; text-align: center;border:1px solid red; width:500px;margin:auto;margin-top: 30px">
				there are no doctors available
			</div>
		<?php	 
		}
		?>
		</div>
	</div>	



    <div class="container">
		<div style="background-color:#ffff;color:gray;width:400px;height:100%;margin: auto;text-align: center;padding: 15px;" id="patientBox">
		<h2>Messages</h2><br>
			<?php
			$sqlM = "SELECT * FROM messages WHERE m_to=$data->id";
			$mysqlM = mysqli_query($conn,$sqlM) or die(mysqli_error($conn));
			if(mysqli_num_rows($mysqlM) > 0)
			{
			?>
			<table class="table">
				<tr>
					<th>pharmacy name</th><th>message</th><th>sent on</th>
				</tr>
			<?php			
			while($messages = mysqli_fetch_object($mysqlM))
			{
			?>
				<tr>
					<td>
						<?php
						$sqlPhName = "SELECT * FROM users WHERE id=$messages->p_id";
						$mysqlPhName = mysqli_query($conn,$sqlPhName); 
						if($phName = mysqli_fetch_object($mysqlPhName))
						{
							echo $phName->pname;
						}
						?>
					</td>
					<td>
						<?php 
						echo $messages->message;
						?>
					</td>
					<td><?php echo date("d-m-Y",$messages->sent_at)?></td>
				</tr>
			<?php
			}
			}
			else
			{
			?>
			<tr><td colspan="2">there are no messages</td></tr>
			<?php
			}
			?>
			</table>
		</div>
    </div>
    <div style="text-align: center;">
		<a href="login.php"><button type="submit"  class="btn btn-danger">logout</button></a>
	</div>
	</body>
</html>