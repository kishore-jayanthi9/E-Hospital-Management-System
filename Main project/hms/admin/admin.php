<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>HMS HEALTHCARE</title>

  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans|Raleway|Candal">
  <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
 
  <style>
  	table,th,td{padding: 14px;}
  </style>
</head>
<body>
	<div class="container">
		<h2 style="text-align:center;font-family: verdana;font-weight: 100;color:gray;margin-top:20px;">HMS | Admin</h2>
		<div>&nbsp;</div>
	<?php
	$conn = mysqli_connect('localhost','root','','hms');
	$sql = "SELECT * FROM users";
	$mysql = mysqli_query($conn,$sql);
	if(mysqli_num_rows($mysql) > 0)
	{	
	?>
		<table class="table-bordered">
		<tr>
			<th>user_id</th>
			<th>registerAs</th>
			<th>i_am</th>
			<th>pname</th>
			<th>name</th>
			<th>address</th>
			<th>city</th>
			<th>gender</th>
			<th>email</th>
			<th>password</th>
			<th>mobile</th>
		</tr>
		<?php
		while($users = mysqli_fetch_object($mysql))
		{
		?>
		<tr>
			<td><?php echo $users->id;?></td>
			<td><?php echo $users->registerAs;?></td>
			<td><?php echo $users->i_am;?></td>
			<td><?php echo $users->pname;?></td>
			<td><?php echo $users->name;?></td>
			<td><?php echo $users->address;?></td>
			<td><?php echo $users->city;?></td>
			<td><?php echo $users->email;?></td>
			<td><?php echo $users->password;?></td>
			<td><?php echo $users->mobile;?></td>
			<td>8796765675</td>
		</tr>
		<?php
		}
		?>
	</table>
	<?php
	}
	?>
	</div>
</body>
</html>