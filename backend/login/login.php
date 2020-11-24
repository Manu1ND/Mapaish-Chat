<?php
include("../db.php");
session_start();

try {
	$username = $_POST['username'];
	$password = $_POST['password'];

	$sql = "SELECT `password` FROM `members` WHERE `Username` = :username";
	$stmt = $conn->prepare($sql);
	$stmt->bindParam(':username', $username);
	$stmt->execute();
	$passRow = $stmt->fetchObject();
	if($passRow) {
		$pass = $passRow->password;
		if ($pass == $password) {
			$_SESSION['username'] = $username;
			echo "success";
		} else {
			echo "Incorrect Password!";
		}
	} else {
		echo "User does not exist";
	}
} catch (PDOException $e) {
	echo $e;
}

$conn = NULL;
