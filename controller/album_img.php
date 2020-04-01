
<?php
	require_once '../configs/config.php';
	require_once '../models/filesystem.php';
	require_once '../models/img_func.php';
	require_once '../models/jwt_edit.php';
	

	if (isset($_POST['back'])) {
		if (isset($_SESSION['album_img'])) {
			unset($_SESSION['album_img']);
		}
		header('location: ../views/profile.php');
		exit();
	} elseif (isset($_POST['send_album_img'])) {
		$jwt      = jwt_exist();
		$id       = get_id($jwt, $emza);
		$username = get_username($jwt, $emza);
		$path     = name_img_album($username);
		$file     = $_FILES["fileupload"];
		if (upload_img($path, $file)) {
			$path = $path . '.' . strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
			unset($_SESSION['album_img']);
			add_img_to_album($id, $username, $path);
		}
		header('location: ../views/profile.php');
		exit();
	} else {
		$_SESSION['album_img'] = true;
		$_SESSION['album_img'] = true;
		header('location: ../views/profile.php');
		exit();
	}
?>
