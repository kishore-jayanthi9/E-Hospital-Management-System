<!DOCTYPE html>
<html>
	<head>
		<title>pharmacy</title>
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
		<style type="text/css">
			table,th,td{border:1.4px solid black;padding: 8px;}
			.box{background-color: #179dd0;color:#fff; width: 660px;height:1000%;margin: auto;}
		</style>
	</head>
	<body style="background-color: gray">
		<div class="box">
		<?php
		$conn = mysqli_connect('localhost','root','','hms');
		$sqlPh = "SELECT * FROM prescriptions WHERE pharmacy=$data->id";
		$mysqlPh = mysqli_query($conn,$sqlPh);
		if(mysqli_num_rows($mysqlPh) > 0)
		{
		?>
		<table >
			<tr>
				<th>doctor</th>
				<th>patient</th>
				<th colspan="">Presciption</th>			
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
				<td style="float:left"><?php echo $name->name;?></td>
				<?php
				}
				?>
				<td>
				<?php //echo $pData->prescription;?>
				<a href="<?php echo $pData->file;?>" download>download prescription</a>
				</td>
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
			echo "there are no prescriptions available";
		}
		?>
		</div>
		<div style="text-align: center;">
			<a href="login.php"><button type="submit" style="background-color: red;color:#fff;border:0;padding: 4px;cursor: pointer;">logout</button></a>
		</div>
	</body>
</html>