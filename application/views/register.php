<!DOCTYPE html>
<html>
<head>
	<title>register</title>
</head>
<body>
<div>
		<form method="post" action="">
			<div>
				<label>first name</label>
                <input type="text" name="firstname"><br>
			</div>
			<div>
				<label>last name</label>
		    	<input type="text" name="lastname"><br>
			</div>
			<div>
				<label>email</label>
			    <input type="text" name="email"><br>
			</div>
			<div>
				<label>username <span><?php echo $username_error?></span></label>
			    <input type="text" name="username"><br>
			</div>	
			<div>
				<label>password</label>
		    	<input type="text" name="password"><br>
			</div>
			<div>
				<input type="submit" name="register" value="signup">
			</div>
		</form>
	<div>
		<a href="login">Login</a>
	</div>
</div>
</body>
</html>