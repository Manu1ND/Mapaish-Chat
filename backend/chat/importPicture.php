<?php

function insertPicture($imageFileName, $ID, $target_dir, $serverLink)
{
	if ($_FILES[$imageFileName]["error"] == 0) {
		/* Location */
		$target_file = $target_dir . basename($_FILES[$imageFileName]["name"]);
		$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

		// Check if image file is a actual image or fake image
		$check = getimagesize($_FILES[$imageFileName]["tmp_name"]);
		if ($check == false) {
			throw new Exception("File is not an image.");
		}

		/* Valid Extensions */
		$valid_extensions = array("jpg", "jpeg", "png");
		/* Check file extension */
		if (!in_array(strtolower($imageFileType), $valid_extensions)) {
			throw new Exception("Wrong file format.");
		}

		$temp = explode(".", $_FILES[$imageFileName]["name"]);
		$imageName = $ID . '-' . time() . '.' . end($temp);
		$imageDest = $target_dir . $imageName;
		if (move_uploaded_file($_FILES[$imageFileName]["tmp_name"], $imageDest)) {
			$imgLink = $serverLink . $imageName;
			return $imgLink;
		} else {
			throw new Exception("Sorry, there was an error uploading your file.");
		}
	}
}
