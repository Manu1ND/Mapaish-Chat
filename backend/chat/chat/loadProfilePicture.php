<?php
include("../../session.php");
include("../../db.php");

try {
	$username = $_SESSION['username'];
	
	$roomSQL = 'SELECT `imgLink` FROM `members` WHERE `Username` = :username';
	$roomSTMT = $conn->prepare($roomSQL);
	$roomSTMT->bindParam(':username', $username);
	$roomSTMT->execute();
	$imgLink = $roomSTMT->fetchObject()->imgLink;
	// Encoding array in JSON format
	if (!isset($imgLink))
        echo FALSE;
    else
		echo $imgLink;
} catch (PDOException $e) {
	echo $e;
}

$conn = NULL;
