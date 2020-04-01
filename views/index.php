
<?php
	include '../configs/config.php';
	use Firebase\JWT\JWT;
	require_once('../vendor/autoload.php');
// 	$_SESSION['alert_err'] = 'tamam field ha ra por konid.';
// 	$token = "<script>
// 	var token = localStorage.getItem('token');
// 	if (token == null) {
// 		token = 'not';
// 	}
// 	document.cookie = 'token=' + token + ';path=/';
// 	document.cookie = 'token=' + token + ';path=/';
// </script>";
// 	echo $token;
// 	// echo $_COOKIE['token'];
// 	$token = $_COOKIE['token'];
// 	echo "////string/////";
// 	echo $token;
// 	echo "////string/////";
// 	if ($token === 'not') {
// 		echo "<script>document.cookie = 'token=;path=/';</script>";
// 		echo "<script>document.cookie = 'token=;path=/';</script>";
// 	}
// 	// unset($_COOKIE['token']);
// 	// $token = $_SESSION['PHPSESSID'];
// 	// echo $_COOKIE['token'];
// 	echo "unset";
	if (isset($_COOKIE['token'])) {
		$token = $_COOKIE['token'];
		if ($token !== 'not') {
			echo $token;
			$jwt = JWT::decode($token, $emza, array('HS256'));
			if ($jwt) {
				$_SESSION['alert_msg'] = 'khos amadid.';
				header('location: ./profile.php');
				exit();
			}
		}
	}
?>

<html>
<head>
	<title>index</title>
</head>
<body>
	<a href="./register.php">register</a>
	<br>
	<a href="./login.php">login</a>
</body>
</html>

