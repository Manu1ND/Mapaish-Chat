<?php
include("../../session.php");
include("../../db.php");

try {
	$roomID = $_POST['roomID'];

	$groupSettingsSQL = "SELECT `groupName`, `groupPicture` FROM `chatroom` WHERE `roomID` = :roomID;";
	$groupSettingsSTMT = $conn->prepare($groupSettingsSQL);
	$groupSettingsSTMT->bindParam(':roomID', $roomID);
	$groupSettingsSTMT->execute();
	$row = $groupSettingsSTMT->fetchObject();

	$data['groupName'] = $row->groupName;
	$data['groupPicture'] = $row->groupPicture;

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
