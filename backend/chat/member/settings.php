<?php
include("../../session.php");
include("../../db.php");
include("../importPicture.php");

$relative = dirname($_SERVER["SCRIPT_NAME"], 4) . '/';
$domain = $_SERVER['HTTP_HOST'] . $relative;
$prefix = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';
$serverLink = $prefix . $domain . "profilePicture/member/";
$link = $_SERVER['DOCUMENT_ROOT'] . $relative . "profilePicture/member/";

try {
	$username = $_SESSION['username'];
	$name = $_POST['name'];
	$removeProfilePicture = $_POST['removeProfilePicture'];
	
	if (!$removeProfilePicture) {
		if (isset($_FILES['profilePicture'])) {
			$imageFileName = "profilePicture";
			$imgLink = insertPicture($imageFileName, $username, $link, $serverLink);
		} else {
			$imgLink = $_POST['imgLink'];
		}
	} else {
		$imgLink = null;
	}
	$status = $_POST['status'];

	$deleteProfilePictureSQL = "SELECT `imgLink` FROM `members` WHERE `Username` = :username;";
	$deleteProfilePictureSTMT = $conn->prepare($deleteProfilePictureSQL);
	$deleteProfilePictureSTMT->bindParam(':username', $username);
	$deleteProfilePictureSTMT->execute();
	$profilePicture = $deleteProfilePictureSTMT->fetchObject()->imgLink;
	if ($profilePicture) {
		$profilePicture = str_replace($serverLink, $link, $profilePicture);
		if(file_exists($profilePicture)) {
			unlink($profilePicture);
		}
	}

	$groupSettingsSQL = "UPDATE `members` SET `Name` = :mem_Name, `imgLink` = :imgLink, `status` = :mem_Status
		WHERE `Username` = :username;";
	$groupSettingsSTMT = $conn->prepare($groupSettingsSQL);
	$groupSettingsSTMT->bindParam(':username', $username);
	$groupSettingsSTMT->bindParam(':mem_Name', $name);
	$groupSettingsSTMT->bindParam(':imgLink', $imgLink);
	$groupSettingsSTMT->bindParam(':mem_Status', $status);
	$groupSettingsSTMT->execute();
} catch (PDOException $e) {
	$conn->rollBack();
	echo $e;
}

$conn = NULL;
