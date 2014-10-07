<?php
/**
* 
*/
class User
{
	private $_sessionName = 'userID',
			$_loggedIn = false,
			$_data = array(),
			$_db;
	
	public function __construct(){
		$this->_db = DB::getInstance();

		if (isset($_SESSION[$this->_sessionName])) {
			$userID = $_SESSION[$this->_sessionName];
			$this->_loggedIn = true;
			$this->_data = $this->_db->query("SELECT * FROM user WHERE id = $userID")->first();
		}

	}

	public function login($username, $password){
		if (isset($username, $password)) {
			$data = $this->_db->query("SELECT * FROM user WHERE username = '$username'")->first();
			if (count($data) !== 0) {

				$actualPassword = $data['password'];
				$salt = $data['salt'];
				$enteredHashedPassword = Hash::make($password, $salt);

				if ($actualPassword === $enteredHashedPassword) {
					$_SESSION[$this->_sessionName] = $data['id'];
					return $this->_loggedIn = true;
				}
			}

		}else{
			return false;
		}


		$this->data = $this->_db->query('SELECT * FROM user WHERE username = ' . $username)->results();

		if ($user = $this->_db->first()) {
			// User exists
			$data = $this->_data;
			$hashedSaltedEnteredPassword = Hash::make($password, $data['salt']);
			$actualPassword = $data['password'];
			// password is correct
			if ($hashedSaltedEnteredPassword === $actualPassword) {
				return $this->_loggedIn = true;
			}
		}
		return false;
	}


	public function register($username, $password){
		$this->_db->query("SELECT * FROM user WHERE username = '$username'");

		if ($this->_db->length() === 0) {
			$salt = Hash::salt();
			$hashedPassword = Hash::make($password, $salt);
			$this->_db->query("INSERT INTO user(username, password, salt) VALUES('$username', '$hashedPassword', '$salt' )");
			return true;
		}
	}

	// MAYBE CHANGE TO BLOG CLASS????
	public function canEditPost($postID){
		// Users can only edit their own blogs
		if ($this->_data['admin']) {
			return true;
		}
		$blogDetails = $this->_db->query("SELECT * FROM post WHERE post.id = $postID AND user_fk = '" . $this->_data['id'] . "'")->results();
		return count($blogDetails) !== 0;
	}

	public function logout(){
		if ($this->_loggedIn) {
			unset($_SESSION[$this->_sessionName]);
		}
		return true;
	}


	public function loggedIn(){
		return $this->_loggedIn;
	}

	public function data(){
		return $this->_data;
	}
}

?>