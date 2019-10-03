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
  <script>
		function sendMessage(id,responseId,docId,pId)
		{
			var xhr = new XMLHttpRequest();
			xhr.open("get","message.php?id="+id+"&docId="+docId+"&pId="+pId,true);
			xhr.onreadystatechange = function()
			{
				if(xhr.readyState == 4)
				{
					//alert(xhr.responseText);
					document.getElementById("response"+responseId).innerHTML = xhr.responseText;
				}
			}
			xhr.send("");
		}
		</script>
  
</head>
<style>
	.container{
margin-top: 50px;
	}
	table{margin:auto;}
	table,tr,th,td{padding: 20px;}
</style>
	<body style="background-color:#e7f1f554">
    <div class="container">
		<div style="background-color:#ffff;color:gray;width:800px;height:100%;margin: auto;text-align: center;padding: 15px;" id="patientBox">			
		<h2>Prescriptions</h2><br>
		<?php
		$conn = mysqli_connect('localhost','root','','hms');
		$sqlPh = "SELECT * FROM prescriptions WHERE pharmacy=$data->id";
		$mysqlPh = mysqli_query($conn,$sqlPh);
		if(mysqli_num_rows($mysqlPh) > 0)
		{
		?>
			<table class="table-bordered" >
				<tr>
					<th>Doctor Name</th>
					<th>Patient Name</th>
					<th>Prescription</th>
				</tr>
				<?php
			while($pData = mysqli_fetch_object($mysqlPh))//pData = pharmacy data
			{
			?>
				<tr>
					<?php			
				$sqlN = "SELECT name FROM users WHERE id=$pData->doc_id";
				$mysqlN = mysqli_query($conn,$sqlN);
				if($name = mysqli_fetch_object($mysqlN))
				{
				?>
					<td><?php echo $name->name;?></td>
				<?php
				}
				$sqlN = "SELECT name FROM users WHERE id=$pData->pat_id";
				$mysqlN = mysqli_query($conn,$sqlN);
				if($name = mysqli_fetch_object($mysqlN))
				{
				?>
					<td><?php echo $name->name;?></td>
				<?php
				}
				?>
					<td><a href="<?php echo $pData->file;?>" download>download prescription</a></td>
					<td>
						<div id="response<?php echo $pData->id;?>" style="float:left">
							<div style="float:left" onclick="sendMessage(<?php echo $pData->pat_id;?>,<?php echo $pData->id;?>,<?php echo $pData->doc_id;?>,<?php echo $data->id;?>)">
								send message
							</div>
						</div>
					</td>
				</tr>
				<?php
			}
			?>
			</table>
			<?php
			}
			else
			{
			?>
			<div style="padding: 20px; text-align: center;border:1px solid red; width:500px;margin:auto;margin-top: 30px">There are no prescriptions
			</div>
			<?php
			}
			?>
			<div>&nbsp;</div>
	<div style="text-align: center;clear: both">
		<a href="login.php"><button type="submit" class="btn btn-danger">logout</button></a>
	</div>

        </div>
		</body>

	</html>