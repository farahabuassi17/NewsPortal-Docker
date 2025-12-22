<?php
session_start();
include("db.php");
if (!isset($_SESSION['user_id'])) header(header: "Location: index.php");

if (isset($_GET['id'])) {
  $id = intval($_GET['id']);
  $stmt = $conn->prepare("UPDATE news SET deleted = 1 WHERE id = ?");
  $stmt->bind_param("i", $id);
  if ($stmt->execute()) {
    header("Location: new.php");
    exit;
  } else {
    echo "Error: " . $conn->error;
  }
}
?>
