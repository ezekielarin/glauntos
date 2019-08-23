<!DOCTYPE html>
<html>
<head>
	<title>login</title>
</head>
<body>

<div class="container">
   <div class="row">

		<form method="post">
			<label>email</label>
			<input type="text" name="username"><br>
			<label>password</label>
			<input type="password" name="password"><br>
			<input type="checkbox" name="remember" value="1"> Remember me<br>
			<input type="submit" name="login" value="login">	
		</form>
    <div>
		<a href="forgot_password/">Forgot password</a>
		<a href="register">Signup</a>
	</div>
</div>
<style type="text/css">
	.container{
      position: center;
      padding: 20px;
      align-content: center;
      overflow: left;
	}
	.row{
       border: 2px;

	}
	.container .row{

	}
</style>

</body>
</html>