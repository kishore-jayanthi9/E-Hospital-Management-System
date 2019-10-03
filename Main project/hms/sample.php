<?php
if(isset($_POST['submit']))
{
	echo date('d-m-Y',strtotime($_POST['sample']));
}
?>
<html>
	<head>
		<script>
		function validate()
		{
			//alert("ok");
			//document.getElementById("sample").required = false;
			document.getElementById("lBox").style.display = "block";
			document.getElementById("lBox").style.backgroundColor = "green";
			document.getElementById("lBox").style.opacity = "0.25";
			alert("d,b,o");
			document.getElementById("lBox").style.width = window.innerWidth;
			document.getElementById("lBox").style.height = window.innerHeight;
			document.getElementById("lBox").style.position = "absolute";
			document.getElementById("lBox").style.top = 0+"px";
			document.getElementById("lBox").style.left = 0+"px";
			document.getElementById("lBox").style.zIndex = "2";
			document.getElementById("formDiv").style.position = "absolute";
			document.getElementById("formDiv").style.top = 0+"px";
			document.getElementById("formDiv").style.left = 0+"px";
			document.getElementById("formDiv").style.zIndex = "1";
			return false;
		}
		</script>
	</head>
	<body>
		<div id="lBox" style="display:none">
		</div>
		<div id="formDiv">
			<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onsubmit="return validate()">
				<input type="date" name="sample" id="sample" required>
				<input type="submit" value="submit">
			</form>
		</div>
	</body>
</html>