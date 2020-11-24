<?php
include("../db.php");

$mem_name = $_POST['mem_name'];
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];

try {
	$registerSQL = "INSERT INTO `members` (`Name`, `Username`, `Password`, `Email`) VALUES (:mem_name, :username, :mem_Password, :email)";
	$registerSTMT = $conn->prepare($registerSQL);
	$registerSTMT->bindParam(':mem_name', $mem_name);
	$registerSTMT->bindParam(':username', $username);
	$registerSTMT->bindParam(':mem_Password', $password);
	$registerSTMT->bindParam(':email', $email);
	$registerSTMT->execute();
	echo "success";
} catch (PDOException $error) {
	echo "error";
}

$conn = NULL;
