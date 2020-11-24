<?php
include("../../session.php");
include("../../db.php");

try {
	$username = $_SESSION['username'];
	$roomID = $_POST['roomID'];
	$members = json_decode($_POST['members'], true);

	if($_POST['request'] == "add") {		
		$modifyGroupSQL = "INSERT INTO `chatroommembers` (`roomID`, `Username`) VALUES (:roomID, :username)";
	} else if($_POST['request'] == "remove"){
		$modifyGroupSQL = "DELETE FROM `chatroommembers` WHERE `roomID` = :roomID AND `Username` = :username";
	}

	$conn->beginTransaction();
		$modifyGroupSTMT = $conn->prepare($modifyGroupSQL);
		$modifyGroupSTMT->bindParam(':roomID', $roomID);
		foreach($members as $member){
			$modifyGroupSTMT->bindParam(':username', $member);
			$modifyGroupSTMT->execute();
		}
		$conn->commit();
	
} catch (PDOException $e) {
	$conn->rollBack();
	echo $e;
}

$conn = NULL;
