<?php 

include('database_connection.php');

session_start();

$message = "";


if(isset($_POST['submit']))
{
	$id = $_SESSION['user_id'];
	$username = trim($_POST['username']);
	$check_query = "SELECT * FROM login WHERE username = :username";
	$statement = $connect->prepare($check_query);
	$check_data = array(
		':username' => $username);
	if($statement->execute($check_data))
	{
		if($statement->rowCount() > 0 )
		{
			$message .='<p><label>Username already taken</label></p>';
		}
		if(empty($username))
		{
			$message .='<p><label> Username is required</label></p>';
		}
		else
		{
		$query = "UPDATE login SET username ='$username' WHERE user_id = $id";
		$statement=$connect->prepare($query);
		$statement->execute();
		$message .= "Success...";	
		}
	}
}

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
			<h2 align="center" style="color: yellow;background-color: purple;">User Settings</h2>
		</div>			
	</div>
	
<div class="container">
	<div class="panel panel-default" style="opacity: 0.7;">
		<div class="panel-heading" style="font-weight: bold;">
			<div class="panel-body">
			<a href="index.php">&laquo; Back to home</a>
				<form method="post" action="user_settings.php">
					<p class="text-success"><?php echo $message; ?></p>
					<div class="form-group">
						<fieldset>
								<label style="color: #1a6f7a;">Update username :</label><br>
								<input class="input" type="text" name="username" placeholder="Enter new username" autocomplete="off" /> 
								<br><br>
								<label style="color: #1a6f7a;">Enter Password</label><br>
								<input class="input" type="password" name="password" placeholder="Enter password" />
								<br><br>
								<input type="submit" name="submit" value="Update">
						</fieldset>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
</body>
</html>