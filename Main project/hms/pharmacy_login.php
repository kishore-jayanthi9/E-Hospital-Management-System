<?php
if(isset($_POST['loginSubmit']))
{
	$email = $_POST['loginEmail'];
	$password = $_POST['loginPassword'];
	$conn = mysqli_connect('localhost','root','','hms');
	$sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
	$mysql = mysqli_query($conn,$sql);
	if(mysqli_num_rows($mysql) == 1)
	{
		echo "<script>location.href='home.php?email=$email'</script>";
	}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>login</title>
		<style>
		.form-design{
			margin:auto;
			
			width:280px;
			height:320px;
			padding:20px;
			border:1px solid #c1c3c4;
		}
		.register p{
		text-align:center;
			
		}
		#loginForm{
			
			margin:auto;
			background-color:#f8fbfc;
		    border:1px solid #fff;
		   width:200px;
		   height:240px;
			padding:17px;
			
		}
		#loginEmail{
			padding:12px;
			margin-bottom:10px;
			background-color:#e8eff2;
			border:0;
			border-radius:3px;
			
		}
		#loginPassword{
			padding:12px;
			margin-bottom:10px;
			background-color:#e8eff2;
			border:0;
			border-radius:3px;
		}
		#submit{
			padding:10px 82px 10px 82px;
			margin-bottom:10px;
			background-color:#3498db;
			color:#fff;
			border:0;
			border-radius:3px;
			cursor: pointer;
			
		}
		</style>
	</head>
	<body>
		<h2 style="text-align:center;font-family: verdana;font-weight: 200;color:gray">
			HMS | Pharmacy Login
		</h2>
		<div class="form-design">
	
			<form name="loginForm" id="loginForm" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
			
				<h4 style="text-align:center;color:#3498db">Sign in to your account</h4>
				<div>
					<input type="text" name="loginEmail" id="loginEmail" placeholder="enter email" />
				</div>
				<div>
					<input type="password" name="loginPassword" id="loginPassword" placeholder="password" />
				</div>
				<div>
					<input type="submit" name="loginSubmit" value="login" id="submit" />
				</div>
			</form>
			<div class="register">
			<a href="register.php"><p>create account</p></a>
		</div>
		</div>
		
	</body>
</html>