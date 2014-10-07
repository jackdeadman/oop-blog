<?php
require_once 'core/ini.php';
$user = new User();
$userDetails = $user->data();
$postID = $_GET['id'];
$post = new Post($postID);
$postData = $post->data();

if (!$user->canEditPost($postID)) {
	Redirect::to("blog.php?id={$postData['blog_fk']}");
}

if (isset($_POST['title'], $_POST['body'])) {
	$post->update($_POST['title'], $_POST['body']);
	Redirect::to("blog.php?id={$postData['blog_fk']}");
}

if (isset($_GET['delete'])) {
	$post = new Post($_GET['id']);
	$postData = $post->data();
	$post->delete();
	Redirect::to("blog.php?id={$postData['blog_fk']}");
}

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Edit</title>
</head>
<body>
	<div id="wrapper">
		<form method="post">
			<div><input name="title" type="text" value="<?php echo $postData['title']?>"></div>
			<div><textarea name="body"><?php echo $postData['body']?></textarea></div>
			<div>
				<a href="blog.php?id=<?php echo $postData['blog_fk']?>">Back</a>
				<a href="editPost.php?id=<?php echo $postID?>&delete=1">Delete</a>
				<input type="submit" value="Save">
			</div>
		</form>
	</div>
</body>
</html>