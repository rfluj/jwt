
<?php
	// echo "string1";
	require_once '../configs/config.php';
	// echo "string2";

	function add_img_to_profile($UID, $username, $name_img) {
		global $db;
		mysqli_query($db, "INSERT INTO profile_img (UID, username, name_img) VALUES ('$UID', '$username', '$name_img')");
	}

	function del_img_as_profile($UID, $username, $name_img) {
		global $db;
		mysqli_query($db, "DELETE FROM profile_img WHERE UID='$UID' AND username='$username' AND name_img='$name_img'");
	}

	function add_img_to_album($UID, $username, $name_img) {
		global $db;
		mysqli_query($db, "INSERT INTO album_img (UID, username, name_img) VALUES ('$UID', '$username', '$name_img')");
	}

	function del_img_as_album($UID, $username, $name_img) {
		global $db;
		mysqli_query($db, "DELETE FROM album_img WHERE UID='$UID' AND username='$username' AND name_img='$name_img'");
	}

	function get_all_profile_img_names($UID, $username) {
		global $db;
		$images = mysqli_query($db, "SELECT * FROM profile_img WHERE UID='$UID' AND username='$username'");
		if (mysqli_num_rows($images) > 0) {
			$arr = array();
			while ($row = $images->fetch_assoc()) {
				array_push($arr, $row['name_img']);
			}
			return $arr;
		} else {
			return false;
		}
	}

	function get_all_album_img_names($UID, $username) {
		global $db;
		$images = mysqli_query($db, "SELECT * FROM album_img WHERE UID='$UID' AND username='$username'");
		if (mysqli_num_rows($images) > 0) {
			$arr = array();
			while ($row = $images->fetch_assoc()) {
				array_push($arr, $row['name_img']);
			}
			return $arr;
		} else {
			return false;
		}
	}

	function get_id_finall_profile() {
		global $db;
		$all_img = mysqli_query($db, "SELECT * FROM profile_img ORDER BY id DESC LIMIT 1");
		if (mysqli_num_rows($all_img) > 0) {
			$row = $all_img->fetch_assoc();
			return (intval($row['id'])+1);
		} else {
			return false;
		}
	}

	function get_id_finall_album() {
		global $db;
		$all_img = mysqli_query($db, "SELECT * FROM album_img ORDER BY id DESC LIMIT 1");
		if (mysqli_num_rows($all_img) > 0) {
			$row = $all_img->fetch_assoc();
			return (intval($row['id'])+1);
		} else {
			return false;
		}
	}

?>
