<?php
class Admin extends User
{
	public function canEditPost($postID = null){
		// Admins an edit all posts
		return true;
	}
}
?>