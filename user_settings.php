<?php 

include('database_connection.php');

session_start();

$message = "";

?>

<!DOCTYPE html>
<html>
<head>
	<title>Settings</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="./style.css">
</head>
<body>
	<div class="container">
		<div class="row">	
			<h2 align="center" style="color: blue;border-bottom: 2px solid black;">User Settings</h2>
		</div>			
	</div>
<div class="container">
	<div class="panel panel-default" style="opacity: 0.6;background-color: black;">
		<div class="panel-heading" style="font-weight: bold;">
			<div class="panel-body">
			<a href="index.php">&laquo; Back to home</a>
				<form method="post" action="index.php">
					<p class="text-danger"><?php echo $message; ?></p>
					<div class="form-group">
						<fieldset>
								<label style="color: #1a6f7a;">Update username :</label><br>
								<input class="input" type="text" name="username" placeholder="Enter new username" autocomplete="on" /> 
								<br/><br>
								<label style="color: #1a6f7a">Update email :</label><br>
								<input class="input" type="email" name="email" placeholder="Enter new email"  autocomplete="on" /> 
								<br><br>
								<label style="color: #1a6f7a">Update password :</label><br>
								<input class="input" type="password" name="password" placeholder="Enter new password" autocomplete="on" /><br><br>
								<label style="color: #1a6f7a">Confirm new password :</label><br>
								<input class="input" type="password" name="password" placeholder="Enter same new password" autocomplete="on" /> <br><br>
								<button class="btn btn-primary" onclick="myfunc()">Submit</button>
						</fieldset>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
</body>
</html>
<script>
	
	function myfunc(){
		alert("Thank You!");
	}

</script>