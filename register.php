<?php  

include("database_connection.php");
session_start();
$message = '';
if(isset($_SESSION['user_id']))
{
	header('location:index.php');
}
if(isset($_POST['register']))
{
	$username = trim($_POST['username']);
	$password = trim($_POST['password']);
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
		else
		{
			if(empty($username))
			{
				$message .='<p><label> Username is required</label></p>';
			}
			if(empty($password))
			{
				$message .='<p><label> Password is 	required</label></p>';
			}
			else
			{
				if($password != $_POST['confirm_password'])
				{
					$message .='<p><label> Password does not match</label></p>';
				}
			}
			if($message == "")
			{
				$data = array(':username' => $username,
					':password' => password_hash($password,PASSWORD_DEFAULT));
				$query ="INSERT INTO login (username , password) VALUES (:username,:password)"; 
				$statement=$connect->prepare($query);
				if($statement->execute($data))
				{
					$message .='<p><label>Registration Completed</label></p>';
				}
			}
		}
	}
}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Sign up</title>
	 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.css">
        <link rel="stylesheet" type="text/css" href="style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.js"></script>
</head>
<body>
	<div class="container">
	<br/>
		<h2 align="center" style="color: yellow;background-color: purple;">Chat Application</h2>
		<div class="panel-heading" style="color: black;"><h3>Register Here</h3>
		</div>
		<p class="text-success"><?php echo $message; ?></p>
			<div class="panel-body" style="background-color:lightgrey;opacity: 0.8;"">
				<form method="post">
				<div class="form-group" style="color: yellow;">
				<label>Enter Username</label>
				<input type="text" name="username" class="form-control" />					
				</div>
				<div class="form-group">
				<label>Enter Password</label>
				<input type="password" name="password" class="form-control" />
				</div>
				<div class="form-group">
				<label>Re-enter Password</label>
				<input type="password" name="confirm_password" class="form-control" />	
				</div>
				<div class="form-group">
				<input type="submit" name="register" class="btn btn-info" value="Register" />

				</div>
				<div align="center">
				<a href="login.php"><h2>(Login)</h2></a>
				</div>

				</form>
			</div>
	</div>

</body>
</html>