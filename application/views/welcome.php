
<!DOCTYPE html>
<html>
<head>
	<title>home (<?php echo $user->first_name?>)</title>
</head>
<body>
<nav>
	<a href="auth/change_password">change password</a>
	<a href="auth/edit_profile">edit profile</a>
	<a href="auth/logout">logout</a>
</nav>
<div>
	<div>
		<table>
			<tr>
				<td>Name:</td>
				<td><?php echo $user->first_name?><span> </span><?php echo $user->last_name?></td>
			</tr>
			<tr>
				<td>Email:</td>
				<td><?php echo $user->email?><span></td>
			</tr><tr>
				<td>Phone:</td>
				<td><?php echo $user->phone?><span></td>
			</tr>
		</table>
	</div>
</div>
</body>
</html>