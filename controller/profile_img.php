
<?php
	require_once '../configs/config.php';
	// echo "1";
	require_once '../models/filesystem.php';
	// echo "2";
	require_once '../models/img_func.php';
	// echo "3";
	require_once '../models/jwt_edit.php';
	

	if (isset($_POST['back'])) {
		if (isset($_SESSION['profile_img'])) {
			unset($_SESSION['profile_img']);
		}
		header('location: ../views/profile.php');
		exit();
	} elseif (isset($_POST['send_profile_img'])) {
		$jwt      = jwt_exist();
		$id       = get_id($jwt, $emza);
		$username = get_username($jwt, $emza);
		$path     = name_img_profile($username);
		echo '    path >>> ' . $path . '   ';
		echo '    path >>> ' . $username . '    ';
		$file     = $_FILES["fileupload"];
		if (upload_img($path, $file)) {
			$path = $path . '.' . strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
			unset($_SESSION['profile_img']);
			add_img_to_profile($id, $username, $path);
		}
		header('location: ../views/profile.php');
		exit();
	} else {
		$_SESSION['profile_img'] = true;
		$_SESSION['profile_img'] = true;
		header('location: ../views/profile.php');
		exit();
	}
?>





