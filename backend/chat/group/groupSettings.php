<?php
include("../../session.php");
include("../../db.php");
include("../importPicture.php");

$relative = dirname($_SERVER["SCRIPT_NAME"], 4) . '/';
$domain = $_SERVER['HTTP_HOST'] . $relative;
$prefix = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';
$serverLink = $prefix . $domain . "profilePicture/group/";
$link = $_SERVER['DOCUMENT_ROOT'] . $relative . "profilePicture/group/";

try {
	$roomID = $_POST['roomID'];
	$groupName = $_POST['groupName'];
	$removeGroupPicture = $_POST['removeGroupPicture'];
	if (!$removeGroupPicture) {
		if (isset($_FILES['groupPicture'])) {
			$imageFileName = "groupPicture";
			$imgLink = insertPicture($imageFileName, $roomID, $link, $serverLink);
		} else {
			$imgLink = $_POST['imgLink'];
		}
	} else {
		$imgLink = null;
	}

	$deleteGroupPictureSQL = "SELECT `groupPicture` FROM `chatroom` WHERE `roomID` = :roomID;";
	$deleteGroupPictureSTMT = $conn->prepare($deleteGroupPictureSQL);
	$deleteGroupPictureSTMT->bindParam(':roomID', $roomID);
	$deleteGroupPictureSTMT->execute();
	$groupPicture = $deleteGroupPictureSTMT->fetchObject()->groupPicture;
	if ($groupPicture) {
		$groupPicture = str_replace($serverLink, $link, $groupPicture);
		if(file_exists($groupPicture)) {
			unlink($groupPicture);
		}
	}

	$groupSettingsSQL = "UPDATE `chatroom` SET `groupName` = :groupName, `groupPicture` = :imgLink WHERE `roomID` = :roomID;";
	$groupSettingsSTMT = $conn->prepare($groupSettingsSQL);
	$groupSettingsSTMT->bindParam(':groupName', $groupName);
	$groupSettingsSTMT->bindParam(':imgLink', $imgLink);
	$groupSettingsSTMT->bindParam(':roomID', $roomID);
	$groupSettingsSTMT->execute();
} catch (PDOException $e) {
	$conn->rollBack();
	echo $e;
}

$conn = NULL;
