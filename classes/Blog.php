<?php
/**
* 
*/
class Blog
{
	private $_posts = array(),
			$_data = array(),
			$_db;
	
	function __construct($id = null){
		$this->_db = DB::getInstance();
		if ($id) {
			$sql = "SELECT post.*, user.*, post.id AS postID
					FROM post
					JOIN user
					ON user.id = post.user_fk
					JOIN blog
					ON blog.id = post.blog_fk
					WHERE blog.id = $id";
			$this->_posts = $this->_db->query($sql)->results();
			$this->_data = $this->_db->query("SELECT * FROM blog WHERE blog.id = '$id'")->first();
		}
	}

	public function create($title){
		$this->_db->query("INSERT INTO blog(title) VALUES('$title')");
	}

	public function data(){
		return $this->_data;
	}

	public function posts($id = null){
		if ($id) {
			$sql = "SELECT post.*, user.*, post.id AS PostID
					FROM post
					JOIN user
					ON user.id = post.user_fk
					JOIN blog
					ON blog.id = post.blog_fk
					WHERE post.id = $id";
			return $this->_data = $this->_db->query($sql)->results();
		}else{
			return $this->_posts;
		}
	}

	public function delete(){
		if (!empty($this->_data)) {
			$this->_db->query("DELETE FROM blog WHERE id = $this->_data['id']");
			$this->_db->query("DELETE FROM post WHERE blog_fk = $this->_data['id']");
		}
	}

	public function numberOfPosts(){
		return count($this->_posts);
	}
}
?>