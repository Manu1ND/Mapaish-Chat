<?php
include("../../db.php");

try {
	$username = "Manu1ND";

	$memberInfoSQL = "SELECT `Name`, `imgLink`, `status` FROM `members` WHERE `Username` = :username;";
	$memberInfoSTMT = $conn->prepare($memberInfoSQL);
	$memberInfoSTMT->bindParam(':username', $username);
	$memberInfoSTMT->execute();
	$row = $memberInfoSTMT->fetchObject();

	$data['name'] = $row->Name;
	$data['profilePicture'] = $row->imgLink;
	$data['status'] = $row->status;

	// Encoding array in JSON format
	if (!isset($data))
		echo FALSE;
	else
		echo json_encode($data);
} catch (PDOException $e) {
	$conn->rollBack();
	echo $e;
}

$conn = NULL;
