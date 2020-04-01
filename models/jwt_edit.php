
<?php
	use Firebase\JWT\JWT;
	require_once('../vendor/autoload.php');
	require_once '../configs/config.php';


	function jwt_exist(){
		if (isset($_COOKIE['token'])) {
			$jwt = $_COOKIE['token'];
			if ($jwt !== 'not') {
				return $jwt;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	function arr_profile_img($jwt, $emza) {
		global $alg;
		$data  = JWT::decode($jwt, $emza, $alg);
		if ($data) {
			$data  = array($data);
			if (isset($data['profile_img'])) {
				return $data['profile_img'];
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	function arr_album_img($jwt, $emza) {
		global $alg;
		$data  = JWT::decode($jwt, $emza, $alg);
		if ($data) {
			$data  = array($data);
			if (isset($data['album_img'])) {
				return $data['album_img'];
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	function get_id($jwt, $emza) {
		global $alg;
		$data  = JWT::decode($jwt, $emza, $alg);
		if ($data) {
			// $data  = array($data);
			if (isset($data->{'id'})) {
				return $data->{'id'};
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	function get_username($jwt, $emza) {
		global $alg;
		$data  = JWT::decode($jwt, $emza, $alg);
		if ($data) {
			// $data  = array($data);
			// echo $data->{'username'};
			if (isset($data->{'username'})) {
				return $data->{'username'};
			} else {
				return false;
			}
		} else {
			return false;
		}
	}


?>


