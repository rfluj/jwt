
<?php
	// echo "10";
	require_once 'img_func.php';
	// echo "11";

	function upload_img($path, $file) {
		$_FILES["fileupload"] = $file;
		$target_path = '../srcs/images/upload/' . $path;
		// echo $target_path;

		// upload file
		$target_dir    = "uploads/";
		$imageFileType = strtolower(pathinfo($_FILES["fileupload"]["name"], PATHINFO_EXTENSION));
		$target_file   = $target_path . '.' . $imageFileType;
		// echo $target_file;
		// $target_file   = $target_path;
		// echo $target_file;
		$uploadOk      = 1;

		 // Check if image file is a actual image or fake image
		if ( isset( $_POST["send"] ) ) {
		    $check = getimagesize( $_FILES["fileupload"]["tmp_name"] );
		    if ( $check !== false ) {
		        // echo "File is an image - " . $check["mime"] . ".";
		        $uploadOk = 1;
		    } else {
		    	$uploadOk = 0;
		        $_SESSION['alert_err'] = "File is not an image.";
		        return false;
		    }
		}
		 
		// Check if file already exists
		if ( file_exists( $target_file ) ) {
		    // echo "Sorry, file already exists.";
		    $uploadOk = 0;
		    $_SESSION['alert_err'] = "Sorry, file already exists.";
			return false;
		}
		 
		// Check file size
		if ( $_FILES["fileupload"]["size"] > 500000 ) {
		    // echo "Sorry, your file is too large.";
		    $uploadOk = 0;
		    $_SESSION['alert_err'] = "Sorry, your file is too large.";
			return false;
		}
		 
		// Allow certain file formats
		if ( $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		     && $imageFileType != "gif" ) {
		    // echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		    $uploadOk = 0;
		    $_SESSION['alert_err'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			return false;
		}
		 
		// Check if $uploadOk is set to 0 by an error
		if ( $uploadOk == 0 ) {
			// echo "Sorry, your file was not uploaded.";
			return false;
		     
		// if everything is ok, try to upload file
		} else {
			if ( move_uploaded_file( $_FILES["fileupload"]["tmp_name"], $target_file ) ) {
				$_SESSION['alert_msg'] = "The file has been uploaded.";
				return true;
				// echo "The file " . basename( $_FILES["fileupload"]["name"] ) . " has been uploaded.";
			} else {
				$_SESSION['alert_err'] = "Sorry, there was an error uploading your file.";
				return false;
				// echo "Sorry, there was an error uploading your file.";
			}
		}
	}

	function name_img_profile($username) {
		// $_FILES["fileupload"] = $file;
		$id                   = get_id_finall_profile();
		if ($id) {
			$path = 'profiles/' . $username . '_' . $id;
		} else {
			$path = 'profiles/' . $username . '_0';
		}
		return $path;
	}

	function name_img_album($username) {
		// $_FILES["fileupload"] = $file;
		$id                   = get_id_finall_album();
		if ($id) {
			$path = 'albums/' . $username . '_' . $id;
		} else {
			$path = 'albums/' . $username . '_0';
		}
		return $path;
	}

?>





