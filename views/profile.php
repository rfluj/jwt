
<?php
	include '../configs/config.php';
	use Firebase\JWT\JWT;
	require_once('../vendor/autoload.php');
	require_once '../models/img_func.php';

	if (isset($_COOKIE['token'])) {
		$token = $_COOKIE['token'];
		if ($token !== 'not') {
			// echo $token;
			$jwt = JWT::decode($token, $emza, array('HS256'));
			if (!$jwt) {
				$_SESSION['alert_err'] = 'baraye vorod be safhe profile aval bayad login konid.';
				header('location: ./login.php');
				exit();
			}
			$jwt      = (array) $jwt;
			$id       = $jwt['id'];
			$username = $jwt['username'];
			// echo $id;
			// echo $username;
		} else {
			$_SESSION['alert_err'] = 'baraye vorod be safhe profile aval bayad login konid.';
			header('location: ./login.php');
			exit();
		}
	} else {
		$_SESSION['alert_err'] = 'baraye vorod be safhe profile aval bayad login konid.';
		header('location: ./login.php');
		exit();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>profile</title>
	<link rel="stylesheet" href="../styles/slider_style.css">
</head>
<body>
	<?php
		if (isset($_SESSION['alert_err'])) {
			$err = $_SESSION['alert_err'];
			echo "<span>$err</span>
			<br>";
			unset($_SESSION['alert_err']);
		}
		if (isset($_SESSION['alert_msg'])) {
		 	$msg = $_SESSION['alert_msg'];
			echo "<span>$msg</span>
			<br>";
			unset($_SESSION['alert_msg']);
		}
		echo "<h1>wellcome $username</h1>
		<br>";
	?>
	<span>dasbord</span>
	<br>
	<a href="../controller/profile_img.php">profiles image</a>
	<br>
	<a href="../controller/album_img.php">my album</a>
	<br>
	<a href="../controller/exit.php">exit</a>
	<br>
	<?php
		$arr_name_img = array();
		if (isset($_SESSION['profile_img'])) {
			$arr = get_all_profile_img_names($id, $username);
			if ($arr) {
				for ($i=0; $i < count($arr); $i++) { 
					array_push($arr_name_img, '../srcs/images/upload/' . $arr[$i]);
				}
				$src = $arr_name_img[0];
				// echo $src;
				echo "<span>your profile images</span>
				<br>
				<div id=","slider",">
					<img src=","$src"," class=","image",">
					<div class=","buttons",">
						<ul></ul>
					</div>
				</div>";
			} else {
				echo "<span>your profile images</span>
				<br>
				<span>hich image profili nadarid</span>
				<br>";
			}


			echo "<form action=","../controller/profile_img.php"," method=","post","  enctype=","multipart/form-data",">
		<span>add new image profile >>> </span>
		<input type=","file"," name=","fileupload",">
		<input type=","submit"," name=","send_profile_img"," value=","send",">
	</form>
	<form action=","../controller/profile_img.php"," method=","post",">
		<input type=","submit"," name=","back"," value=","Back",">
	</form>";
		} elseif (isset($_SESSION['album_img'])) {
			$arr = get_all_album_img_names($id, $username);
			if ($arr) {
				for ($i=0; $i < count($arr); $i++) { 
					array_push($arr_name_img, '../srcs/images/upload/' . $arr[$i]);
				}
				$src = $arr_name_img[0];
				echo "<span>your album images</span>
				<br>
				<div id=","slider",">
					<img src=","$src"," class=","image",">
					<div class=","buttons",">
						<ul></ul>
					</div>
				</div>";
			} else {
				echo "<span>your album images</span>
				<br>
				<span>hich image profili nadarid</span>
				<br>";
			}
				
			echo "<form action=","../controller/album_img.php"," method=","post","  enctype=","multipart/form-data",">
		<span>add new image album >>> </span>
		<input type=","file"," name=","fileupload",">
		<input type=","submit"," name=","send_album_img"," value=","send",">
	</form>
	<form action=","../controller/album_img.php"," method=","post",">
		<input type=","submit"," name=","back"," value=","Back",">
	</form>";
		}
	?>


	<script type="text/javascript" src="../scripts/jquery.min.js"></script>
	<script type="text/javascript">
		// alert('hhhhhhhhhh');
		$('document').ready(function()  {
			var array   = <?php echo json_encode($arr_name_img); ?>;
			// alert('array');
			var len_arr = array.length;
			if (len_arr > 0) {
				let numberOfImages = len_arr;
				for (let i = 0;i < numberOfImages;i++) {
					if (i == 0) {
						var str = "<li class="+"active"+" data-img=" + i + "></li>";
					} else {
						var str = "<li data-img=" + i + "></li>";
					}
					$("#slider .buttons ul").append(str);
				}
				// alert(len_arr);
				$("#slider .buttons ul li").click(function() {
					let id = $(this).attr('data-img');
					$("#slider .image").attr('src', array[id]);
					$("#slider .active").removeClass('active');
					$(this).addClass('active');
				});
			}
		});
	</script>
</body>
</html>

