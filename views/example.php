
<!-- add database to this page -->



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

<!DOCTYPE html>
<html>
<head>
	<title>my posts</title>
	<link rel="stylesheet" type="text/css" href="../styles/styles.css">
</head>
<body>
	<div class="main">
		<h1>my posts</h1>
		<!-- <form action="my_posts.php" method="post">
			<table>
				<tr>
					<th>title</th>
					<th>content</th>
					<th>edit</th>
					<th>delete</th>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<input type="hidden" name="id" value="ssss">
					<td><input type="submit" name="action" value="edit"></td>
					<td><input type="submit" name="action" value="delete"></td>
				</tr>
			</table>
		</form> -->
		<?php
			// $username = $_SESSION['user'];
			// $query_id = mysqli_query($db, "SELECT id FROM users WHERE username='$username'");
			// $UID_arr  = $query_id->fetch_assoc();
			// $UID      = $UID_arr['id'];
			// $posts    = mysqli_query($db, "SELECT id, title, content FROM post WHERE UID='$UID'");
			// if (!$posts) {
			// 	echo "hich posti baraye namayesh vojod nadarad.";
			// } else {
			// 	echo "
			// <table>
			// 	<tr>
			// 		<th>title</th>
			// 		<th>content</th>
			// 		<th>edit</th>
			// 		<th>delete</th>
			// 	</tr>";
			// 	while ($row = $posts->fetch_assoc()) {
			// 		$title   = $row['title'];
			// 		$id      = $row['id'];
			// 		$content = $row['content'];
			// 		echo "<tr>
			// 		<td>$title</td>
			// 		<td>$content</td>
			// 		<form action=","edit_post.php", " method=","post",">
			// 		<input type=","hidden"," name=","id" ," value=","$id",">
			// 		<td><input type=","submit"," name=","action" ," value=","edit","></td>
			// 		<td><input type=","submit" ," name=","action" ," value=","delete","></td>
			// 		</form>
			// 	</tr>";
			// 	}
			// 	echo "</table>";
			// }
		?>
	</div>
	<div>
		<hr>
		<p>
			you can add new post in this page and seved this to site.
		</p>
		<hr>
		<div class="main">
			<form action="./x.php" method="post" enctype="multipart/form-data">
				<span>choise image : </span>
				<input type="file" name="fileupload">
				<br>
				<input type="text" name="title" placeholder="title" style="width: 500px;">
				<br>
				<textarea name="content" placeholder="content" style="margin-top: 10px; width: 500px; height: 300px"></textarea>
				<br>
				<input type="submit" name="send" value="send" style="margin-top: 10px;">
			</form>
		</div>
	</div>
	<div style="background: #D5fBfB">
		<span><a href="./profile.php">back to profile</a></span>
	</div>
</body>
</html>

