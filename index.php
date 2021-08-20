<!DOCTYPE html>
<html>
<head>
	<title>Dry Cleaning Management System</title>
	<link rel="stylesheet" type="text/css" href="css/common.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
	
	<div style="margin-top: 10%;">
		<div class="row" >
			<div class="col-sm-4"></div>
			<div class="card col-sm-4">
				<div class="card-body">
					<img src="img/logo.png" style="width:100%; height: auto; margin-bottom: 9%;">
					<form method="POST" action="" id="login_form" style="margin-left: 30%; margin-right: auto;">
						<div class="form-group" >
							<input type="text" id="username" name="username" placeholder="Username" />
						</div>
						<div class="form-group">
							<input type="password" id="password" name="password" placeholder="Password" />
						</div>
					</form>
					<div id="error_message" style="display: none;" class="alert alert-danger">
					</div>
					<div style="margin-left: 40%; margin-right: auto;">
						<input type="button" id="login_btn" value="Login" class="btn btn-info" onClick="validateLogin();" >
					</div>
				</div>	
			</div>
			<div class="col-sm-4"></div>
		</div>
	</div>
</body>
</html>
<script type="text/javascript">
	function validateLogin()
	{
		if($("#username").val() == "" || $("#password").val() == "")
		{
			document.getElementById('error_message').innerHTML = "Username and password cannot be blank. Please try again.";
			document.getElementById('error_message').style.display = "block";
		}
		else
		{
			$.ajax({
				type: 'POST',
				url: 'php/login.php',
				data: $("#login_form").serialize(),
				dataType: 'json',
				success: function(res)
				{
					if(res.status == "error")
					{
						document.getElementById('error_message').innerHTML = res.message;
						document.getElementById('error_message').style.display = "block";
					}
					else
					{
						window.location.href = res.url;
					}
				}			
			});
		}
	}
</script>