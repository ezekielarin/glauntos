<!DOCTYPE html>
<html>
<head>
	<title>Reset password</title>
</head>
<body>

<div>
	
<?php print_r($user) ?>
<form method="post">
	<label> password</label>
	<input type="hidden" name="username" value="<?php echo $user->username?>"><br>
	<input type="text" name="password"><br>
	<label>retype password</label>
	<input type="text" name="retype_password">
	<input type="submit" name="login" value="login">
</form>
</div>
</body>
</html>