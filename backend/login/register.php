<?php
include("../db.php");

$mem_Name = $_POST['mem_Name'];
$username = $_POST['username'];
$mem_Password = $_POST['mem_Password'];
$email = $_POST['email'];

try {
	$registerSQL = "INSERT INTO `members` (`Name`, `Username`, `Password`, `Email`) VALUES (:mem_Name, :username, :mem_Password, :email)";
	$registerSTMT = $conn->prepare($registerSQL);
	$registerSTMT->bindParam(':mem_Name', $mem_Name);
	$registerSTMT->bindParam(':username', $username);
	$registerSTMT->bindParam(':mem_Password', $mem_Password);
	$registerSTMT->bindParam(':email', $email);
	$registerSTMT->execute();
	echo "success";
} catch (PDOException $error) {
	echo "error";
}

$conn = NULL;
