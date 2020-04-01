
<?php
	require_once '../configs/config.php';
	function register($username, $password) {
		global $db, $key;
		$user = mysqli_query($db, "SELECT * FROM users WHERE username='$username'");
		if (mysqli_num_rows($user) == 0) {
			$password = encrypt($password, $key);
			mysqli_query($db, "INSERT INTO users (username, password) VALUES ('$username', '$password')");
			$user = mysqli_query($db, "SELECT id FROM users ORDER BY id DESC LIMIT 1");
			$row  = $user->fetch_assoc();
			$id   = $row['id'];
			return $id;
		} else {
			return false;
		}
	}

	function login($username, $password) {
		global $db, $key;
		$password = encrypt($password, $key);
		$user     = mysqli_query($db, "SELECT * FROM users WHERE username='$username' AND password='$password'");
		if (mysqli_num_rows($user) > 0) {
			$row  = $user->fetch_assoc();
			$id   = $row['id'];
			return $id;
		} else {
			return false;
		}
	}

	function check_user($username) {
		global $db;
		$user     = mysqli_query($db, "SELECT * FROM users WHERE username='$username'");
		if (mysqli_num_rows($user) > 0) {
			return true;
		} else {
			return false;
		}
	}

?>
