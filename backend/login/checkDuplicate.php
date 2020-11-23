<?php
include("../db.php");

$username = $_POST['username'];
$email = $_POST['email'];

try {
	// check duplicate username
	$checkUsernameSQL = "SELECT * FROM `members` WHERE `Username` = :username";
	$checkUsernameSTMT = $conn->prepare($checkUsernameSQL);
	$checkUsernameSTMT->bindParam(':username', $username);
	$checkUsernameSTMT->execute();
	$count = $checkUsernameSTMT->rowCount();
	if ($count) {
		echo "username";
	}

	// check duplicate email
	$checkEmailSQL = "SELECT * FROM `members` WHERE `Email` = :email";
	$checkEmailSTMT = $conn->prepare($checkEmailSQL);
	$checkEmailSTMT->bindParam(':email', $email);
	$checkEmailSTMT->execute();
	$count = $checkEmailSTMT->rowCount();
	if ($count) {
		echo "email";
	}
} catch (PDOException $error) {
	echo "error";
}

$conn = NULL;
