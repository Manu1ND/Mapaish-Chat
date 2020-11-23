<?php
include("../../db.php");
session_start();

try {
	$username = "Manu1ND";
	
	$roomSQL = 'SELECT `chatroom`.`roomID`,
		CASE WHEN `isGroup` = "1" THEN `groupName`
		ELSE (SELECT `Name` FROM `members` INNER JOIN `chatroommembers`
			ON `members`.`Username` = `chatroommembers`.`Username`
			WHERE `chatroommembers`.`Username` != :username AND `roomID` = `chatroom`.`roomID`)
		END AS `chatName`,
		CASE WHEN `isGroup` = "1" THEN `groupPicture`
		ELSE (SELECT `imgLink` FROM `members` INNER JOIN `chatroommembers`
			ON `members`.`Username` = `chatroommembers`.`Username`
			WHERE `chatroommembers`.`Username` != :username AND `roomID` = `chatroom`.`roomID`)
		END AS `picture`,
		`isGroup`, `message`, `time`, `messages`.`Username` AS senderUsername, (SELECT Name FROM `members` WHERE `Username` = `messages`.`Username`) AS senderName
		FROM `chatroom` INNER JOIN `chatroommembers`
		ON `chatroom`.`roomID` = `chatroommembers`.`roomID`
		INNER JOIN `messages`
		ON `chatroom`.`roomID` = `messages`.`roomID`
		WHERE `chatroommembers`.`Username` = :username
		AND `messageID` IN (SELECT max(`messageID`) FROM `messages` WHERE `roomID` = `chatroom`.`roomID`)
		ORDER BY time DESC';
	$roomSTMT = $conn->prepare($roomSQL);
	$roomSTMT->bindParam(':username', $username);
	$roomSTMT->execute();
	while($row = $roomSTMT->fetchObject()) {
		$data['roomID'] = $row->roomID;
		$data['chatName'] = $row->chatName;
		$data['picture'] = $row->picture;
		$data['isGroup'] = $row->isGroup;
		$data['message'] = $row->message;
		$data['time'] = date('d/m/Y H:i', $row->time);
		$data['senderUsername'] = $row->senderUsername;
		$data['senderName'] = $row->senderName;
		$chatRooms[] = $data;
	}
	// Encoding array in JSON format
	if (!isset($chatRooms))
        echo FALSE;
    else
		echo json_encode($chatRooms);
} catch (PDOException $e) {
	echo $e;
}

$conn = NULL;
