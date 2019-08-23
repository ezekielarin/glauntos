<!DOCTYPE html>
<html>
<head>
	<title>register</title>
</head>
<body>
<div>
	<p>
		<form method="post" action="">
			<label>first name</label>
			<input type="text" name="firstname"><br>
			<label>last name</label>
			<input type="text" name="lastname"><br>
			<label>email</label>
			<input type="text" name="email"><br>
			<label>username <span><?php echo $username_error?></span></label>

			<input type="text" name="username"><br>
			<label>password</label>
			<input type="text" name="password"><br>
			<input type="submit" name="register" value="signup">
		</form>
	</p>

	<div>
		<a href="login">Login</a>
	</div>
</div>
</body>
</html>