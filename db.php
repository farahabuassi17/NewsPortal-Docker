<?php
$host = "db";          // اسم خدمة MySQL في docker-compose
$user = "news_user";  // من docker-compose.yml
$pass = "news_pass";  // من docker-compose.yml
$db   = "news_db";    // من docker-compose.yml

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
