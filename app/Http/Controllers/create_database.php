<?php
include "settings.php";

try {
    $conn = new PDO("mysql:host=$servername", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	// Create Database
    $sql = "CREATE DATABASE IF NOT EXISTS ".$dbname;
    $conn->exec($sql);
	$sql = "USE ".$dbname;
	$conn->query($sql);
	
	// Create table to store blog posts
	$sql = "CREATE TABLE IF NOT EXISTS blogPosts (
			id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
			title VARCHAR(30) NOT NULL,
			content VARCHAR(500) NOT NULL,
			reg_date TIMESTAMP
			)";
	$conn->exec($sql);
	
	$sql = 'INSERT INTO blogPosts(title, content) VALUES ("Hello","ABC")';
	$conn->exec($sql);
	
}

catch(PDOException $sql) {
    echo $sql . "<br>" . $sql->getMessage();
}

$conn = null;

?>




