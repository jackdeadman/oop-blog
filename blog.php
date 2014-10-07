<?php
require_once 'core/ini.php';

$user = new User();
$userDetails = $user->data();

if (!$user->loggedIn()) {
	Redirect::to('index.php');
}

$blog = new Blog($_GET['id']);
$blogDetails = $blog->data();

if (isset($_GET['id'], $_POST['title'], $_POST['body'])) {
	$post = new Post;
	$post->post($userDetails['id'] ,$_GET['id'], $_POST['title'], $_POST['body']);
	$blog = new Blog($_GET['id']);// Details updated
}

$posts = $blog->posts();

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Posts</title>
</head>
<body>
	<header>
		<h1><?php echo $blogDetails['title']?></h1>
		<a href="feed.php">Back</a>
	</header>
	<div>
		<?php
		if ($blog->numberOfPosts() === 0) {?>
			<span>No posts here!!</span>
		<?php	
		}else{
			foreach ($posts as $post) {?>
				<div class="post">
					<header><h2><?php echo $post['title']?></h2></header>
					<div>
						<?php echo $post['body']?>
					</div>
					<div>
						<?php
						if ($user->canEditPost($post['postID'])) {?>
							<a href="editPost.php?id=<?php echo $post['postID']?>">Edit</a>
						<?php
						}
						?>
					</div>
				</div>
			<?php
			}
		}
		?>
	</div>
	<form method="post">
		<fieldset>
			<legend>Add a new post:</legend>
			<div><input type="text" name="title" placeholder="Title"></div>
			<textarea name="body" placeholder="Content"></textarea>
			<input type="submit">
		</fieldset>
	</form>
</body>
</html>