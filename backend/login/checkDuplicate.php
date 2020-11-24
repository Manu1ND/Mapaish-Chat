<?php
include("../db.php");

try {
	// check duplicate username
	if (isset($_POST['username'])) {
		$username = $_POST['username'];
		$checkUsernameSQL = "SELECT * FROM `members` WHERE `Username` = :username";
		$checkUsernameSTMT = $conn->prepare($checkUsernameSQL);
		$checkUsernameSTMT->bindParam(':username', $username);
		$checkUsernameSTMT->execute();
		$count = $checkUsernameSTMT->rowCount();
		if ($count) {
			echo 1;
		}
	}

	// check duplicate email
	if (isset($_POST['email'])) {
		$email = $_POST['email'];
		$checkEmailSQL = "SELECT * FROM `members` WHERE `Email` = :email";
		$checkEmailSTMT = $conn->prepare($checkEmailSQL);
		$checkEmailSTMT->bindParam(':email', $email);
		$checkEmailSTMT->execute();
		$count = $checkEmailSTMT->rowCount();
		if ($count) {
			echo 1;
		}
	}
} catch (PDOException $error) {
	echo "error";
}

$conn = NULL;
