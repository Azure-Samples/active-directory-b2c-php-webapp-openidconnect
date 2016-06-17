<?php

class Database {
	
	private function setUp() {
		require "settings.php";
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $conn;
	}
	
	public function fetchBlogPosts() {
		require "settings.php";
		
		$conn = $this->setUp();
	
		$sth = $conn->prepare("SELECT id, title, content, reg_date FROM blogPosts ORDER BY reg_date DESC");
		$sth->execute();
		$result = $sth->fetchAll();
		$conn = null;
		return $result;
	}
	
	public function fetchBlogPostById($id) {
		require "settings.php";
		
		$conn = $this->setUp();
	
		$sth = $conn->prepare("SELECT id, title, content, reg_date FROM blogPosts WHERE id=".$id);
		$sth->execute();
		$result = $sth->fetchAll();
		$conn = null;
		return $result;
	}
	
	public function newBlogPost($title, $content) {
		$conn = $this->setUp();
		$sql = "INSERT INTO blogPosts (title, content)
				VALUES ('".$title."', '".$content."')";
		$conn->exec($sql);
		
	}
	
	public function newComment($blog_id, $content, $author) {
		$conn = $this->setUp();
		$sql = "INSERT INTO comments (blog_id, content, author)
				VALUES ('".$blog_id."', '".$content."', '".$author."')";
		$conn->exec($sql);
	}
}

?>