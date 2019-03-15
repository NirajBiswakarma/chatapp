<?php
include('database_connection.php');

session_start();

$message="";

if(isset($_POST["login"]))
{
	$query ="SELECT * FROM login WHERE username = :username";
	$statement = $connect->prepare($query);
	$statement -> execute(
		array(
			':username' => $_POST["username"]
			)
		);
	$count = $statement->rowCount();
	if($count > 0)
	{
		$result = $statement->fetchAll();
		foreach($result as $row) 
		{
			if($_POST['password'] === $row['password']) //Directly checking equality.....
			{
				$_SESSION['user_id'] = $row['user_id'];
				$_SESSION['username'] = $row['username'];
				$sub_query = "
					INSERT INTO  login_details(user_id) VALUES('".$row['user_id']."')
					";
					$statement = $connect->prepare($sub_query);
					$statement->execute();
					$_SESSION['login_details_id']=$connect->lastInsertId(); //Gives you last inserted id..
					header('loaction:index.php');
			}
			else
			{
				$message = "<label> Wrong Password </label>";
			}
		}
	}
	else
	{
		$message = "<label>Wrong username </label>";
	}

}
if(isset($_SESSION['user_id']))
{
	header('location:index.php');
}
?>
<html>
<head>
	<title>Login</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="./style.css">
</head>
<body>
<div class="container">
<h1 id="loginh1"><?php echo "Chat Application"; ?></h1>
<br/>
	<div class="panel panel-default" style="opacity: 0.6">
		<div class="panel-heading" style="font-weight: bold;">Chat Application Login Page
			<div class="panel-body">
				<form method="post" action="login.php">
					<p class="text-danger"><?php echo $message; ?></p>
					<div class="form-group">
					<fieldset>
						<legend>Login Details :</legend>
							<label>Username :</label>
							<input class="input" type="text" name="username" placeholder="Enter username" required /> 
					</div>
						<label>Password :</label>
						<input class="input" type="password" name="password" placeholder="Enter password" required  />
						<br>
						<br> 
						<input type="submit" name="login" class="btn btn-info" value="Login">
					</fieldset><br>
				</form>
				<h3>Not a member?? <a href="register.php">Sign Up</a></h3>
			</div>
		</div>
	</div>
</div>
</body>
</html>