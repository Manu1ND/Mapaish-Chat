<?php
include("db.php");
session_start();

try{
	// set the PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
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
$relative = '/login/login.php';
$url = $prefix.$domain.$relative;
if(!isset($_SESSION['username']) || !$stmt->rowCount()){
	header("location:".$url);
}

$conn = null;