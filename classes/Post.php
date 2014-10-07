<?php
/**
* 
*/
class Post
{
	private $_db,
			$_data,
			$_id;
	
	function __construct($id = null){
		$this->_db = DB::getInstance();
		if ($id) {
			$sql = "SELECT post.*, user.*, post.id AS postID
					FROM post
					JOIN user
					ON user.id = post.user_fk
					JOIN blog
					ON blog.id = post.blog_fk
					WHERE post.id = $id";
			$this->_data = $this->_db->query($sql)->first();
		}
	}

	public function post($userID, $blog, $title, $body){
		// Needs validation
		$this->_db->query("INSERT INTO post(user_fk, blog_fk, title, body) VALUES('$userID', '$blog' ,'$title', '$body')");
	}

	public function update($title, $body){
		
		$this->_db->query("UPDATE post SET title = '$title', body = '$body' WHERE post.id = {$this->_data['postID']}");
	}

	public function delete(){
		$this->_db->query("DELETE FROM post WHERE id = {$this->_data['postID']}");
	}

	public function data(){
		return $this->_data;
	}

	public function posts(){
		return $this->_results;
	}
}
?>