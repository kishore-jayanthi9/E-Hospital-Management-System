<?php
if(isset($_POST['submit']) && isset($_POST['agree']))
{
	$registerAs = $_POST['registerAs'];
	if($registerAs == "doctor")
	{
		$iAm = $_POST['iAm'];		
	}
	else
	{
		$iAm = '';
	}
	if($registerAs == "pharmacy")
	{
		$pName = $_POST['pharmacyName'];		
	}
	else
	{
		$pName = '';
	}
	$fullName = $_POST['full_name'];
	$address = $_POST['address'];
	$city = $_POST['city'];
	$gender = $_POST['gender'];
	$email = $_POST['email'];
	$mobile = $_POST['mobile'];
	$password = $_POST['password'];
	$passwordAgain = $_POST['password_again'];
	if($password == $passwordAgain)
	{
		$dbPassword = $password;
		$conn = mysqli_connect('localhost','root','','hms');
		$sql = "INSERT INTO users (registerAs,i_am,pname,name,address,city,gender,email,password,mobile) VALUES ('$registerAs','$iAm','$pName','$fullName','$address','$city','$gender','$email','$dbPassword','$mobile')";
	}	
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>doctor registration</title>
		<link rel="stylesheet" type="text/css" href="style.css">

		<!--font-family link-->
		<link href="https://fonts.googleapis.com/css?family=Raleway|Roboto+Slab" rel="stylesheet"> 

		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

		<!-- Latest compiled JavaScript -->
		<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
		<script>
		var formSubmit = true;
		var validateEmail = true;
		function show()
		{
			//alert("show");
			var rav = document.getElementById("registerAs").value;
			if(rav == "doctor")
			{
				document.getElementById("iAmDiv").style.display = "block";
				document.getElementById("pharmacyName").style.display = "none";
				document.getElementById("pharmacyName").removeAttribute("required");
			}
			else if(rav == "pharmacy")
			{
				document.getElementById("pharmacyName").style.display = "block";
				document.getElementById("iAmDiv").style.display = "none";
				document.getElementById("pharmacyName").setAttribute("required","");
			}
			else if(rav == "patient")
			{
				document.getElementById("iAmDiv").style.display = "none";
				document.getElementById("pharmacyName").style.display = "none";
				document.getElementById("pharmacyName").removeAttribute("required");
			}
		}
		function userAvailability()
		{
			var email = document.getElementById("email").value;
			var xhr = new XMLHttpRequest();
			xhr.open("get","check_email.php?email="+email,true);
			xhr.onreadystatechange = function()
			{
				if(xhr.readyState == 4)
				{
					if(xhr.responseText == "not available")
					{
						validateEmail = false;
					}
					else if(xhr.responseText == "available")
					{
						validateEmail = true;
					}
					document.getElementById("user-availability-status1").innerHTML = xhr.responseText;
				}
			}
			xhr.send("");
		}
		function validate()
		{
			var formSubmit = true;
			if(document.getElementById("registerAs").value == "register as")
			{
				//alert("in if");
				document.getElementById("registerAsResult").innerHTML = "select register as";
				formSubmit = false;
			}
			else
			{
				document.getElementById("registerAsResult").innerHTML = "";
			}
			//alert(formSubmit);
			if(document.getElementById("iAmDiv").style.display == "block")
			{
				if(document.getElementById("iAm").value == "I am")
				{
					document.getElementById("iAmResult").innerHTML = "select your specialization";
					formSubmit = false;
				}
				else
				{
					document.getElementById("iAmResult").innerHTML = "";
				}
			}
			else
			{
				document.getElementById("iAmResult").innerHTML = "";
			}
			var nameExp = /^[a-zA-Z ]+$/
			var name = document.getElementById("full_name").value;
			if(nameExp.test(name) == false)
			{
				document.getElementById("fullNameResult").innerHTML = "enter a valid name";
				formSubmit = false;
			}
			else
			{
				document.getElementById("fullNameResult").innerHTML = "";
			}
			if(document.registration.gender[0].checked == false && document.registration.gender[1].checked == false)
			{
				document.getElementById("genderResult").innerHTML = "select gender";
				formSubmit = false;
			}
			else
			{
				document.getElementById("genderResult").innerHTML = "";
			}
			var emailExp = /^[a-zA-Z0-9._]+@[a-zA-Z.]+\.[a-zA-Z]{2,4}$/;
			var email = document.getElementById("email").value;
			if(emailExp.test(email) == false)
			{
				document.getElementById("user-availability-status1").innerHTML = "invalid email";
				formSubmit = false;
			}
			else
			{
				document.getElementById("user-availability-status1").innerHTML = "";
			}
			userAvailability();
			if(validateEmail == false)
			{
				document.getElementById("user-availability-status1").innerHTML = "email is not available";
				formSubmit = false;
			}
			else
			{
				document.getElementById("user-availability-status1").innerHTML = "email is available";
			}
			var password = document.getElementById("password").value;
			var passwordAgain = document.getElementById("password_again").value;
			if(password != passwordAgain)
			{
				document.getElementById("passwordResult").innerHTML = "passwords didn't match";
				formSubmit = false;
			}
			else
			{
				document.getElementById("passwordResult").innerHTML = "";
			}
			var mobileExp = /^[0-9]{10}$/
			var mobile = document.getElementById("mobile").value;
			//alert(mobileExp.test(mobile));
			if(mobileExp.test(mobile) == false)
			{
				document.getElementById("mobileResult").innerHTML = "invalid mobile number";
				formSubmit = false;
			}
			else
			{
				document.getElementById("mobileResult").innerHTML = "";
			}
			if(document.registration.agree.checked == false)
			{
				document.getElementById("agreeResult").innerHTML = "please agree to terms and conditions";
				formSubmit = false;
			}
			else
			{
				document.getElementById("agreeResult").innerHTML = "";
			}
			if(formSubmit == false)
			{
				return false;
			}
		}	
		</script>
		<style>
			#registration{background-color: #fff;}
			.box-register{background-color: #fff;}
			.form-actions button{margin-right: 40px;margin-buttom: 10px}
		</style>
	</head>
	<body style="background-color: #e7f1f5">
		<div class="box-register">
			
			<form name="registration" id="registration"  method="post" action="<?php echo $_SERVER['PHP_SELF']?>" onsubmit="return validate()">
				<fieldset>
					<legend class="Sign">
						Sign Up
					</legend>
					<p class="sign-para">
						Enter your personal details below
					</p>
					<div class="form-group value">
						<select name="registerAs" id="registerAs" onchange="show()">
							<option value="register as">register as</option>
							<option value="doctor">doctor</option>
							<option value="patient">patient</option>
							<option value="pharmacy">pharmacy</option>
						</select>
					</div>
					<div id="registerAsResult">
					</div>
					<div class="form-group value" id="iAmDiv" style="display: none;">
						<select name="iAm" id="iAm">
							<option value="I am">I am</option>
							<option value="cardiologist">cardiologist</option>
							<option value="radiologist">radiologist</option>
							<option value="orthopedician">orthopedician</option>
							<option value="dermatologist">dermatologist</option>
							<option value="dentist">dentist</option>
						</select>
					</div>
					<div id="iAmResult">
					</div>
					<div class="form-group value" id="pharmacyName" style="display: none;">
						<input type="text" class="form-control" name="pharmacyName" placeholder="Pharmacy Name">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="full_name" id="full_name" placeholder="Your Full Name" required>
					</div>
					<div id="fullNameResult">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="address" placeholder="Address" required>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="city" placeholder="City" required>
					</div>
					<div class="form-group" style=" font-family: 'Roboto Slab', serif; padding-left: 30px;">
						<label class="block">
							Gender
						</label>
						<div class="clip-radio radio-primary">
							<input type="radio" id="rg-female" name="gender" value="female" >
								<label for="rg-female">
									Female
								</label>
								<input type="radio" id="rg-male" name="gender" value="male">
								<label for="rg-male">
									Male
								</label>
						</div>
					</div>
					<div id="genderResult">
						
					</div>
					<p class="para">
						Enter your account details below:
					</p>
					<div class="form-group">
						<span class="input-icon">
							<input type="email" class="form-control" name="email" id="email" onBlur="userAvailability()"  placeholder="Email" required>
							<i class="fa fa-envelope"></i> 
						</span>
						<span id="user-availability-status1" style="font-size:12px;"></span>
					</div>
					<div class="form-group">
						<span class="input-icon">
							<input type="password" class="form-control" id="password" name="password" id="password" placeholder="Password" required>
							<i class="fa fa-lock"></i> 
						</span>
					</div>
					<div class="form-group">
						<span class="input-icon">
							<input type="password" class="form-control" name="password_again" id="password_again" placeholder="Password Again" required>
							<i class="fa fa-lock"></i> 
						</span>
					</div>
					<div id="passwordResult">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="mobile" id="mobile" placeholder="mobile number" required>
					</div>
					<div id="mobileResult">
					</div>
					<div class="form-group" style="padding-left: 40px;  font-family: 'Roboto Slab', serif;">
						<div class="checkbox clip-check check-primary">
							<input type="checkbox" name="agree" id="agree" value="agree">
							<label>
								I agree
							</label>
						</div>
						<div id="agreeResult">
						</div>
					</div>
					<div class="form-actions">
						<p class="account">
							Already have an account?
							<a href="login.php">
								Log-in
							</a>
						</p>
						<button type="submit" class="btn btn-primary pull-right" id="submit" name="submit">
							Submit <i class="fa fa-arrow-circle-right"></i>
						</button>
					</div>
				</fieldset>
			</form>
			<div>
			<?php
			if(isset($_POST['submit']) && isset($_POST['agree']))
			{
				if(mysqli_query($conn,$sql) or die(mysqli_error($conn)))
				{
					echo "<script>location.href='home.php?email=$email'</script>";
				}
			}
			else if(isset($_POST['submit']) && !isset($_POST['agree']))
			{
				echo "please agree to the terms and conditions";

			}
			?>
			</div>
					
		</div>
	</body>
</html>