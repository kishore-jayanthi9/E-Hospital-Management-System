<?php
$city = $_GET['city'];;
$specialist = $_GET['s'];
$email = $_GET['email'];
$conn = mysqli_connect('localhost','root','','hms');
$sqlCity = "SELECT * FROM users WHERE registerAs='doctor' AND i_am='$specialist' AND city='$city'";
$mysqlCity = mysqli_query($conn,$sqlCity);
if(mysqli_num_rows($mysqlCity) > 0)
{
while($doctorData = mysqli_fetch_object($mysqlCity))
{
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
				$sqlEmail = "SELECT id FROM users WHERE email='$email'";
				$mysqlEmail = mysqli_query($conn,$sqlEmail);
				if($data = mysqli_fetch_object($mysqlEmail))
				{
					$a_to = $data->id;	
				}
				$a_from = $doctorData->id;
				$sqlStatus = "SELECT * FROM appointments WHERE a_from=$a_from AND a_to=$a_to";
				$mysqlStatus = mysqli_query($conn,$sqlStatus);
				$status = mysqli_fetch_object($mysqlStatus);
				//die(mysqli_num_rows($mysqlStatus));
				//die("dtata id is ".$data->id);
				if(mysqli_num_rows($mysqlStatus) == 0)
				{
				?>
				<td style="padding: 10px 20px 10px 20px;" onclick="requestAppointment(event,<?php echo $data->id;?>,'<?php echo $email; ?>')" id="<?php echo $doctorData->id;?>"><a href="#" class="btn btn-primary">ask for appointment</a></td>
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
	echo "there are no doctors available";
}
?>
