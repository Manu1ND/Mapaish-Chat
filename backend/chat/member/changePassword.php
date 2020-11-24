<?php
include("../../session.php");
include("../../db.php");

try {
	$username = $_SESSION['username'];
	$password = $_POST["password"];

	$changePasswordSQL = "UPDATE `members` SET `Password` = :newPassword WHERE `Username` = :username";
	$changePasswordSTMT = $conn->prepare($changePasswordSQL);
	$changePasswordSTMT->bindParam(':newPassword', $password);
	$changePasswordSTMT->bindParam(':username', $username);
	$changePasswordSTMT->execute();
	
} catch (PDOException $e) {
	echo $e;
}

$conn = NULL;
