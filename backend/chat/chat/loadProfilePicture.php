<?php
include("../../db.php");
session_start();

try {
	$username = "Manu1ND";
	
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
