
<!DOCTYPE html>
<html>
<head>
	<title>home  (<?php echo $user->first_name?>)</title>
</head>
<body>
<nav>
	<a href="auth/change_password">change password</a>
	<a href="auth/logout">logout</a>
</nav>
<div>
	<div>
		<form method="post">
			<label>first name</label>
			<input type="hidden" name="username" value="<?php echo $user->username?>"><br>
			<input type="text" name="first_name" value="<?php echo $user->first_name?>"><br>
            <label>last name</label>
			<input type="text" name="last_name" value="<?php echo $user->last_name?>"><br>
			<label>phone</label>
			<input type="text" name="phone" value="<?php echo $user->phone?>"><br>
			<input type="submit" name="update" value="update">
		</form>
	</div>
</div>
</body>
</html>