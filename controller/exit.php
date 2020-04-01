
<?php
	if (isset($_COOKIE['token'])) {
		setcookie('token', null, time()-(86400*30*12), '/');
		header('location: ../views/index.php');
		exit();
	} else {
		header('location: ../views/profile.php');
		exit();
	}

?>

