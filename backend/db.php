<?php
//DB CONNECTION====================================
$servername = "localhost";
$username = "root";
$password = "";
$database = "sem5mp";
// Create connection
$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);

// set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
