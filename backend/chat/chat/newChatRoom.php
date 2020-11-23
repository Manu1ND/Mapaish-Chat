<?php
include("../../db.php");

try {
	$username = "Manu1ND";
	if($_POST['group']) {
		$isGroup = 1;
		$groupName = $_POST['groupName'];
		$members = json_decode($_POST['members'], true);
	} else {
		$isGroup = 0;
		$groupName = null;
		$members = Array($_POST['members']);
	}
	$conn->beginTransaction();
		$newChatRoomSQL = "INSERT INTO `chatroom` (`isGroup`, `groupName`) VALUES (:isGroup, :groupName)";
		$newChatRoomSTMT = $conn->prepare($newChatRoomSQL);
		$newChatRoomSTMT->bindParam(':isGroup', $isGroup);
		$newChatRoomSTMT->bindParam(':groupName', $groupName);
		$newChatRoomSTMT->execute();
		$roomID = $conn->lastInsertId();

		$addMembersSQL = "INSERT INTO `chatroommembers` (`roomID`, `Username`) VALUES (:roomID, :username)";
		$addMembersSTMT = $conn->prepare($addMembersSQL);
		$addMembersSTMT->bindParam(':roomID', $roomID);
		$addMembersSTMT->bindParam(':username', $username);
		$addMembersSTMT->execute();
		foreach($members as $member){
			$addMembersSTMT->bindParam(':username', $member);
			$addMembersSTMT->execute();
		}
		$conn->commit();

	$message = "Chatroom Created";
	$insertSQL = "INSERT INTO `messages` (`roomID`, `Username`, `message`, `time`) VALUES (:roomID, :username, :message, UNIX_TIMESTAMP())";
	$insertSTMT = $conn->prepare($insertSQL);
	$insertSTMT->bindParam(':roomID', $roomID);
	$insertSTMT->bindParam(':username', $username);
	$insertSTMT->bindParam(':message', $message);
	$insertSTMT->execute();

	/* $newChatRoomSTMT = $conn->prepare($newChatRoomSQL);
	$newChatRoomSTMT->execute(); */
	
} catch (PDOException $e) {
	$conn->rollBack();
	echo $e;
}

$conn = NULL;
