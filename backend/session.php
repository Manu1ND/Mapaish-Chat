<?php
include("db.php");
session_start();

try{	
	if(isset($_SESSION['username'])) {
		$username = $_SESSION['username'];

		$sql = "SELECT * FROM `members` WHERE `Username` = :username";
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(':username', $username);
		$stmt->execute();
	}
} catch (PDOException $e) {
    exit($e);
}

$prefix = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';
$domain = $_SERVER['HTTP_HOST'].'/sem5mp';
$relative = '/login.html';
$url = $prefix.$domain.$relative;
if(!isset($_SESSION['username']) || !$stmt->rowCount()){
	header("location:".$url);
}

$conn = null;