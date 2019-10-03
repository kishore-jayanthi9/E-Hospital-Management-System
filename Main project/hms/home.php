<?php
$email = $_GET['email'];
$conn = mysqli_connect('localhost','root','','hms');
$sql = "SELECT * FROM users WHERE email='$email'";
$mysql = mysqli_query($conn,$sql);
?>
<!DOCTYPE html>
<html>
	<head>
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans|Raleway|Candal">
  <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
		<title>home</title>
		<script>
		function requestAppointment(event,userId,email)
		{
			var id = event.currentTarget.id;
			//alert(id);
			location.href = "appointment.php?a_from="+id+"&a_to="+userId+"&email="+email;

		}
		function appointment(event,userId)
		{
			//alert(event.target.id);
			var id = event.target.id;
			var xhr = new XMLHttpRequest();
			xhr.open("get","appointment.php?id="+id+"&userId="+userId,true);
			xhr.onreadystatechange = function()
			{
				if(xhr.readyState == 4)
				{
					//document.getElementById("response"+id).innerHTML = xhr.responseText;
					document.getElementById(id).innerHTML = xhr.responseText;
					document.getElementById("box").innerHTML = xhr.responseText;
				}
			}
			xhr.send("");			
		}
		function giveAppointment(id,docId,patId)
		{
			//alert(id);
			var xhr = new XMLHttpRequest();
			xhr.open("get","editapp.php?id="+id+"&change=approve");
			xhr.onreadystatechange = function()
			{
				if(xhr.readyState == 4)
				{
					
					document.getElementById("give"+id).innerHTML = "<a class='btn btn-primary' href='prescription.php?docId="+docId+"&patId="+patId+"'>send prescription</a>";
					document.getElementById("response"+id).innerHTML = xhr.responseText;
					document.getElementById("deny"+id).style.display = "none";
				}
			}
			xhr.send("");
		}
		function denyAppointment(id)
		{
			//alert(id);
			var xhr = new XMLHttpRequest();
			xhr.open("get","editapp.php?id="+id+"&change=deny");
			xhr.onreadystatechange = function()
			{
				if(xhr.readyState == 4)
				{
					document.getElementById("response"+id).innerHTML = xhr.responseText;
					//document.getElementById("give"+id).innerHTML = "";
					//document.getElementById("deny"+id).innerHTML = "";
					document.getElementById("deny"+id).style.display = "none";
					document.getElementById("give"+id).style.display = "none";
				}
			}
			xhr.send("");
		}
		function appointmentClose()
		{
			//alert("close");
			document.getElementById("appointmentBox").style.display = "none";
			document.getElementById("lBox").style.display = "none";
		}
		function getDoctors(city,email)
		{
			//alert(email);
			var speVal = document.getElementById("specialist").value;//speVal = specialist value
			//alert(speVal);
			var xhr = new XMLHttpRequest();
			xhr.open("get","get_doctors.php?s="+speVal+"&city="+city+"&email="+email,true);
			xhr.onreadystatechange = function()
			{
				if(xhr.readyState == 4)
				{
					//alert(xhr.responseText);
					document.getElementById("doctors").innerHTML = xhr.responseText;
				}
			}
			xhr.send("");
		}
		</script>
	</head>
	<body>
	<div id="lBox" style="display:block">
	</div>
	<div id="appointmentBox" style="display:none">
		<div id="box">
			<div id="appointmentDoctorName">			
			</div>
			<div>
				<input type="text" id="appointmentDate" placeholder="enter appointment date in dd/mm/yyyy format">
			</div>
			<div id="appointmentRequest">
				request for appointment
			</div>
		</div>
		<div onclick="appointmentClose()">
			close
		</div>
	</div>
	<div id="page">
	<?php
	if($data = mysqli_fetch_object($mysql))
	{
		if($data->registerAs == "doctor")
		{
			include("doctors.php");
		}
		else if($data->registerAs == "patient")
		{
			include("patients.php");
		}
		else if($data->registerAs == "pharmacy")
		{
			include("pharmacy.php");
		}
	}
	?>
	</div>
	<br>
	
</html>