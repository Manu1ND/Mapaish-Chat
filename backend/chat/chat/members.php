<?php
include("../../db.php");
session_start();

try {
	$username = "Manu1ND";

	// load members for new chatroom
	if($_POST['type'] == "newChat"){
		if($_POST['request'] == "single") {
			$membersSQL = 'SELECT `Name`, `Username` FROM `members`
				WHERE `Username` NOT IN (SELECT `Username` FROM `chatroommembers`
					WHERE `roomID` IN (SELECT `chatroommembers`.`roomID` FROM `chatroommembers`
						INNER JOIN `chatroom`
						ON `chatroommembers`.`roomID` = `chatroom`.`roomID`
						WHERE `Username` = :username AND `isGroup` = "0"))
					AND `Username` != :username';
		} elseif($_POST['request'] == "group"){
			$membersSQL = "SELECT `Name`, `Username` FROM `members` WHERE `Username` != :username";
		}
		$membersSTMT = $conn->prepare($membersSQL);
		$membersSTMT->bindParam(':username', $username);
	} elseif ($_POST['type'] == "modifyGroup") {
		$roomID = $_POST['roomID'];
		if($_POST['request'] == "add") {
			$membersSQL = 'SELECT `Name`, `Username` FROM `members`
				WHERE `Username` NOT IN (
					SELECT `Username` FROM `chatroommembers` WHERE `roomID` = :roomID)';
		} elseif($_POST['request'] == "remove"){
			$membersSQL = "SELECT `Name`, `members`.`Username`
				FROM `members` INNER JOIN `chatroommembers`
				ON `members`.`Username` = `chatroommembers`.`Username`
				WHERE `roomID` = :roomID";
		}
		$membersSTMT = $conn->prepare($membersSQL);
		$membersSTMT->bindParam(':roomID', $roomID);
	}
	
	$membersSTMT->execute();
	while($row = $membersSTMT->fetchObject()) {
		$data['Name'] = $row->Name;
		$data['Username'] = $row->Username;
		$members[] = $data;
	}
	// Encoding array in JSON format
	if (!isset($members))
        echo FALSE;
    else
		echo json_encode($members);
} catch (PDOException $e) {
	echo $e;
}

$conn = NULL;