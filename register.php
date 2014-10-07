<?php
require_once 'core/ini.php';
$user = new User();
if ($user->loggedIn()) {
	Redirect::to('feed.php');
}
if (isset($_POST['username'], $_POST['password'], $_POST['passwordRepeat'])) {
	if ($_POST['password'] === $_POST['passwordRepeat']) {
		$user->register($_POST['username'], $_POST['password']);
	}
}

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Register</title>
</head>
<body>
	<div id="wrapper">
		<div>
			<a href="./">Login</a>
		</div>
		<form method="post">
			<ul>
				<li><input type="text" placeholder="Username" name="username"></li>
				<li><input type="password" placeholder="Password" name="password"></li>
				<li><input type="password" placeholder="Password Again" name="passwordRepeat"></li>
				<li><input type="submit"></li>
			</ul>
		</form>
	</div>
</body>
</html>