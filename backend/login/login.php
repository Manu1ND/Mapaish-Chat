<?php
include("../db.php");
session_start();

try {
	// set the PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$username = $_POST['username'];
	$password = $_POST['mem_Password'];

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
	exit($e);
}

$conn = NULL;
