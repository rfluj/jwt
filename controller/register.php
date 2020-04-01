
<?php require_once '../models/users.php' ?>

<?php
	use Firebase\JWT\JWT;
	require_once('../vendor/autoload.php');

	$username = $_POST['username'];
	$password = $_POST['password'];
	if (empty($username) or empty($password)) {
		$_SESSION['alert_err'] = 'tamam field ha ra por konid.';
		header('location: ../views/register.php');
		exit();
	} elseif (check_user($username)) {
		$_SESSION['alert_err'] = 'in username gablan gerefte shode ast.';
		header('location: ../views/register.php');
		exit();
	} else {
		$id = register($username, $password);
		

		$data = array(
			'id'=>$id,
			'username'=>$username
		);

		$jwt = JWT::encode($data, $emza);
		// echo $jwt;
		// echo "<script>localStorage.removeItem('token');</script>";
		// echo "<script>localStorage.setItem('token','$jwt');</script>";
		setcookie('token', $jwt, time()+(86400*30*12), '/');
		$_COOKIE['token'] = $jwt;
		$_SESSION['alert_msg'] = 'sabt nam ba movafagiat anjam shod.';
		header('location: ../views/profile.php');
		exit();
	}
?>




