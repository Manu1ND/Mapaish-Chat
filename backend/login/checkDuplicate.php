<?php
include("../db.php");

$username = $_POST['username'];
$email = $_POST['email'];

try {
	// set the PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	// check duplicate username
	$checkUsernameSQL = "SELECT * FROM `members` WHERE `Username` = :username";
	$checkUsernameSTMT = $conn->prepare($checkUsernameSQL);
	$checkUsernameSTMT->bindParam(':username', $username);
	$checkUsernameSTMT->execute();
	$count = $checkUsernameSTMT->rowCount();
	if ($count) {
		echo "username";
	}

	// check duplicate username
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
