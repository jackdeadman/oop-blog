<?php
require_once 'core/ini.php';
$user = new User();
$userDetails = $user->data();

if (!$user->loggedIn()) {
	Redirect::to('./');
}

if (isset($_POST['title'])) {
	$blog = new Blog();
	$blog->create($_POST['title']);
}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>New Blogs</title>
</head>
<body>
	<div id="wrapper">
		<header><h2>New Blogs</h2></header>
		<div>Hi, <?php echo $userDetails['username'] ?><a href="logout.php">Logout</a></div>
		<div>
			<?php $blogs = DB::getInstance()->get('blog');
			foreach ($blogs as $blog) {
				$blogObj = new Blog($blog['id']);
				?>
				<div>
					<header><h2><a href="blog.php?id=<?php echo $blog['id']?>"><?php echo $blog['title'] . '(' . $blogObj->numberOfPosts() . ')'?></a></h2></header>
				</div>
			<?php	
			}
			?>
		</div>
		<form method="post">
			<fieldset>
				<legend>Add a new post:</legend>
				<div><input type="text" name="title" placeholder="Title"></div>
				<input type="submit">
			</fieldset>
		</form>
	</div>
</body>
</html>