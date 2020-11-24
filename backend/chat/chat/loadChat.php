<?php
include("../../session.php");
include("../../db.php");

try {
	$username = $_SESSION['username'];
	$roomID = $_POST["roomID"];
	$lastID = $_POST["lastID"];

	$chatSQL = "SELECT MAX(messageID) AS messageID FROM `messages` WHERE `roomID` = :roomID";
	$chatSTMT = $conn->prepare($chatSQL);
	$chatSTMT->bindParam(':roomID', $roomID);
	$chatSTMT->execute();
	$messageID = $chatSTMT->fetchObject()->messageID;

	if ($lastID != $messageID) {
		$newMsgSQL = "SELECT `messages`.*, `Name`, `isGroup` FROM `messages`
		INNER JOIN `members` ON `messages`.`Username` = `members`.`Username`
		INNER JOIN `chatroom` ON `messages`.`roomID` = `chatroom`.`roomID`
		WHERE `messages`.`roomID` = :roomID AND `messageID` > :id ORDER BY `messages`.`messageID` ASC";
		$newMsgSTMT = $conn->prepare($newMsgSQL);
		$newMsgSTMT->bindParam(':roomID', $roomID);
		$newMsgSTMT->bindParam(':id', $lastID);
		$newMsgSTMT->execute();
		while ($row = $newMsgSTMT->fetchObject()) {
			$message["messageID"] = $row->messageID;
			$message["message"] = $row->message;
			$message["time"] = date('H:i', $row->time);
			$message["isGroup"] = $row->isGroup;
			if($row->Username == $username) {
				$message["name"] = null;
			} else {
				$message["name"] = $row->Name;
			}
			$chat[] = $message;
		}
	}

	$isGroupSQL = 'SELECT `isGroup` FROM `chatroom` WHERE `roomID` = :roomID';
	$isGroupSTMT = $conn->prepare($isGroupSQL);
	$isGroupSTMT->bindParam(':roomID', $roomID);
	$isGroupSTMT->execute();
	$isGroup = $isGroupSTMT->fetchObject()->isGroup;
	if($isGroup){
		$roomSQL = 'SELECT `groupName`, `groupPicture` FROM `chatroom` WHERE `roomID` = :roomID';
		$roomSTMT = $conn->prepare($roomSQL);
		$roomSTMT->bindParam(':roomID', $roomID);
		$roomSTMT->execute();
		$row = $roomSTMT->fetchObject();
		$chatRoomInfo["chatName"] = $row->groupName;
		$chatRoomInfo["picture"] = $row->groupPicture;
		$chatRoomInfo["status"] = "";
		
		$groupInfoSQL = 'SELECT `Name`
			FROM `members` INNER JOIN `chatroommembers`
			ON `members`.`Username` = `chatroommembers`.`Username`
			WHERE `roomID` = :roomID AND `chatroommembers`.`Username` != :username';
		$groupInfoSTMT = $conn->prepare($groupInfoSQL);
		$groupInfoSTMT->bindParam(':roomID', $roomID);
		$groupInfoSTMT->bindParam(':username', $username);
		$groupInfoSTMT->execute();
		while($row = $groupInfoSTMT->fetchObject()) {
			$chatRoomInfo["status"] .= $row->Name . ", ";
		}
		$chatRoomInfo["status"] .= "You";
	} else {
		$roomSQL = 'SELECT `Name`, `imgLink`, `status`
			FROM `members` INNER JOIN `chatroommembers`
			ON `members`.`Username` = `chatroommembers`.`Username`
			WHERE `roomID` = :roomID AND `chatroommembers`.`Username` != :username';
		$roomSTMT = $conn->prepare($roomSQL);
		$roomSTMT->bindParam(':roomID', $roomID);
		$roomSTMT->bindParam(':username', $username);
		$roomSTMT->execute();
		$row = $roomSTMT->fetchObject();
		$chatRoomInfo["chatName"] = $row->Name;
		$chatRoomInfo["picture"] = $row->imgLink;
		$chatRoomInfo["status"] = $row->status;
	}
	if (!isset($chat))
		$chat = null;
	$chatRoom['message'] = $chat;
	$chatRoom['roomInfo'] = $chatRoomInfo;

	// Encoding array in JSON format
	if (!isset($chatRoom))
		echo FALSE;
	else
		echo json_encode($chatRoom);
} catch (PDOException $e) {
	echo $e;
}

$conn = NULL;
