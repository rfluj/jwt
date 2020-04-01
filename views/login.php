
<?php
	include '../configs/config.php';
	use Firebase\JWT\JWT;
	require_once('../vendor/autoload.php');
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
	<title>login</title>
</head>
<body>
	<form action="../controller/login.php" method="post">
		<?php
			if (isset($_SESSION['alert_err'])) {
				$err = $_SESSION['alert_err'];
				echo "<span>'$err'</span>
				<br>";
				unset($_SESSION['alert_err']);
			}
			if (isset($_SESSION['alert_msg'])) {
			 	$msg = $_SESSION['alert_msg'];
				echo "<span>'$msg'</span>
				<br>";
				unset($_SESSION['alert_msg']);
			}
		?>
		<span>register</span>
		<br>
		<input type="text" name="username" placeholder="username">
		<br>
		<input type="password" name="password" placeholder="password">
		<br>
		<input type="submit" name="login" value="login">
	</form>
</body>
</html>





