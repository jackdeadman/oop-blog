<?php
require_once 'core/ini.php';

$user = new User();

if (isset($_POST)) {
	$user->login($_POST['username'], $_POST['password']);
}
if ($user->loggedIn()) {
	Redirect::to('feed.php');
}

?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login Page</title>
	<link rel="stylesheet" type="text/css" href="styles/style.css">
</head>
<body>
	<div id="wrapper">
		<form method="post">
			<ul>
				<li><input name="username" placeholder="Username" type="text"></li>
				<li><input name="password" placeholder="Password" type="password"></li>
				<li><input type="submit"></li>
				<li><a href="register.php">Register</a></li>
			</ul>
		</form>
	</div>
</body>
</html>