
<?php 
	if (isset($_POST['send'])) {
		echo "string";
			// upload file
			$target_dir    = "../srcs/images/upload/";
			$target_file   = $target_dir . basename(($_FILES["fileupload"]["name"]));
			echo $target_file;
			$uploadOk      = 1;
			$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

			 // Check if image file is a actual image or fake image
			if ( isset( $_POST["send_profile_img"] ) ) {
			    $check = getimagesize( $_FILES["fileupload"]["tmp_name"] );
			    if ( $check !== false ) {
			        echo "File is an image - " . $check["mime"] . ".";
			        $uploadOk = 1;
			    } else {
			        echo "File is not an image.";
			        $uploadOk = 0;
			    }
			}
			 
			// Check if file already exists
			if ( file_exists( $target_file ) ) {
			    echo "Sorry, file already exists.";
			    $uploadOk = 0;
			}
			 
			// Check file size
			if ( $_FILES["fileupload"]["size"] > 500000 ) {
			    echo "Sorry, your file is too large.";
			    $uploadOk = 0;
			}
			 
			// Allow certain file formats
			if ( $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			     && $imageFileType != "gif" ) {
			    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			    $uploadOk = 0;
			}
			 
			// Check if $uploadOk is set to 0 by an error
				if ( $uploadOk == 0 ) {
				echo "Sorry, your file was not uploaded.";
			     
			// if everything is ok, try to upload file
			} else {
				if ( move_uploaded_file( $_FILES["fileupload"]["tmp_name"], $target_file ) ) {
					echo "The file " . basename( $_FILES["fileupload"]["name"] ) . " has been uploaded.";
				} else {
					echo "Sorry, there was an error uploading your file.";
				}
			}


			$user            = $_SESSION['user'];
			$uid             = mysqli_query($db, "SELECT id FROM users WHERE username='$user'");
			$query_first_row = mysqli_fetch_assoc($uid);
			$UID             = $query_first_row['id'];
			$title           = $_POST['title'];
			$content         = $_POST['content'];
			mysqli_query($db, "INSERT INTO post (title, content, UID) VALUES ('$title', '$content', '$UID')");
			echo "post ba movafagiat ersal shod.";
		}
	
?>

