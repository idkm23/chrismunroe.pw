<?php
	session_start();

	if(isset($_POST['submit']) && $_POST['submit'] == 'send') {
		include('inc/connectDB.php');
		
		$sql = sprintf("UPDATE account SET about = '%s' WHERE username = '%s'",
            $conn->real_escape_string($_POST['aboutIn']),
			$conn->real_escape_string($_SESSION['login']));
		
		$conn->query($sql);
		header('Location: profile?n='.$_SESSION['login']);
	}
	if(isset($_POST['submit']) && $_POST['submit'] == 'Upload Image') {
		$hold = pathinfo($_FILES["fileToUpload"]["name"]);
		$imageFileType = $hold["extension"];
		$target_file = "res/profile/".$_SESSION['login'].".".$imageFileType;
		$uploadOk = 1;
		
		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
			$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			if($check !== false) {
				$uploadOk = 1;
			} else {
				echo "File is not an image.";
				$uploadOk = 0;
			}
		}
		// Check file size
		if ($_FILES["fileToUpload"]["size"] > 500000) {
			echo "Sorry, your file is too large.";
			$uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
			echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			$uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
			$oldfile = glob("res/profile/{$_SESSION['login']}.{jpg,jpeg,png,gif}", GLOB_BRACE);
			if(isset($oldfile[0]))
				unlink($oldfile[0]);
			if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
				header('Location: profile?n='.$_SESSION['login']);
				exit;
			} else {
				echo "Sorry, there was an error uploading your file.";
			}
		}
	}
?>