<?php
include("../../session.php");
include("../../db.php");

try {
	$username = $_SESSION['username'];
	$roomID = $_POST["roomID"];
	$message = $_POST["message"];

	$insertSQL = "INSERT INTO `messages` (`roomID`, `Username`, `message`, `time`) VALUES (:roomID, :username, :message, UNIX_TIMESTAMP())";
	$insertSTMT = $conn->prepare($insertSQL);
	$insertSTMT->bindParam(':roomID', $roomID);
	$insertSTMT->bindParam(':username', $username);
	$insertSTMT->bindParam(':message', $message);
	$insertSTMT->execute();
	
} catch (PDOException $e) {
	echo $e;
}

$conn = NULL;
