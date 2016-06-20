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
	
	$sql = "DROP TABLE blogPosts";
	$conn->exec($sql);
	$sql = "DROP TABLE comments";
	$conn->exec($sql);
	
	// Create table to store blog posts
	$sql = "CREATE TABLE IF NOT EXISTS blogPosts (
			id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
			title VARCHAR(200) NOT NULL,
			content VARCHAR(10000) NOT NULL,
			reg_date TIMESTAMP
			)";
	$conn->exec($sql);
	
	// Create table to store comments
	$sql = "CREATE TABLE IF NOT EXISTS comments (
			blog_id INT(6),
			content VARCHAR(1000) NOT NULL,
			author VARCHAR(500) NOT NULL,
			reg_date TIMESTAMP
			)";
	$conn->exec($sql);
		
}

catch(PDOException $sql) {
    echo $sql . "<br>" . $sql->getMessage();
}

$conn = null;

?>




